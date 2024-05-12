<?php
include_once '../lib/database.php';

class Location_Model
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    
    public function get_apartment_by_id($id)
    {
        $query = "SELECT * FROM `apartment` WHERE id = $id;";
        $result = $this->database->select($query);
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function get_location_by_id($id)
    {
        $query = "SELECT * FROM `location` WHERE id = $id;";
        $result = $this->database->select($query);
        if (mysqli_num_rows($result) > 0) {
            return $result->fetch_all(MYSQLI_ASSOC)[0];
        }
        return null;
    }   
    public function get_name_location_by_id($location_id)
    {
        $query = "SELECT name FROM `location` WHERE id = $location_id"; // Chỉ lấy cột 'name'
        $result = $this->database->select($query);
    
        if ($result && $result->num_rows > 0) {
            // Lấy dòng đầu tiên và cột 'name' từ kết quả trả về
            $location = $result->fetch_assoc();
            return $location['name']; // Trả về giá trị của cột 'name'
        } 
        return null;
    }
    public function get_all_location()
    {
        $query = "SELECT * FROM `location` ";
        $result = $this->database->select($query);
        if (mysqli_num_rows($result) > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return null;
    }

    public function sort_product_list($sort)
    {
        return "";
    }
    public function search_product_list($search)
    {
        $query = "SELECT * FROM `apartment` WHERE name like '%$search%';";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return $result;
        }
    }
    public function get_avatar_apartment($product_id)
    {
        $query = "SELECT * FROM `apartment` WHERE id = '$product_id'";
        $result = $this->database->select($query);
        if ($result) {
            // print_r($result->fetch_all(MYSQLI_ASSOC));
            return $result->fetch_all(MYSQLI_ASSOC)[0]['apartment_img'];
        } else {
            return $result;
        }
    }
    public function filter_apartment_list($category_id, $sort)
    {

            $query = "SELECT apartment.id,apartment.name,apartment.description
            FROM `apartment` WHERE category_id = $category_id";

        $query .= $this->sort_product_list($sort);

        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
    // lay bang apartment
    public function get_all_apartment($id)
    {
        $query = "SELECT * FROM `apartment` WHERE id = $id";
        $result = $this->database->select($query);
        if (($result)) {
            return $result->fetch_all(MYSQLI_ASSOC)[0];
        }
        return null;
    }
    public function get_star_by_id($apartment_id)
    {
        $query = "SELECT * FROM `rating` WHERE apartment_id = $apartment_id";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_assoc()['rating_star'];
        }
        return 0;
    }
    public function get_apartment_has_room($apartment_id)
    {
        $query = "SELECT * FROM `apartment_has_room` WHERE apartment_id = $apartment_id";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
    public function get_category_by_id($location_id)
    {
        $query = "SELECT * FROM `category` WHERE location_id = $location_id";
        $result = $this->database->select($query);
        if (($result) ) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }
    // apartment_has_room
    public function get_roomtyp_by_id($id)
    {
        $query = "SELECT * FROM `room_typ` WHERE id = $id";
        $result = $this->database->select($query);
        if (mysqli_num_rows($result) > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }
    public function apartment_rating($star,$apartment_id,$user_id){
        $sql = "SELECT * FROM rating WHERE apartment_id = $apartment_id AND user_id = $user_id";
        $exist = $this->database->select($sql);
        if ($exist){
            $sql = "UPDATE rating SET rating_star = $star WHERE apartment_id = $apartment_id AND user_id = $user_id";
            $this->database->update($sql);
        }
        else{
            $query = "INSERT INTO rating (rating_star, apartment_id, user_id) 
            VALUES ($star, $apartment_id, $user_id) 
            ON DUPLICATE KEY UPDATE rating_star = VALUES(rating_star)";
            $result = $this->database->insert($query);
            return $result;
        }
    }
    public function user_apartment_order($apartment_id,$user_id){
        $query ="SELECT od.id AS order_detail_id, ohr.id AS order_has_room_id
                FROM order_detail od
                JOIN order_has_room ohr ON od.id = ohr.order_id
                WHERE od.customer_id = $user_id
                AND ohr.apartment_id = $apartment_id;
                ";
       $result = $this->database->select($query);
       return $result;
    }
}