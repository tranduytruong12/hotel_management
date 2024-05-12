<?php
include_once "../lib/database.php";
include_once "../lib/session.php";
include_once "../model/product_model.php";

$db = new Database();
$session = new Session();

// Validate payload's sent from the client
$request_body = file_get_contents('php://input');
$payload = json_decode($request_body, true);
$fields = ["product_id", "color_id", "size_id", "quantity"];

foreach ($fields as $field) {
    if (!isset($payload[$field])) {
        echo "DEBUG: '{$field}' is not set.";
        http_response_code(400);
        exit;
    }
}

// If user is anonymous and the cart is empty, set an order id to the cookie
$user_id = $payload["user_id"];
echo $user_id;
$order_id = null;

// Check if there exists any item in user's cart
if ($user_id) {
    // If the user has an account and is logged in

    $res = $db->select("SELECT id, is_cart FROM orderdetails WHERE customer_id = {mysqli_real_escape_string($user_id)} AND is_cart = TRUE");

    if (!$res) {
        // Create new order
        // Create new order
        $create_order_q = " INSERT INTO orderdetails (customer_id, is_cart) VALUES ({mysqli_real_escape_string($user_id)}, TRUE)";
        $prep_stmt = mysqli_prepare(Database::$link, $create_order_q);

        if (!$prep_stmt->execute()) {
            http_response_code(500);
            echo "DEBUG: An error occured while creating a new cart.";
            echo "DEBUG: account id = ".$user_id."\n";
            exit;
        }
    
        $order_id =$prep_stmt->insert_id;
    } else {
        $row = $res->fetch_assoc();
        $order_id = $row['id'];
    }
} else if (!isset($_COOKIE['order-id'])) {
    // If the user is using the app anonymously...
    $create_order_q = "INSERT INTO orderdetails (is_cart) VALUES (TRUE)";
    $prep_stmt = mysqli_prepare(Database::$link, $create_order_q);

    if (!$prep_stmt->execute()) {
        http_response_code(500);
        echo "DEBUG: An error occured while creating a new cart.";
        echo "DEBUG: Anonymous account";
        exit;
    }

    $order_id =$prep_stmt->insert_id;
    setcookie("order-id", $order_id);
} else {
    $order_id = $_COOKIE['order-id'];
}

$product_id = $payload["product_id"];
$color_id = $payload["color_id"];
$size_id = $payload["size_id"];
$quantity = $payload["quantity"];

// Check if the product has been added before
$product_check_q = "SELECT order_id, product_id, color_id, size_id, product_count
                    FROM order_has_product
                    WHERE order_id =".$order_id." AND product_id =".$product_id." AND color_id = ".$color_id." AND size_id = ".$size_id.";";

$product_check_q_res = $db->select($product_check_q);

if (!$product_check_q_res) {
    // Add new item and quantity to the cart
    $add_item_q = "INSERT INTO order_has_product
                    (order_id, product_id, color_id, size_id, product_count)
                    VALUES (?, ?, ?, ?, ?)";

    $add_item_prep = Database::$link->prepare($add_item_q);

    $add_item_prep->bind_param("iiiii", $order_id, $product_id, $color_id, $size_id, $quantity);

    if (!$add_item_prep->execute()) {
        http_response_code(500);
        echo "DEBUG: An error occured while adding a new item to the cart.";
        exit;
    }
} else {
    // edit
    $product = new Product_Model();
    $max_quantity = $product->get_quantity($product_id, $color_id, $size_id);
    $current_quant = $product_check_q_res->fetch_assoc()["product_count"];
    $updated_quantity = ($quantity + $current_quant > $max_quantity) ? $max_quantity : ($current_quant + $quantity);

    // edit
    // Add new item and quantity to the cart
    $add_item_q = "UPDATE order_has_product
                    SET product_count = ?
                    WHERE order_id = ? AND product_id = ? AND color_id = ? AND size_id = ?";

    $add_item_prep = Database::$link->prepare($add_item_q);
    $add_item_prep->bind_param("iiiii", $updated_quantity, $order_id, $product_id, $color_id, $size_id);

    if (!$add_item_prep->execute()) {
        http_response_code(500);
        echo "DEBUG: An error occured while adding a new item to the cart.";
        exit;
    }
}


http_response_code(200);