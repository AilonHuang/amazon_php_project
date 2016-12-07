<?php
//引入函数文件
require '../../public/function.php';
//包含数据库配置文件
require '../../public/dbconfig.php';
require './order_func.php';
//判断是做什么操作
//var_dump($_GET);
//var_dump($_POST);
switch($_GET['act']) {
    case 'modify': //修改
        modify();break;
}

function modify(){
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $link = construct();

    $sql = "UPDATE orders SET phone=$phone,address='$address',status=$status WHERE id={$_POST['id']}";
    //echo $sql;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)>0){
        echo '<script>alert("修改成功");location="index.php"</script>';
    }
}