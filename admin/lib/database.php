<?php
include '../config/config.php';

class Database
{
    static private $host = DB_HOST;
    static private $user = DB_USER;
    static private $pass = DB_PASS;
    static private $dbname = DB_NAME;

    static public $link;
    static  public $error;
    public function __construct()
    {
        $this->connectDB();
    }

    static public function connectDB()
    {
        try {
            self::$link = new mysqli(self::$host, self::$user, self::$pass, self::$dbname);
            if (self::$link->connect_error) {
                throw new Exception("Connect failed: " . self::$link->connect_error);
            }
            mysqli_set_charset(self::$link, 'utf8');
            // echo "Connected successfully";
            return self::$link;
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }
    public function closeDB(){
        self::$link = null;
    }



    // Select or Read data
    public function select($query)
    {
        $result = self::$link->query($query) or
        die(self::$link->error . __LINE__);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // Insert data
    public function insert($query)
    {
        $insert_row = self::$link->query($query) or
        die(self::$link->error . __LINE__);
        if ($insert_row) {
            return $insert_row;
        } else {
            return false;
        }
    }

    // Update data
    public function update($query)
    {
        $update_row = self::$link->query($query) or
        die(self::$link->error . __LINE__);
        if ($update_row) {
            return $update_row;
        } else {
            return false;
        }
    }

    // Delete data
    public function delete($query)
    {
        $delete_row = self::$link->query($query) or
        die(self::$link->error . __LINE__);
        if ($delete_row) {
            return $delete_row;
        } else {
            return false;
        }
    }

    // valid input
    public function validateInput($input)
    {
        return self::$link->real_escape_string($input);
    }

    // insert and return id for auto increment attribute
    public function insert_for_autoIncrement($query)
    {
        $insert_result = self::$link->query($query) or die(self::$link->error . __LINE__);
        if ($insert_result) {
            $last_insert_id = self::$link->insert_id;
            return $last_insert_id;
        } else {
            return false;
        }
    }
}
