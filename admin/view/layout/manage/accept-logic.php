<?php 
    if(isset($_POST['orderid'])){
        $order_id = $_POST['orderid'];
    }
    $order_model = new OrderModel();
    $order_model->__setAccept($order_id);
