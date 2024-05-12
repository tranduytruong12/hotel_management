<?php
include_once("../lib/database.php");

class OrderModel extends Database
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
        // echo "132";

    }
    public function __get($customer_id)
    {
        $sql = "SELECT * from orderdetails WHERE customer_id = $customer_id ";
        $result = $this->db->select($sql);
        return $result->fetch_assoc();
    }
    public function __getAll(){
        $sql = "SELECT * from order_detail ORDER BY order_date DESC";
        $result = $this->db->select($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function __getOrder($orderid)
    {
        $sql = "SELECT * from order_detail WHERE id = $orderid";
        $result = $this->db->select($sql);
        return $result->fetch_assoc();
    }
    public function __getOrderDetail($orderid)
    {
        $sql = "SELECT * from order_has_room WHERE order_id = $orderid";
        $result = $this->db->select($sql);
        return $result->fetch_assoc();
    }

    public function __setProcess($orderid){
        $sql = "UPDATE order_detail set status = 0 where id = $orderid";
        $result = $this->db->select($sql);
        //$result = self::$link->query($sql);
        return $result;
    }
    public function __setAccept($orderid){
        $sql = "UPDATE order_detail set status = 1 where id = $orderid";
        $result = $this->db->select($sql);
        //$result = self::$link->query($sql);
        return $result;
    }
    public function __setConfirm($orderid){
        $sql = "UPDATE order_detail set status = 2 where id = $orderid";
        $result = $this->db->select($sql);
        //$result = self::$link->query($sql);
        return $result;
    }
    public function __getAllOrder(){
        $sql = "SELECT * from order_detail";
        $data = $this->db->select($sql);
        $result = $data->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function __getSaleReport(){
        $sql = "SELECT apartment.name, order_detail.total_price
        FROM order_detail
        JOIN order_has_room ON order_detail.id = order_has_room.order_id
        JOIN apartment_has_room ON order_has_room.apartment_id = apartment_has_room.apartment_id AND order_has_room.room_id = apartment_has_room.room_id
        JOIN apartment ON apartment_has_room.apartment_id = apartment.id;
        ";
        $data = $this->db->select($sql);
        $result = $data->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
