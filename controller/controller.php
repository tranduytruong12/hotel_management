<?php
include_once "../model/location_model.php";
include_once "../model/category_model.php";
include_once "../model/color_model.php";
include_once "../model/size_model.php";
include_once "../model/userModel.php";
include_once "../model/orderModel.php";
include_once "../lib/session.php";
include_once "../lib/database.php";

class Controller
{
    public function invoke()
    {
        if (isset($_GET["controller"])) {
            // $action = $_GET["action"];
            $controller = $_GET['controller'];
            require '../controller/' . $controller . 'Controller.php';
            $request = new User;
        } else if (isset($_GET['logic'])) {
            include_once "../view/layouts/account/order-detail.logic.php";
        } else {
            session_start();
            $this->controlHeader();
            $this->controlContent();
            $this->controlFooter();
        }
    }

    public function controlHeader()
    {
        $category_model = new Category_Model();
        $cart_id = $this->get_cart_id();

        $cart_items = [];
        $total_price = null;

        if ($cart_id and $cart_items = $this->get_cart($cart_id)) {
            $total_price = array_reduce(
                $cart_items,
                fn ($total_price, $cart_item) => $total_price + $cart_item["price"],
                0
            );
        }

        include_once "../view/partials/header.php";
    }

    public function control_apartment_list()
    {
        $location = new Location_Model();
        $location_model = new Location_Model();
        // $size_model = new Size_Model();
        $search = '';
        if (isset($_POST['search'])) {
            $search = htmlspecialchars($_POST['search'], ENT_QUOTES, 'UTF-8');
            $apartment_list = $location_model->search_product_list($search);
        } else {
            $sort = '';
            if (isset($_GET['sort'])) {
                $sort = $_GET['sort'];
            }

            $category_model = new Category_Model();
            $category = $category_model->get_category_by_id($_GET['category_id']);
            $apartment_list = $location_model->filter_apartment_list($category['id'], $sort);
        }

        $viewmore = true;
        $limited = false;
        $apartment_count = 12;
        if (!isset($_GET['viewmore']) && $apartment_list) {
            if (count($apartment_list) <= $apartment_count) {
                $limited = true;
            } else {
                $viewmore = false;
                $apartment_list = array_slice($apartment_list, 0, $apartment_count);
            }
        }
        include_once "../view/layouts/location/apartment-list.php";
    }

    public function control_detail_room()
    {
        $apartment_id = $_GET['apartment_id'];
        $location = new Location_Model();
        $apartment_model = new Location_Model();
        $category_model = new Category_Model();
        $apartment_room_model = new Location_Model();
        $catagory_model = new Location_Model();
        $roomtyp_model = new Location_Model();
        $apartment = $apartment_model->get_apartment_by_id($apartment_id);
        // lay name
        $apartment = $apartment_model->get_all_apartment($apartment_id);
        $category = $category_model->get_category_by_id($apartment['category_id']);
        //star
        $star_model = new Location_Model();
        $star = $star_model->get_star_by_id($apartment_id);
        // img_room
        $apartment_room = $apartment_room_model->get_apartment_has_room($apartment_id);
        // catagory
        $catagory = $catagory_model->get_category_by_id($apartment_id);


        if (isset($_SESSION['user-id'])) {
            $ordered = $location->user_apartment_order($_GET['apartment_id'],$_SESSION['user-id']);
        }

        if (isset($_POST["rating_form"])) {
            $result=$location->apartment_rating($_POST['rate_star'],$_GET['apartment_id'] ,$_SESSION['user-id']);
            echo "<script>alert('Đánh giá thành công!');</script>";
        }
        
        include_once "../view/layouts/location/breadcrumb.php";
        include_once "../view/layouts/location/detail-room.php";
    }

