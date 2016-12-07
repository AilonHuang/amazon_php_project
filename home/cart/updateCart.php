<?php
session_start();
//var_dump($_SESSION);
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
$link = construct();
$sql = "SELECT store FROM goods WHERE id={$_GET['id']}";
//echo $sql;
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
var_dump($row);
if(isset($_GET['id'])&& isset($_GET['num'])){
    $_SESSION['cart'][$_GET['id']]['num'] += $_GET['num'];
    if($_SESSION['cart'][$_GET['id']]['num'] <= 1){
        $_SESSION['cart'][$_GET['id']]['num'] = 1;
    }
    if($_SESSION['cart'][$_GET['id']]['num'] >= $row['store']){
        $_SESSION['cart'][$_GET['id']]['num'] = $row['store'];
    }
    header('location:./showCart.php');
}

