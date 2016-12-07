<?php
session_start();
//var_dump($_POST);
require '../../public/function.php';
require_once '../../public/dbconfig.php';
$link = construct();
$sql = "SELECT * FROM goods WHERE id={$_GET['id']}";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
$num = isset($_POST['num'])?$_POST['num']:1;
//var_dump($row);
$row['num'] = isset($num)?$num:1;
if(isset($_SESSION['cart'][$row['id']])){
    $_SESSION['cart'][$row['id']]['num']+=$num;
    //var_dump($_SESSION);die;
}else{
    $_SESSION['cart'][$row['id']] = $row;
}
//var_dump($_SESSION);
echo '1s后自动跳转到购物车页面';
//给用户提示信息
echo '<meta http-equiv="refresh" content="1;url=./showCart.php"/>';

echo '<br><a href="../index.php">点我继续购物</a>';