    public function booking_control()
    {
        
        $order = new OrderModel();
        $user_model = new UserModel();
        $location = new Location_Model();
        $category_model = new Category_Model();

        $apartment_id=$_GET['apartment_id'];
        $room_id=$_GET['room_id'];

        $apartment = $location->get_apartment_by_id($apartment_id);
        $category = $category_model->get_category_by_id($apartment['category_id']);

        $user = $user_model->__get($_SESSION['user-id'])->fetch_assoc();
        if ($user['name']){
            $username=$user['name'];
        }
        else{
            $username=null;
        }
        if ($user['phoneNumber']){
            $phone=$user['phoneNumber'];
        }
        else{
            $phone=null;
        }

        $apartment = $location->get_apartment_by_id($apartment_id);
        $room =  $location->get_roomtyp_by_id($room_id);
        $apartment_has_room = $location->get_apartment_has_room($apartment_id);
        foreach ($apartment_has_room as $element) {
            if ($element['apartment_id'] === $apartment_id && $element['room_id'] === $room_id) {
                $price=$element['price'];
            }
        }

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $phone = $_POST['phone']; 
            $date = $_POST['checkin_date'];
            $days = $_POST['days'];
            $total_price = $days* $price;
            $result = $order->booking($_SESSION['user-id'],$username,$phone,$total_price,$date,$room_id,$apartment_id,$days);
            if ($result) {
                echo "<script>alert('Đặt phòng thành công!');";
                echo "window.location.href = '../app/index.php?detail_room&&apartment_id=" . $apartment['id'] . "';</script>";
            }
            else {
                echo "<script>alert('Có lỗi xảy ra khi đặt phòng!');</script>";                
            }
        }
        include_once "../view/layouts/location/booking.php";
    }

    public function control_account_update()
    {
        /*
        if (isset($_POST['update'])) {
        $user_model = new UserModel();
        $fullname =  $_POST['fullname'];
        $date = $_POST['date'];
        $province = $_POST['provinceOption'];
        $district = $_POST['districtOption'];
        $detail = $_POST['detail'];
        $phone =     $_POST['phone'];
        $id = $_POST['id'];
        }
         */
        $user_model = new UserModel();
        if (isset($_POST["fullname"])) {
            $fullname = $_POST["fullname"];
        }
        if (isset($_POST["date"])) {
            $date = $_POST["date"];
        }
        if (isset($_POST["text_province"])) {
            $province = $_POST["text_province"];
        }
        if (isset($_POST["text_district"])) {
            $district = $_POST['text_district'];
        }
        if (isset($_POST['detail'])) {
            $detail = $_POST['detail'];
        }
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
        }
        $id = $_SESSION['user-id'];

        $result = $user_model->__update($id, $fullname, $date, $province, $district, $detail, $phone);
        $_SESSION['success-update'] = $result;
        if ($result) {

            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . '?account' . '">';
            die();
        }
    }

    public function control_account_update_add()
    {
        $user_model = new UserModel();

        if (isset($_POST["fullname"])) {
            $fullname = $_POST["fullname"];
        }
        if (isset($_POST["text_province"])) {
            $province = $_POST["text_province"];
        }
        if (isset($_POST["text_district"])) {
            $district = $_POST['text_district'];
        }
        if (isset($_POST['detail'])) {
            $detail = $_POST['detail'];
        }
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
        }

        if (isset($_POST['address-default'])) {
            $default = 1;
        } else {
            $default = 0;
        }
        $id = $_SESSION['user-id'];
        $result = $user_model->__insertAdd($id, $fullname, $province, $district, $detail, $phone, $default);

        $_SESSION['success-update'] = $result;
        if ($result) {

            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . '?account&&action=maps' . '">';
            die();
        }
    }
    public function control_account_delete($id)
    {
        $user_model = new UserModel();
        $result = $user_model->__deleteById($id);

        $_SESSION['success-delete'] = $result;

        if ($result) {

            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . '?account&&action=maps' . '">';
            die();
        }
    }
    public function control_account_modify($id, $user_id)
    {
        $user_model = new UserModel();
        $result = $user_model->__modifyDefault($id, $user_id);

        $_SESSION['success-update'] = $result;

        if ($result) {

            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . '?account&&action=maps' . '">';
            die();
        }
    }

    public function controlContent()
    {
        if (isset($_GET["apartment_list"])) {
            $this->control_apartment_list();
        } else if (isset($_GET["detail_room"])) {
            $this->control_detail_room();
        } else if (isset($_GET['cart'])) {
            $this->cart_control_content();
        } else if (isset($_GET['booking'])) {
            $this->booking_control();
        } else if (isset($_GET['checkout'])) {
            $this->checkout_control_content();
        } else if (isset($_GET["account"])) {

            if (isset($_GET["action"])) {
                $action = $_GET["action"];
                switch ($action) {
                    case "": {

                            include_once "../view/layouts/account/account.php";

                            break;
                        }
                    case "update": {
                            // $user_model = new UserModel();
                            include_once "../view/layouts/account/account-update.php";
                            if (isset($_POST["update"])) {
                                $this->control_account_update();
                            }
                            break;
                        }
                    case "manage": {
                            include_once "../view/layouts/account/account-manage.php";
                            break;
                        }
                    case "maps": {
                            include_once "../view/layouts/account/account-maps.php";
                            if (isset($_POST["update-add"])) {
                                $this->control_account_update_add();
                            }

                            break;
                        }
                    case "notifi": {
                            include_once "../view/layouts/account/account-notifi.php";
                            break;
                        }
                    case "delete": {
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                                $this->control_account_delete($id);
                            }

                            break;
                        }
                    case "modify": {
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                                $user_id = $_SESSION["user-id"];
                                $this->control_account_modify($id, $user_id);
                            }

                            break;
                        }
                    case "logic": {
                            include_once "../view/layouts/account/order-detail.logic.php";
                            break;
                        }
                    default: {
                            include_once "../view/layouts/account/account.php";
                            break;
                        }
                }
            } else {
                include_once "../view/layouts/account/account.php";
            }
        } else if (isset($_GET["footers"])) {
            $footers = $_GET["footers"];
            switch ($footers) {
                case ("aboutus"): {
                        include_once "../view//layouts/footers/blog.php";
                        break;
                    }
                case ("condition"): {
                        include_once "../view//layouts/footers/condition.php";
                        break;
                    }
                case ("regulation"): {
                        include_once "../view//layouts/footers/regulation.php";
                        break;
                    }
                case ("security"): {
                        include_once "../view//layouts/footers/security.php";
                        break;
                    }
            }
        } else {
            include_once "../view//layouts/homepage.php";
        }
    }

    public function controlFooter()
    {
        include_once "../view//partials/footer.php";
    }

    public function cart_control_content()
    {
        $order_id = $this->get_cart_id();
        $db = new Database();

        $cart_items = null;

        if ($order_id) {
            $query = "SELECT order_has_room.room_id, room_typ.name as room_name, order_has_room.apartment_id, category.catagory_name as category_name,apartment.name as apartment_name , location.name,  apartment_has_room.price as price, apartment_has_room.image as image
        FROM order_has_room
        JOIN room_typ ON order_has_room.room_id = room_typ.id
        JOIN order_detail ON order_detail.id = order_has_room.order_id
        JOIN apartment ON order_has_room.apartment_id = apartment.id
        JOIN apartment_has_room ON order_has_room.apartment_id = apartment_has_room.apartment_id and order_has_room.room_id = apartment_has_room.room_id
        JOIN category ON category.id = apartment.category_id
        JOIN location ON location.id = category.location_id
                
                WHERE order_has_room.order_id = " . $order_id . ";";

            $cart_items = $db->select($query);
        }

        include_once "../view/layouts/cart/cart.php";
    }


    private function check_cart($id)
    {
        $db = new Database();
        $check_cart_q = "SELECT is_cart FROM orderdetails WHERE id = " . $id . ";";
        $check_cart_res = $db->select($check_cart_q);
        if (!$check_cart_res) {
            return false;
        }
        $row = $check_cart_res->fetch_assoc();
        return $row["is_cart"] != 0;
    }

    private function get_cart_id()
    {
        $session = new Session();
        $db = new Database();

        if (!$session->get('user-id')) {
            if (isset($_COOKIE['order-id']) and $this->check_cart($_COOKIE['order-id'])) {
                return $_COOKIE['order-id'];
            }
            return null;
        }
        $q = "SELECT id FROM order_detail WHERE customer_id = " . $_SESSION['user-id'] . " ";
        $res = $db->select($q);
        if ($res) {
            return $res->fetch_assoc()["id"];
        }
        return null;
    }

    private function get_cart($cart_id)
    {
        $db = new Database();
        $query = "SELECT order_has_room.room_id, room_typ.name as room_name, order_has_room.apartment_id, category.catagory_name as apartment_name, location.name,  apartment_has_room.price as price, apartment_has_room.image as image
        FROM order_has_room
        JOIN room_typ ON order_has_room.room_id = room_typ.id
        JOIN order_detail ON order_detail.id = order_has_room.order_id
        JOIN apartment ON order_has_room.apartment_id = apartment.id
        JOIN apartment_has_room ON order_has_room.apartment_id = apartment_has_room.apartment_id and order_has_room.room_id = apartment_has_room.room_id
        JOIN category ON category.id = apartment.category_id
        JOIN location ON location.id = category.location_id
        
        WHERE order_has_room.order_id = " . $cart_id . ";";

        $query_res = $db->select($query);
        if (!$query_res) {
            return false;
        }
        return $query_res->fetch_all(MYSQLI_ASSOC);
    }

    private function checkout_control_content()
    {


        $cart_id = $this->get_cart_id();
        $db = new Database();

        if ($cart_id) {
            $cart_items = $this->get_cart($cart_id);

            if (!$cart_items) {
                http_response_code(500);
                exit;
            }

            $total_price = array_reduce(
                $cart_items,
                fn ($total_price, $cart_item) => $total_price + $cart_item["price"] * $cart_item["cart_quantity"],
                0
            );

            include_once "../view/layouts/cart/checkout.php";
        } else {
            include_once "../view/layouts/cart/checkout-error.php";
        }
    }
}
