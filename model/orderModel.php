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
        $sql = "SELECT * from order_detail WHERE customer_id = $customer_id ";
        $result = self::$link->query($sql);
        return $result;
    }

    public function __getOrder($orderid)
    {
        $sql = "SELECT * from order_detail WHERE id = $orderid";
        $result = self::$link->query($sql);
        return $result;
    }
    public function __getOrderDetail($orderid)
    {
        $sql = "SELECT * from order_has_room WHERE order_id = $orderid";
        $result = self::$link->query($sql);
        return $result;
    }
    public function __getOrderInformation($id)
    {
        
        $sql = "SELECT order_has_room.room_id, room_typ.name as room_name, order_detail.total_price,category.catagory_name as category_name, apartment.name as apartment_name, location.name, apartment_has_room.price as price, apartment_has_room.image as image
        FROM order_has_room
        JOIN room_typ ON order_has_room.room_id = room_typ.id
        JOIN order_detail ON order_detail.id = order_has_room.order_id
        JOIN apartment ON order_has_room.apartment_id = apartment.id
        JOIN apartment_has_room ON order_has_room.apartment_id = apartment_has_room.apartment_id and order_has_room.room_id = apartment_has_room.room_id
        JOIN category ON category.id = apartment.category_id
        JOIN location ON location.id = category.location_id
        
        WHERE order_has_room.order_id = $id" ;

        $result = self::$link->query($sql);
        return $result;
    
    }
    public function booking($user_id, $user_name, $phonenumber,$total,$date,$room_id,$apartment_id,$days)
    {
        $sql ="INSERT INTO order_detail (order_date, fullname, phone_number, total_price, customer_id, days)
        VALUES ('$date', '$user_name', '$phonenumber', '$total', $user_id, '$days')";
        $result = self::$link->query($sql);
        if ($result) {
            $query = "SELECT LAST_INSERT_ID() as last_id";
            $result = self::$link->query($query);
            if ($row = $result->fetch_assoc()) {
                $inserted_id = $row['last_id'];
                $this->update_order_has_room($room_id,$apartment_id,$date,$inserted_id);
            } 
        }
        return $result; 
    }
    private function update_order_has_room($room_id,$apartment_id,$date,$order_id)
    {
        $sql ="INSERT INTO order_has_room (order_id, room_id, apartment_id)
        VALUES ($order_id,$room_id, $apartment_id)";
        $result = self::$link->query($sql);
    }
}
