<?php
include_once __DIR__.'/../../lib/database.php';

class Category_Model
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    // if search to result, return a list, otherwise return []
    public function get_category_by_object($object)
    {
        $query = "SELECT * FROM `category` WHERE `location_id` = '$object';";
        $result = $this->database->select($query);
        if ($result == false){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_object_list(){
        $query = "SELECT DISTINCT `location_id` FROM `category`";
        $result = $this->database->select($query);
        if ($result == false){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //* error if $id not find
    public function get_category_by_id($id)
    {
        $query = "SELECT * FROM `category` WHERE id = $id;";
        $result = $this->database->select($query);
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function get_id_by_name_and_location($categoryname, $location){
        $categoryname = $this->database->validateInput($categoryname);
        $query = "SELECT * FROM `category` WHERE `catagory_name` = '$categoryname' AND `location_id` = '$location;'";
        $result = $this->database->select($query);
        return $result->fetch_assoc()['id'];
    }
    function add_category($object, $categoryName) {
        $object = $this->database->validateInput($object);
        $categoryName = $this->database->validateInput($categoryName);
        $query = "INSERT INTO `category` (`id`, `catagory_name`, `location_id`) VALUES (NULL, '$categoryName', '$object');";
        $result = $this->database->insert($query);
        return $result;

    }
    
    function delete_category_by_id($categoryId) {
        $query = "DELETE FROM `category` WHERE `category`.`id` = '$categoryId';";
        $result = $this->database->delete($query);
        return $result;

    }

    function edit_category_by_id_object($categoryId, $editCategory) {
        $editCategory = $this->database->validateInput($editCategory);
        $query = "UPDATE `category` SET `catagory_name` = '$editCategory' WHERE id = '$categoryId';";
        $result = $this->database->update($query);
        return $result;
    }

    // return a number
    function get_number_of_apartment_has_categoryId($categoryId) {
        $query = "SELECT COUNT(*) as countp FROM `apartment` WHERE category_id = '$categoryId';";
        $result = $this->database->select($query);
        return $result->fetch_all(MYSQLI_ASSOC)[0]['countp'];
    }
    function get_location_with_id($locationId){
        $query = "SELECT * FROM `location` WHERE id = '$locationId';";
        $result = $this->database->select($query);
        return $result->fetch_assoc()['name'];
    }

}

function printStr($str){
    echo $str;
}