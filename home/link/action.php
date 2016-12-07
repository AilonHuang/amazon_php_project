<?php
//var_dump($_POST);
$name = isset($_POST['name'])?$_POST['name']:'';
$url = isset($_POST['url'])?$_POST['url']:'';
if(!$name){
    echo '<script>alert("请输入公司名称");location="index.php?name='.$name.'&url='.$url.'"</script>';
}elseif(!$url){
    echo '<script>alert("请输入公司url");location="index.php?name='.$name.'&url='.$url.'"</script>';
}
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';

$link = construct();
$sql = "INSERT INTO link(name,url) VALUES('$name','$url')";
//echo $sql;
$result = mysqli_query($link,$sql);
if($result && mysqli_affected_rows($link)){
    echo '<script>alert("提交成功，等待管理员审核");location="../index.php";</script>';
}