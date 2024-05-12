<?php
include_once '../lib/database.php';

class Product_Model
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function get_product_by_id($id)
    {
        $query = "SELECT * FROM `apartment` WHERE id = $id;";
        $result = $this->database->select($query);
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function get_product_list($category_id)
    {
        $query = "SELECT * FROM `product` WHERE category_id = '$category_id';";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return $result;
        }
    }

    public function get_avatar($product_id, $color_id)
    {
        $query = "SELECT * FROM `product_has_colors` WHERE product_id = '$product_id'and color_id = '$color_id';";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC)[0]['product_img'];
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

    // public function get_avatar_apartment($product_id)
    // {
    //     $query = "SELECT * FROM `apartment` WHERE category_id = $product_id";
    //     $result = $this->database->select($query);
    //     if (mysqli_num_rows($result) > 0) {
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     }
    //     return null;
    // }

    public function sort_product_list($sort)
    {
        if ($sort == '1') {
            return " ORDER BY price ASC";
        } elseif ($sort == "2") {
            return " ORDER BY price DESC";
        } elseif ($sort == "3") {
            return " ORDER BY product_name ASC";
        } elseif ($sort == "4") {
            return " ORDER BY product_name DESC";
        } else {
            return "";
        }
    }

    public function filter_product_list($color, $size, $price, $category_id, $sort)
    {
        if (empty($color) && empty($size) && empty($price)) {

            $query = "SELECT DISTINCT product.id,product.product_name,product.price
            FROM `product` WHERE category_id = $category_id";

        } elseif (empty($color) && empty($size)) {

            $query = "SELECT DISTINCT product.id,product.product_name,product.price
            FROM product
            WHERE category_id = $category_id
            AND product.price < $price";

        } elseif (empty($size) && empty($price)) {

            if (substr($color, -1) == ',') {
                $color = substr($color, 0, -1);
            }
            $query = "SELECT DISTINCT product.id,product.product_name,product.price
            FROM product, product_has_colors
            WHERE category_id = $category_id
            AND product.id = product_has_colors.product_id
            AND product_has_colors.color_id in ($color)";

        } elseif (empty($color) && empty($price)) {

            if (substr($size, -1) == ',') {
                $size = substr($size, 0, -1);
            }

            $query = "SELECT DISTINCT product.id,product.product_name,product.price
            FROM product, color_has_sizes
            WHERE category_id = $category_id
            AND product.id = color_has_sizes.product_id
            AND color_has_sizes.size_id in ($size)";

        } elseif (empty($color)) {

            if (substr($size, -1) == ',') {
                $size = substr($size, 0, -1);
            }

            $query = "SELECT DISTINCT product.id,product.product_name,product.price
            FROM product, color_has_sizes
            WHERE category_id = $category_id
            AND product.id = color_has_sizes.product_id
            AND product.price < $price
            AND color_has_sizes.size_id in ($size)";

        } elseif (empty($size)) {

            if (substr($color, -1) == ',') {
                $color = substr($color, 0, -1);
            }

            $query = "SELECT DISTINCT product.id,product.product_name,product.price
            FROM product, product_has_colors
            WHERE category_id = $category_id
            AND product.id = product_has_colors.product_id
            AND product.price < $price
            AND product_has_colors.color_id in ($color)";

        } elseif (empty($price)) {

            if (substr($color, -1) == ',') {
                $color = substr($color, 0, -1);
            }
            if (substr($size, -1) == ',') {
                $size = substr($size, 0, -1);
            }

            $query = "SELECT DISTINCT product.id,product.product_name,product.price
            FROM product, color_has_sizes
            WHERE category_id = $category_id
            AND product.id = color_has_sizes.product_id
            AND color_has_sizes.color_id in ($color)
            AND color_has_sizes.size_id in ($size)";

        } else {

            if (substr($color, -1) == ',') {
                $color = substr($color, 0, -1);
            }
            if (substr($size, -1) == ',') {
                $size = substr($size, 0, -1);
            }

            $query = "SELECT DISTINCT product.id,product.product_name,product.price
            FROM product, color_has_sizes
            WHERE category_id = $category_id
            AND product.id = color_has_sizes.product_id
            AND product.price < $price
            AND color_has_sizes.color_id in ($color)
            AND color_has_sizes.size_id in ($size)";

        }

        $query .= $this->sort_product_list($sort);

        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
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
    public function search_product_list($search)
    {
        $query = "SELECT * FROM `product` WHERE product_name like '%$search%';";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return $result;
        }
    }

    public function get_colors_of_product($product_id)
    {
        $query = "SELECT color_id, product_img, color_name FROM `product_has_colors`, `color` WHERE id=color_id and product_id = $product_id;";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return $result;
        }

    }

    public function get_sizes_of_productColor($product_id, $color_id)
    {
        $query = "SELECT size_id, size_name, quantity FROM `color_has_sizes`, `size` WHERE size_id=id and color_id=$color_id and product_id = $product_id;";
        $result = $this->database->select($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return $result;
        }

    }

    public function get_quantity($product_id, $color_id, $size_id)
    {
        $query = "SELECT quantity FROM `color_has_sizes` WHERE size_id=$size_id and color_id=$color_id and product_id = $product_id;";
        $result = $this->database->select($query);
        return $result->fetch_all(MYSQLI_ASSOC)[0]['quantity'];
    }
}