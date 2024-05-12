<?php
class Account
{

    public function __construct()
    {

        require('../model/userModel.php');

        $userModel = new UserModel();
       
    }

   public function getInformation(){

   }
}