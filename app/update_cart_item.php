<?php
include_once "../lib/database.php";
include_once "../lib/session.php";

$db = new Database();
$session = new Session();

// Validate payload's sent from the client
$request_body = file_get_contents('php://input');
$payload = json_decode($request_body, true);
$fields = ["product_id", "color_id", "size_id", "quantity", "user_id"];

foreach ($fields as $field) {
    if (!isset($payload[$field]) and $field != "user_id") {
        echo "DEBUG: '{$field}' is not set.";
        http_response_code(400);
        exit;
    }
}

$user_id = null;
if (isset($payload["user_id"])) {
    $user_id = $payload["user_id"];
}
$order_id = null;

// Check if there exists any item in user's cart
if ($user_id) {
    // If the user has an account and is logged in

    $res = $db->select("SELECT id, is_cart FROM orderdetails WHERE customer_id = {mysqli_real_escape_string($user_id)} AND is_cart = TRUE");

    if (!$res) {
        http_response_code(400);
        echo "DEBUG: user hasn't added any items.";
        exit;
    } else {
        $row = $res->fetch_assoc();
        $order_id = $row['id'];
    }
} else if (!isset($_COOKIE['order-id'])) {
    // If the user is using the app anonymously...
    http_response_code(400);
    echo "DEBUG: 'order-id' has not been set.";
    exit;
} else {
    $order_id = $_COOKIE['order-id'];
}

$product_id = $payload["product_id"];
$color_id = $payload["color_id"];
$size_id = $payload["size_id"];
$quantity = $payload["quantity"];

$update_q = "UPDATE order_has_product SET product_count = {$quantity} 
            WHERE order_id = {$order_id}".
            " AND product_id = {$product_id}".
            " AND color_id = {$color_id}".
            " AND size_id = {$size_id};";

if (!$db->update($update_q)) {
    http_response_code(500);
    echo "DEBUG: An error occured while updating product_count.";
}

http_response_code(200);