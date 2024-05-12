<?php
include_once __DIR__ . '/../../lib/database.php';

class Apartment_Model
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    // neu khong tim san pham nao se tra ve false
    public function get_apartment_by_id($id)
    {
        $query = "SELECT * FROM `apartment` WHERE id = $id;";
        $result = $this->database->select($query);
        if ($result == false) {
            return false;
        }
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function get_apartment_by_name($name)
    {
        $name = $this->database->validateInput($name);
        $query = "SELECT * FROM `apartment` WHERE `name` = '$name';";
        $result = $this->database->select($query);
        if ($result == false) {
            return false;
        }
        return $result->fetch_assoc()['id'];
    }

    function get_rate_by_id($id){
        $query = "SELECT *  FROM `rating` WHERE `apartment_id` = $id";
        $result = $this->database->select($query);
        if ($result){
            return $result->fetch_assoc()['rating_star'];
        }
        return 0;
    }
    function del_rate_by_id($id)
    {
        $query = "DELETE FROM `rating` WHERE `rating`.`apartment_id` = '$id';";
        $result = $this->database->delete($query);
        return $result;
    }
    function updateNameApById($product_id, $new_name)
    {
        $new_name = $this->database->validateInput($new_name);
        $query = "UPDATE `apartment` SET `name` = '$new_name' WHERE `apartment`.`id` = '$product_id';";
        $result = $this->database->update($query);
        return $result;
    }
    function updateAddrApById($product_id, $new_addr)
    {
        $new_addr = $this->database->validateInput($new_addr);
        $query = "UPDATE `apartment` SET `address` = '$new_addr' WHERE `apartment`.`id` = '$product_id';";
        $result = $this->database->update($query);
        return $result;
    }
    function updateStatusApById($product_id, $status){
        $new_status = $this->database->validateInput($status);
        $query = "UPDATE `apartment` SET `status` = '$new_status' WHERE `apartment`.`id` = '$product_id';";
        $result = $this->database->update($query);
        return $result;
    }
    function updateImgApById($product_id, $new_image)
    {
        $query = "UPDATE `apartment` SET `apartment_img` = '$new_image' WHERE `apartment`.`id` = '$product_id';";
        $result = $this->database->update($query);
        return $result;
    }

    function updateDescriptionApById($product_id, $new_des)
    {
        $new_des = $this->database->validateInput($new_des);
        $query = "UPDATE `apartment` SET `description` = '$new_des' WHERE `apartment`.`id` = '$product_id';";
        $result = $this->database->update($query);
        return $result;
    }
    function deleteRoomById($product_id, $room_id){
        $query = "DELETE FROM `apartment_has_room` WHERE `apartment_has_room`.`apartment_id` = '$product_id' AND `apartment_has_room`.`room_id` ='$room_id';";
        $result = $this->database->delete($query);
        return $result;
    }
    function deleteAllRoomById($product_id)
    {
        $query = "DELETE FROM `apartment_has_room` WHERE `apartment_has_room`.`apartment_id` = '$product_id';";
        $result = $this->database->delete($query);
        return $result;
    }

    function updateAvatarRoomById($product_id, $room_id, $new_avatar)
    {
        $new_avatar = $this->database->validateInput($new_avatar);
        $query = "UPDATE `apartment_has_room` SET `image` = '$new_avatar' WHERE `apartment_has_room`.`apartment_id` = '$product_id' AND `apartment_has_room`.`room_id` ='$room_id' ";
        $result = $this->database->update($query);
        return $result;
    }
    function updatePriceRoomById($product_id, $room_id, $new_price){
        $price = $this->database->validateInput($new_price);
        $query = "UPDATE `apartment_has_room` SET `price` = '$price' WHERE `apartment_has_room`.`apartment_id` = '$product_id' AND `apartment_has_room`.`room_id` ='$room_id' ";
        $result = $this->database->update($query);
        return $result;
    }

    function addApartmentInfo($productname, $productdesc, $categoryid, $img, $addr){
        $name = $this->database->validateInput($productname);
        $desc = $this->database->validateInput($productdesc);
        $addr = $this->database->validateInput($addr);
        $query = "INSERT INTO `apartment`(`id`, `name`, `address`, `description`,`apartment_img`, `category_id`) VALUES (NULL, '$name', '$addr','$desc', '$img','$categoryid')";
        $result = $this->database->insert_for_autoIncrement($query);
        return $result;
    }
    function delApartmentById($id)
    {
        $query = "DELETE FROM `apartment` WHERE `apartment`.`id` = '$id';";
        $result = $this->database->delete($query);
        return $result;
    }
    function getAllApartment()
    {
        $query = "SELECT * FROM apartment;";
        $data = $this->database->select($query);
        $result = $data->fetch_all(MYSQLI_ASSOC);
        return $result;
    }


}