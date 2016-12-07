<?php
session_start();
/*var_dump($_SESSION);
var_dump($_POST);*/
//die;
require_once '../public/function.php';
require_once '../public/dbconfig.php';

$username=$_POST['username'];
$username=addslashes($username);
$password=md5($_POST['password']);
$verify=$_POST['verify'];
$verify1=$_SESSION['verify'];

if(strtolower($verify)==strtolower($verify1)){
	$sql="select * from users where level = 3 AND username='{$username}' and pwd='{$password}'";
    //echo $sql;
	$link = construct();
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
//    var_dump($row);die;
	if($row){
		$_SESSION['adminName']=$row['username'];
		$_SESSION['adminId']=$row['id'];
        $_SESSION['islogin'] = true;
		echo '<script>alert("登陆成功");location="index.php"</script>';
	}else{
        echo '<script>alert("登陆失败，重新登陆");location="login.php"</script>';
	}
}else{
    echo '<script>alert("验证码错误");location="login.php"</script>';
}