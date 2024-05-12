<?php
include_once("../lib/database.php");

class UserModel extends Database
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
        // echo "132";

    }
    public function signup($username, $password, $email)
    {
        $sql = "INSERT INTO account (username, password, email) VALUES ('$username', '$password', '$email')";
        self::$link->query($sql);
    }
    public function login($username_email, $password)
    {
        $sql =  "SELECT *FROM account WHERE username = '$username_email' OR email = '$username_email'";
        $result = self::$link->query($sql);
        return $result;
    }
    public function checkExists($username, $email)
    {
        $sql = "SELECT * FROM account WHERE username = '$username' OR email = '$email'";
        $result = self::$link->query($sql);

        return $result;
    }

    public function __get($id)
    {
        $sql = "SELECT * from account where id = $id;";
        $result = $this->select($sql);

        return $result;
    }
    // public function __getAddress($id)
    // {
    //     $sql = "SELECT * from address where user_id = $id AND default_address = 1;";
    //     $result = self::$link->query($sql);

    //     return $result;
    // }
    public function __getAllAddress($id)
    {
        $sql = "SELECT * from address where user_id = $id AND default_address != 1;";
        $result = self::$link->query($sql);

        return $result;
    }
    public function __update($id, $fullname, $date, $province, $district, $detail, $phone)
    {
        $sql1 = "UPDATE account SET name = '$fullname', phoneNumber = '$phone', birthday = '$date' WHERE id = $id;";
        $result = self::$link->query($sql1);

        // if (mysqli_num_rows($this->__getAddress($id)) === 0) {
        //     $sql2 = "INSERT INTO address (user_id,fullname,province, district, phone_number,address_details,default_address)  
        //     VALUES ('$id','$fullname','$province', '$district', '$phone', '$detail',1);";
        // } else {
        //     $sql2 = "UPDATE address SET fullname='$fullname', province = '$province', district = '$district',phone_number = '$phone' , address_details = '$detail' WHERE user_id = $id AND default=1;";
        // }
        // $result = self::$link->query($sql2);


        return $result;
    }
    public function __insertAdd($id, $fullname, $province, $district, $detail, $phone, $default)
    {

        /*
        $result = self::$link->query($sql);
        $date , $province, $district
        */
        if ($default) {
            $sql = "UPDATE address SET default_address = 0 WHERE user_id = $id;";
            $result = self::$link->query($sql);
            $sql2 = "INSERT INTO address (fullname,user_id,province, district, phone_number,address_details,default_address)  
            VALUES ('$fullname','$id','$province', '$district', '$phone', '$detail',1);";
        } else {
            $sql2 = "INSERT INTO address (fullname,user_id,province, district, phone_number,address_details,default_address)  
            VALUES ('$fullname','$id','$province', '$district', '$phone', '$detail','$default');";
        }

        $result = self::$link->query($sql2);


        return $result;
    }

    public function __deleteById($id)
    {
        $sql = "DELETE from address where id= $id";
        $result = self::$link->query($sql);
        return $result;
    }

    public function __modifyDefault($id,$user_id){
        $sql = "UPDATE address SET default_address = 0 WHERE user_id = $user_id;";
        $result = self::$link->query($sql);
        $sql1 = "UPDATE address SET default_address = 1 where user_id = $user_id AND id = $id;";
        $result = self::$link->query($sql1);
        
        return $result;
    }
    /*
    private $username;
    private $password;
    private $email;
    private $firstname;
    private $lastname;
    
    private $id;
    private $phone_number;
    private $avatar;
    
    private $role;
    */
}
