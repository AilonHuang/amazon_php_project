<?php
session_start();
//var_dump($_SESSION);
//var_dump($_POST);
//die;
require_once '../public/function.php';
require_once '../public/dbconfig.php';
$username=isset($_POST['username'])?$_POST['username']:'';
$username=addslashes($username);
$password=isset($_POST['pwd'])?$_POST['pwd']:'';
$verify=$_POST['verify'];
$verify1=$_SESSION['verify'];
//$pwd = $_POST['pwd'];
//echo $pwd;
//echo $password;die;
$password = trim($password);
if(!$username){
    echo '<script>alert("请输入用户名");location="./login.php?username='.$username.'";</script>';
}elseif(!$password){
    echo '<script>alert("请输入密码");location="./login.php?username='.$username.'";</script>';
}elseif(!$verify){
    echo '<script>alert("请输入验证码");location="./login.php?username='.$username.'";</script>';
}elseif(strtolower($verify)!=strtolower($verify1)) {
    echo '<script>alert("验证码不整确");location="./login.php?username='.$username.'";</script>';
}else{
    $password = md5($password);
    //echo $password;die;
    $sql = "select * from users where level != 2 AND username='{$username}' and pwd='{$password}'";
    //echo $sql;die;
    $link = construct();
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
//    var_dump($row);die;
    if ($row) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['userid'] = $row['id'];
        $_SESSION['islogin'] = true;
        echo '<script>alert("登陆成功");location="./index.php";</script>';
    } else {
        echo '<script>alert("登陆失败，用户名或密码错误，请重新登陆");location="login.php"</script>';
    }
}