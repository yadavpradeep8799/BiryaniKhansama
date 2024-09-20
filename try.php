<?php
session_start();
$code=array();
require_once("dbcontroller.php");
$db_handle = new DBController();
$db_handle1 = new DBController();
$productByCode = $db_handle->runQuery("SELECT item_id,transaction_id,item_qty,amount,order_date,status FROM orders");
foreach ($productByCode  as $value) {
    echo "<b>Total Order Amount: </b>".$value['amount'];
    echo "<br>";
    echo "<b>Transaction ID: </b>".$value['transaction_id'];
    echo "<br>";
    echo "<br>";
    echo "<b>Order Date: </b>".$value['order_date'];
    echo "<br>";
    echo "<b>Order Status: </b>".$value['status'];
    echo "<br>";
    $string_arr=explode("-",$value['item_id']);
    $string_arr1=explode("-",$value['item_qty']);
    foreach ($string_arr  as $v){
        $x=0;
        $code = $db_handle1->runQuery("SELECT item_name,price FROM item where item_id='$v'");
        if($code==null){
        }
        else{
        foreach ($code as $vl){
            echo "<b>Item Name: </b>".$vl['item_name'];
            echo "<br>";
            echo "<b>Quantity: </b>"."$string_arr1[$x]";
            echo "<br>";
            echo "<b>Item Price: </b>".$vl['price'];
            echo "<br>";
            echo "<br>";
            $x++;
        }}
    }
    echo "<hr>";
}

?>