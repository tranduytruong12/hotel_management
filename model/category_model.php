<?php
include_once '../lib/database.php';

class Category_Model
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function get_category_by_object($object)
    {
        $query = "SELECT * FROM `category` WHERE location_id = '$object';";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }

    }

    public function get_category_by_id($id)
    {
        $query = "SELECT * FROM `category` WHERE id = $id;";
        $result = $this->database->select($query);
        if (mysqli_num_rows($result) > 0) {
            return $result->fetch_all(MYSQLI_ASSOC)[0];
        }

        return null;
    }
}