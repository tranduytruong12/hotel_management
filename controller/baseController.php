<?php
include_once "../model/category_model.php";
include_once "../model/product_model.php";
include_once "../model/color_model.php";
include_once "../model/size_model.php";
class BController
{
    public function invoke()
    {
        
        if (isset($_GET["controller"])) {
            $action = $_GET["action"];
            $controller = $_GET['controller'];
            
            require('../controller/' . $controller . 'Controller.php'); 
            $controller = ucfirst($controller); 
            $request = new $controller;
            
        } else {
            session_start();
            $this->controlHeader();
            $this->controlContent();
            $this->controlFooter();
        }
    }

    public function controlHeader()
    {
        include_once "../model/category_model.php";
        $category_model = new Category_Model();
    }

    public function control_apartment_list()
    {
        $color_model = new Color_Model();

        $size_model = new Size_Model();

        $product_model = new Product_Model();

        $search = '';
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $apartment_list = $product_model->search_product_list($search);
        } else {
            $filteredColor_list = array();
            $filteredColor = "";
            if (isset($_GET["color"])) {
                $color_list = $color_model->get_color_list($_GET["color"]);
                $filteredColor_list = $color_model->get_color_list_by_ids($color_list);
                if ($_GET["color"] != '') {
                    $filteredColor = $_GET["color"];
                }
            } else {
                $color_list = $color_model->get_color_list('');
            }

            $filteredSize_list = array();
            $filteredSize = "";
            if (isset($_GET["size"])) {
                $size_list = $size_model->get_size_list($_GET["size"]);
                $filteredSize_list = $size_model->get_size_list_by_ids($size_list);
                if ($_GET["size"] != '') {
                    $filteredSize = $_GET["size"];
                }
            } else {
                $size_list = $size_model->get_size_list('');
            }

            $price = '';
            if (isset($_GET['price'])) {
                $price = $_GET['price'];
            }

            $sort = '';
            if (isset($_GET['sort'])) {
                $sort = $_GET['sort'];
            }

            $category_model = new Category_Model();
            $category = $category_model->get_category_by_id($_GET['category_id']);

            $apartment_list = $product_model->filter_product_list($filteredColor, $filteredSize, $price, $category['id'], $sort);
        }

        $viewmore = true;
        $limited = false;
        $product_count = 15;
        if (!isset($_GET['viewmore']) && $apartment_list) {
            if (count($apartment_list) <= $product_count) {
                $limited = true;
            } else {
                $viewmore = false;
                $apartment_list = array_slice($apartment_list, 0, $product_count);
            }
        }

        include_once "../view/layouts/location/apartment-list.php";
    }

    public function control_detail_room()
    {
        $apartment_id = $_GET['apartment_id'];
        $product_model = new Product_Model();
        $apartment = $product_model->get_product_by_id($apartment_id);

        $category_model = new Category_Model();
        $category = $category_model->get_category_by_id($apartment['category_id']);

        $colors_of_product = $product_model->get_colors_of_product($apartment_id);

        $color_id = $colors_of_product[0]['color_id'];
        $avatar = $colors_of_product[0]['product_img'];
        if (isset($_GET['color_id'])) {
            $color_id = $_GET['color_id'];
            $avatar = $product_model->get_avatar($apartment_id, $color_id);
        }
        $sizes_of_productColor = $product_model->get_sizes_of_productColor($apartment_id, $color_id);

        $size_id = $sizes_of_productColor[0]['size_id'];
        if (isset($_GET['size_id'])) {
            $size_id = $_GET['size_id'];
        }
        $quantity = $product_model->get_quantity($apartment_id, $color_id, $size_id);

        include_once "../view/layouts/location/breadcrumb.php";
        include_once "../view/layouts/location/detail-room.php";
    }

    public function controlContent()
    {
        if (isset($_GET["apartment_list"])) {
            $this->control_apartment_list();
        } else if (isset($_GET["detail_room"])) {
            $this->control_detail_room();
        } else {
            include_once "../view//layouts/homepage.php";
        }
    }

    public function controlFooter()
    {
        include_once "../view//partials/footer.php";
    }
}