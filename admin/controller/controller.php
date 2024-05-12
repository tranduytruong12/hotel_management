<?php
include_once __DIR__ . '/../model/category/category_model.php';
include_once __DIR__ . '/../model/apartment/apartment_model.php';
include_once __DIR__ . '/../model/inventory/inventory_model.php';
include_once __DIR__ . '/../model/order/orderModel.php';

class Controller
{
    public function invoke()
    {
        if (isset($_GET['page']) && $_GET['page'] == 'logic') {
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case "process": {
                            include_once "../view/layout/manage/process-logic.php";
                            break;
                        }
                    case "accept": {
                            include_once "../view/layout/manage/accept-logic.php";
                            break;
                        }
                    case "confirm": {
                            include_once "../view/layout/manage/confirm-logic.php";
                            break;
                        }
                    default: {
                            include_once "../view/layout/manage/manage-logic.php";
                        }
                }
            } else {
                include_once "../view/layout/manage/manage-logic.php";
            }
        } else {
            $this->controlHeader();
            $this->controlContent();
            $this->controlFooter();
        }
    }

    public function controlHeader()
    {
        include_once __DIR__ . '/../view/partials/header.php';
    }

    public function controlFooter()
    {
        include_once __DIR__ . '/../view/partials/footer.php';
    }

    //index?page=
    public function controlContent()
    {
        $page = '';
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        // index?page=
        switch ($page) {
            case 'add-apartment': {
                   $this->control_add_apartment();
                    break;
                }
            case "add-room": {
                    $this->control_add_room();
                    break;
            }
            case 'apartment-list': {
                    $this->control_apartment_list();
                    break;
                }

            case 'category': {
                    $this->control_category();
                    break;
                }
            case 'dashboard': {
                $this->control_dashboard();
                break;
            }    

            case 'manage': {
                    $this->control_manage();
                    break;

                }
            case "logic": {
                    include_once "../view/layout/manage/manage-logic.php";
                    break;
                }
            default: {
                    $this->control_dashboard();
                    #$this->control_category();
                    break;
                }
        }
    }

    // function to handle request get page = ?
    public function control_manage()
    {
        include_once __DIR__ . '/../view/layout/manage/manage.php';
    }
    public function control_dashboard()
    {
        $apartment_model=new Apartment_Model();
        $apartment=$apartment_model->getAllApartment();
        $order_model=new OrderModel();
        $order=$order_model->__getAllOrder();
        $sale=0;
        $sale_in_day = array();
        foreach ($order as $data) {
            $sale+=$data['total_price'];
            $order_date = $data['order_date'];
            if (!isset($sale_in_day[$order_date])) {
                $sale_in_day[$order_date] = array(
                    'total_sales' => 0,
                    'order_date' => $order_date
                );
            }
            $sale_in_day[$order_date]['total_sales'] += $data['total_price'];
        }
        $dates = array();
        $sales = array();

        foreach ($sale_in_day as $data) {
            $dates[] = $data['order_date'];
            $sales[] = $data['total_sales'];
        }

        $report=$order_model->__getSaleReport();
        $hotels= array();
        $hotel_sales = array();
        foreach ($report as $value){
            $hotels = $value['name'];
            if (!isset($hotel_sales[$hotels])) {
                $hotel_sales[$hotels] = array(
                    'hotel_sales' => 0,
                    'name' => $hotels
                );
            }
            $hotel_sales[$hotels]['hotel_sales'] += $value['total_price'];
        }
        $this->sortHotelSalesDescending($hotel_sales);

        include_once __DIR__ . '/../view/layout/dasboard.php';
    }

    private function sortHotelSalesDescending(&$hotel_sales) {
        usort($hotel_sales, function($a, $b) {
            return $b['hotel_sales'] - $a['hotel_sales'];
        });
    }

    public function control_add_room()
    {

        $action = '';

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        if ($action == 'submit') {

            if (isset($_POST['addSubmitBTN'])) {

                $apartmentName = $_POST['location'];
                $roomid = $_POST['roomid'];
                $price = $_POST['price'];
                $image = $_POST['image'];


                $apartment = new Apartment_Model();
                $category = new Category_Model();
                $iventory = new Inventory_Model();
                $appId = $apartment->get_apartment_by_name($apartmentName);
                if(!$iventory->get_roomtype_by_apartmentId($appId, $roomid)){
                    $res = $iventory->addRoomInfo($appId, $roomid, $price, $image);
                }
                // $res = $iventory->addRoomInfo($appId, $roomid, $price, $image);
                header("location: ../app/index.php?page=apartment-list&view=" . $appId);
            } else {
                header('location: ../app/index.php?page=add-room');
            }
        } else {
            $categoryObj = new Category_Model();
            $apartmentObj = new Inventory_Model();
            include_once __DIR__ . '/../view/layout/add-room/manage-index-add-room.php';
        }
    }
    public function control_add_apartment()
    {

        $action = '';

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        if ($action == 'submit') {

            if (isset($_POST['addSubmitBTN'])) {

                $apartmentname = $_POST['apartmentname'];
                $categoryname = $_POST['categoryname'];
                $apartmentdesc = $_POST['apartmentdesc'];
                $location = $_POST['location'];
                $img = $_POST['apartmentimage'];
                $apartmentaddr = $_POST['apartmentaddr'];
                $apartment = new Apartment_Model();
                $category = new Category_Model();

                $categoryid = $category->get_id_by_name_and_location($categoryname, $location);
                $res = $apartment->addApartmentInfo($apartmentname, $apartmentdesc, $categoryid, $img, $apartmentaddr);

                header('location: ../app/index.php?page=apartment-list');
            } else {
                header('location: ../app/index.php?page=add-apartment');
            }
        } else {
            $categoryObj = new Category_Model();
            include_once __DIR__ . '/../view/layout/add-apartment/manage-index-add.php';
        }
    }

    public function control_apartment_list()
    {

        if (isset($_GET['view'])) {

            $apartment_id = $_GET['view'];

            // model
            $apartmentObj = new Apartment_Model();
            $categoryObj = new Category_Model();
            $inventoryObj = new Inventory_Model();

            // variable apartment info
            $apartmentInfo = $apartmentObj->get_apartment_by_id($apartment_id);

            include_once __DIR__ . '/../view/layout/apartment-list/manage-index-view-info-apartment.php';
        } elseif (isset($_GET['dele'])){
            $delObj = new Apartment_Model();
            $apartment_id = $_GET['dele'];
            $delRoom = $delObj->deleteAllRoomById($apartment_id);
            $delRate = $delObj->del_rate_by_id($apartment_id);
            $delApartment = $delObj->delApartmentById($apartment_id);
            $this->display_apartment_list_page();


        }elseif (isset($_GET['edit'])) {

            $apartmentObj = new Apartment_Model();
            $categoryObj = new Category_Model();
            $inventoryObj = new Inventory_Model();


            $apartment_id = $_GET['edit'];
            $apartmentInfo = $apartmentObj->get_apartment_by_id($apartment_id);

            include_once __DIR__ . '/../view/layout/apartment-list/manage-index-edit-apartment.php';
        } elseif (isset($_GET['edited'])) {


            $apartmentObj = new Apartment_Model();
            $inventoryObj = new Inventory_Model();


            $apartment_id = $_GET['edited'];

            $updateName = '';
            $updateDescription = '';
            $updateAvatar = '';
            if(isset($_GET['del'])){
                $room_id = $_GET['del'];
                $res = $apartmentObj->deleteRoomById($apartment_id, $room_id);
            } else {
                if (isset($_POST['updateName'])) {
                    $updateName = $_POST['updateName'];

                    $res = $apartmentObj->updateNameApById($apartment_id, $updateName);
                }

                if (isset($_POST['updateAddr'])) {
                    $updateAddr = $_POST['updateAddr'];

                    $res = $apartmentObj->updateAddrApById($apartment_id, $updateAddr);
                }
                if (isset($_POST['updateDescription'])) {
                    $updateDescription = $_POST['updateDescription'];

                    $res = $apartmentObj->updateDescriptionApById($apartment_id, $updateDescription);
                }
                if (isset($_POST['status'])) {
                    $updateStatus = $_POST['status'];
                    $res = $apartmentObj->updateStatusApById($apartment_id, $updateStatus);
                }
                if (isset($_POST['updateApAvatarId'])) {
                    $updateApAvatarId = $_POST['updateApAvatarId'];
                    if ($updateApAvatarId != "") {
                        $res = $apartmentObj->updateImgApById($apartment_id, $updateApAvatarId);
                    }
                }

                $appartment_room_img_list = $inventoryObj->get_room_by_appartment_id($apartment_id);

                foreach ($appartment_room_img_list as $room_type_img) {
                    if (isset($_POST['updateAvatarId' . $room_type_img['room_id']])) {
                        $updateAvatar = $_POST['updateAvatarId' . $room_type_img['room_id']];

                        if ($updateAvatar != "") {
                            $res = $apartmentObj->updateAvatarRoomById($apartment_id, $room_type_img['room_id'], $updateAvatar);
                        }
                    }
                    if (isset($_POST['updatePriceId' . $room_type_img['room_id']])) {
                        $updatePrice = $_POST['updatePriceId' . $room_type_img['room_id']];

                        if ($updatePrice != "") {
                            $res = $apartmentObj->updatePriceRoomById($apartment_id, $room_type_img['room_id'], $updatePrice);
                        }
                    }
                }
            }
            $apartment_id = trim($apartment_id);
            header("location: index.php?page=apartment-list&view=" . urlencode($apartment_id));
        } else {
            $this->display_apartment_list_page();
        }
    }

    public function display_apartment_list_page()
    {

        $checkSearcherUsed = false;
        $apartmentList = [];

        if (isset($_GET['Searchapartment'])) {
            $searchInput = $_GET['Searchapartment'];

            $inventoryObj = new Inventory_Model();
            $searchRes = $inventoryObj->search_apartment_list($searchInput);
            $checkSearcherUsed = true;

            if (!empty($searchRes)) {
                $apartmentList = $searchRes;
            }
        }
        else if(isset($_POST['sort'])){
            $inventoryObj = new Inventory_Model();
            $sort_method = $_POST['sort'];
            $sort_method = $inventoryObj->sort_apartment_list($sort_method);
            $sortRes = $inventoryObj->get_sorted_apartment_list($sort_method);
            $checkSearcherUsed = true;

            if (!empty($sortRes)) {
                $apartmentList = $sortRes;
            }
        }
        $apartmentObj = new Apartment_Model();
        $categoryObj = new Category_Model();
        $inventoryObj = new Inventory_Model();

        if ($checkSearcherUsed == false) {
            $searchRes = $inventoryObj->get_all_apartment_not_desc();
            if (!empty($searchRes)) {
                $apartmentList = $searchRes;
            }
        }

        include_once __DIR__ . '/../view/layout/apartment-list/manage-index-apartment-list.php';
    }

    public function control_category()
    {
        // todo

        if (isset($_GET['addCategory']) && isset($_GET['addCategory']) == "TRUE") {
            $objName = $_POST['categoryLocation'];
            $newCategoryName = $_POST['newCategoryName'];

            $categoryObj = new Category_Model();
            $res = $categoryObj->add_category($objName, $newCategoryName);

            header("location: index.php?page=category");
        } elseif (isset($_GET['delete'])) {
            $category_id = $_POST['deleteCategoryId'];

            $categoryObj = new Category_Model();
            $res = $categoryObj->delete_category_by_id($category_id);
            header("location: index.php?page=category");
        } elseif (isset($_GET['edit'])) {

            $category_id = $_GET['edit'];
            $editCategory = $_POST['editCategory'];

            $categoryObj = new Category_Model();
            $res = $categoryObj->edit_category_by_id_object($category_id, $editCategory);
        }

        $categoryObj = new Category_Model();
        $objectList = $categoryObj->get_object_list();

        include_once __DIR__ . '/../view/layout/category/manage-index-category.php';
    }

}

