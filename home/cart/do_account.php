<?php
session_start();
//var_dump($_POST);
//var_dump($_SESSION);
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
//var_dump($_POST);
//var_dump($_GET);//die;
$link = construct();
$sql = "UPDATE orders SET status=1 WHERE id={$_GET['id']}";
//echo $sql;//die;
$result= mysqli_query($link,$sql);
if($result && mysqli_affected_rows($link)>0){
    $_SESSION['cart']=array();
    echo '<script>alert("结算成功");location="../order/order_goods.php";</script>';
}else{
    echo '<script>alert("结算失败");location="../order/order_goods.php";</script>';
}


