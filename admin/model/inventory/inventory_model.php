<?php
include_once __DIR__ . '/../../lib/database.php';

class Inventory_Model
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }




    public function sort_apartment_list($sort)
    {
        if ($sort == '1') {
            return "";
        } elseif ($sort == "2") {
            return " ORDER BY id DESC;";
        } elseif ($sort == "3") {
            return " ORDER BY name ASC;";
        } elseif ($sort == "4") {
            return " ORDER BY name DESC;";
        }
         else {
            return "";
        }
    }
    public function get_sorted_apartment_list($sort)
    {
        $query = "SELECT * FROM `apartment`" .$sort;
        $result = $this->database->select($query);
        if ($result == false) {
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // if search to result, return a list, otherwise return []
    public function search_apartment_list($search)
    {
        $searchInput = $this->database->validateInput($search);

        $query = "SELECT * FROM `apartment` WHERE name like '%$searchInput%';";

        $result = $this->database->select($query);
        if ($result == false){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_color_name_by_id($color_id)
    {

        $query = "SELECT `color_name` FROM `color` WHERE id = $color_id;";
        $result = $this->database->select($query);
        if ($result == false) {
            return 'Khong tim thay mau';
        }
        return $result->fetch_all(MYSQLI_ASSOC)[0]['color_name'];
    }

    public function get_room_by_appartment_id($apartment_id){
        $query = "SELECT room_id, price, image FROM `apartment_has_room` WHERE apartment_id=$apartment_id;";
        $result = $this->database->select($query);
        if ($result == false) {
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_name_by_room_id($room_id){
        $query = "SELECT * FROM `room_typ` WHERE id = $room_id";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_assoc()['name'];
        }
        return -1;
    }



 


    public function get_id_of_size_name($size_name)
    {
        $query = "SELECT `id` FROM `size` WHERE size_name = $size_name;";
        $result = $this->database->select($query);
        if ($result == false) {
            return -999;
        }
        return $result->fetch_all(MYSQLI_ASSOC)[0]['id'];
    }

    // return a link to img

    // neu co san pham, tra ve danh sach, khong co san pham, tra ve []
    public function get_all_apartment_not_desc()
    {
        $query = "SELECT `id`, `name`,`category_id` FROM apartment";
        $result = $this->database->select($query);
        if ($result == false){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_roomtype_by_apartmentId($id , $roomid)
    {
        $query = "SELECT * FROM `apartment_has_room` WHERE `apartment_id` = $id AND `room_id` = $roomid";
        $result = $this->database->select($query);
        if ($result == false) {
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function get_image_by_id($id)
    {
        $query = "SELECT * FROM `apartment` WHERE `id` = $id";
        $result = $this->database->select($query);
        if ($result == false) {
            return [];
        }
        return $result->fetch_assoc()['apartment_img'];;
    }




    public function addRoomInfo($appId, $roomid, $price, $image)
    {

        $query = "INSERT INTO `apartment_has_room` (`apartment_id`, `room_id`, `price`, `image`) VALUES ('$appId', '$roomid', '$price', '$image')";
        $result = $this->database->insert($query);
        return true;
    }
    // xoa size cho mot san pham voi mot mau cu the

    //thay doi so luong san pham cua mot size cua mot san pham voi mot mau cu the


}