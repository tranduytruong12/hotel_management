<?php

include_once "controller.php";
include_once "../lib/database.php";
include_once "../lib/session.php";
include_once "../model/product_model.php";
include_once "../model/color_model.php";
include_once "../model/size_model.php";

class CartController extends Controller {
    private $db; 
    private $session;

    public function __construct()
    {
        $this->db = new Database();
        $this->session = new Session();
    }

    public function invoke() {
        if (!isset($_SESSION["user-id"])) {
            return;
        }

        parent::controlHeader();
        $this->controlContent();
        parent::controlFooter();
    }

}