<?php

require_once "controller.php";
require_once "../lib/database.php";
require_once "../lib/session.php";
require_once "../config/config.php";

class PaymentController extends Controller {
    private $customer;
    private $session;
    private $db;

    public function __construct() {
        $this->session = new Session();
        $this->db = new Database();
    }

    public function invoke() {
        // TODO: Check if the incoming request is sent from authenticated user.
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            // Handle GET request
            $this->get();
        } elseif ($method === 'POST') {
            // Handle POST request
            $this->post();
        } else {
            // Invalid request
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: text/plain');
            echo '400 Bad Request - Invalid or Malformed Request';
            return;
        }
    }

    public function get() {
        /** Handle HTTP GET method. */
        header('HTTP/1.1 200 OK');
        header('Content-Type: text/html');
    }

    /** Retrieve customer's information from the database.
     *  Return: A associative array representing customer's information.
     *          null if the user is anonymous.
     */
    private function get_customer_info() {

        $conn = new Database();
        $session = $this->session;

        if (!$session->get('customer_id')) {
            return null;
        }

        $res = $conn->select("SELECT * FROM customeraccount WHERE id = {$session->get('customer_id')}");

        if (!$res) {
            return $res->fetch_assoc();
        }

        return $res;
    }

    private function get_customer_id() {
        if (!$this->get('user-id')) {
            return null;
        }

        return $this->get('user-id');
    }


    private function post() {
        /* Handle HTTP POST method. 
         * TODO:
         *  - Handle the transaction
         *  - Update transaction's history
         *  - Clear user's cart if the transaction is successful.
         */         
        $raw_body = file_get_contents("php://input");
        $payload = json_decode($raw_body, true);
        if (!$payload) {
            http_response_code(400);
            exit;
        }

        $fields = ['user_id', 'province', 'district', 'full_name', 'phone_number', 'address', 'payment'];
        foreach ($fields as $field) {
            if (!isset($payload, $field)) {
                echo $field;
                http_response_code(400);
                exit;
            }
        }

        $user_id = $payload["user_id"];

        $cart_id = $this->get_cart_id($user_id);
        if (!$cart_id) {
            http_response_code(400);
            exit;
        }

        // Calculate total price
        $total_price_q = "SELECT product_count, price
                        FROM order_has_product
                        JOIN product ON order_has_product.product_id = product.id
                        WHERE order_has_product.order_id = ".$cart_id.";";


        $rows = $this->db->select($total_price_q)->fetch_all(MYSQLI_ASSOC);

                

        $total_price = array_reduce($rows, 
            fn ($total_price, $item) => $total_price + $item["price"] * $item["product_count"], 0);


        // Update quantity of each type of product
        $update_quantity_query = "UPDATE color_has_sizes
                                    JOIN order_has_product
                                    ON order_has_product.product_id = color_has_sizes.product_id
                                    AND order_has_product.color_id = color_has_sizes.color_id
                                    AND order_has_product.size_id = color_has_sizes.size_id
                                    SET color_has_sizes.quantity = color_has_sizes.quantity - order_has_product.product_count
                                    WHERE order_has_product.order_id = ".$cart_id.";";

        if (!$this->db->update($update_quantity_query)) {
            http_response_code(500);
            echo "DEBUG: error occured while updating quantity.";
            exit;
        }

        $delete_empty_item_q = "DELETE FROM order_has_product
                                WHERE order_has_product.order_id = ".$cart_id."
                                AND order_has_product.product_count = 0;";   

//        echo $delete_empty_item_q;

        if (!$this->db->update($delete_empty_item_q)) {
            http_response_code(500);
            echo "DEBUG: error occured while deleting empty items in the order.";
            exit;
        }

        $update_q = "UPDATE orderdetails
                    SET order_date = NOW(),
                    province = '".$payload["province"]."',
                    district = '".$payload["district"]."',
                    fullname = '".$payload["full_name"]."',
                    phone_number = '".$payload["phone_number"]."',
                    payment = '".$payload["payment"]."',
                    address_details = '".$payload["address"]."',
                    is_cart = FALSE,
                    total_money = ".$total_price."
                    WHERE id = ".$cart_id.";";

        echo $update_q;

        if (!$this->db->update($update_q)) {
            http_response_code(500);
            echo "DEBUG: Error occured while updating";
            exit;
        }

        unset($_COOKIE['order-id']);
        setcookie("order-id", "", time()-3600);
        http_response_code(200);
    }

    private function check_cart($id) {
        $check_cart_q = "SELECT is_cart FROM orderdetails WHERE id = ".$id.";";
        $check_cart_res = $this->db->select($check_cart_q);
        if (!$check_cart_res) {
            return false;
        }
        $row = $check_cart_res->fetch_assoc();
        return $row["is_cart"] != 0;
    }


    private function get_cart_id($user_id) {
        $session = new Session();
        if (!$user_id) {
            if (isset($_COOKIE['order-id']) and $this->check_cart($_COOKIE['order-id'])) {
                return $_COOKIE['order-id'];
            }
            return null;
        }
        $q = "SELECT id FROM orderdetails WHERE customer_id = ".$user_id." AND is_cart = TRUE";
        echo $q;
        $res = $this->db->select($q);
        if ($res) {
            return $res->fetch_assoc()["id"];
        }
        return null;
    }


//    private function render() {
//        /** Render the checkout menu.
//         *  TODO:
//         *      - Retrieve user's current order
//         *      - Retrieve the order's address (use for auto-fill feature)
//         *      - Render checkout page
//         */
//
//        parent::controlHeader();
//
//
//        if ($cart_id) {
//            $query = "SELECT order_has_product.product_id, product_name, order_has_product.color_id, color.color_name,
//                 order_has_product.size_id, size_name, order_has_product.product_count as cart_quantity, 
//                 color_has_sizes.quantity as max_quantity, price, product_has_colors.product_img
//                FROM order_has_product
//                JOIN product ON order_has_product.product_id = product.id
//                JOIN orderdetails ON orderdetails.id = order_has_product.order_id
//                JOIN color ON order_has_product.color_id = color.id
//                JOIN size ON order_has_product.size_id = size.id
//                JOIN product_has_colors 
//                    ON order_has_product.product_id = product_has_colors.product_id 
//                    AND order_has_product.color_id = product_has_colors.color_id
//                JOIN color_has_sizes ON
//                    color_has_sizes.product_id = order_has_product.product_id
//                    AND color_has_sizes.color_id = order_has_product.color_id
//                    AND color_has_sizes.size_id = order_has_product.size_id
//                WHERE order_has_product.order_id = ". $cart_id . ";";
//
//            $query_res = $this->db->select($query);
//
//
//            if (!$query_res) {
//                http_response_code(500);
//                exit;
//            }
//
//            $cart_items = $query_res->fetch_all(MYSQLI_ASSOC);
//
//            $total_price = array_reduce($cart_items, 
//                fn ($total_price, $cart_item) => $total_price + $cart_item["price"] * $cart_item["cart_quantity"], 0);
//
//            include_once "../view/layouts/cart/checkout.php";
//        } else {
//            include_once "../view/layouts/cart/checkout-error.php";
//        }
}