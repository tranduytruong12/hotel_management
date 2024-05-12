<?php
include_once '../lib/database.php';
include_once '../model/size.php';

class Size_Model
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function get_size_list($ids)
    {
        $ids = explode(',', $ids);
        $query = "SELECT * FROM `size`;";
        $result = $this->database->select($query);
        $size_table = $result->fetch_all(MYSQLI_ASSOC);
        $size_list = array();
        foreach ($size_table as $row) {
            if (in_array($row["id"], $ids)) {
                $size = new Size($row['id'], $row['size_name'], true);
            } else {
                $size = new Size($row['id'], $row['size_name'], false);
            }
            array_push($size_list, $size);
        }
        return $size_list;
    }

    public function get_size_list_by_ids($size_list)
    {
        $filter_size_list = array();
        foreach ($size_list as $size) {
            if ($size->getSizeState()) {
                array_push($filter_size_list, $size);
            }
        }
        return $filter_size_list;
    }

    public function remove_size($size_list, $size)
    {
        $size_list = explode(',', $size_list);
        $size = array($size);
        $remove_size = array_diff($size_list, $size);
        return implode(',', $remove_size);
    }
}
