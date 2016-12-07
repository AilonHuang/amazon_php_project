<?php
session_start();
//var_dump($_SESSION);
//var_dump($_POST);
//die;
require_once '../public/function.php';
require_once '../public/dbconfig.php';

$username=isset($_POST['username'])?$_POST['username']:'';
$username=addslashes($username);

$verify=isset($_POST['verify'])?$_POST['verify']:'';
$verify1=$_SESSION['verify'];
$time = time();
$pwd = isset($_POST['pwd'])?$_POST['pwd']:'';
$repwd = isset($_POST['repwd'])?$_POST['repwd']:'';

if(!$username){
    echo '<script>alert("请输入用户名");location="./signin.php?username='.$username.'";</script>';
}elseif(!$pwd){    echo'1ww';
    echo '<script>alert("请输入密码");location="./signin.php?username='.$username.'";</script>';
}elseif(!$repwd){
    echo '<script>alert("请输入重复密码");location="./signin.php?username='.$username.'";</script>';
}elseif(!$verify){
    echo '<script>alert("请输入验证码");location="./signin.php?username=' . $username . '";</script>';
}elseif($pwd != $repwd){
    echo '<script>alert("两次密码不一致");location="./signin.php?username='.$username.'";</script>';
}elseif(strtolower($verify)!=strtolower($verify1)) {
    echo '<script>alert("验证码不正确");location="./signin.php?username=' . $username . '";</script>';
}else{
    //表单填写完成，进行正则匹配
    //用户名匹配，6-13位字母
    $patternUser = '/^[a-zA-Z]{6,13}$/';
    $user = preg_match($patternUser,$username);
    //密码匹配，6-13位字母
    $patternPwd = '/^[a-zA-Z]{6,13}$/';
    $pwd = preg_match($patternPwd,$pwd);
    $repwd = preg_match($patternPwd,$repwd);

    if(!$user){//判断用户名是否合法
        echo '<script>alert("用户名不合法");location="./signin.php?username='.$username.'"</script>';
    }elseif(!$pwd || !$repwd){//两次密码一致，进行正则匹配
        echo '<script>alert("密码不合法");location="./signin.php?username='.$username.'"</script>';
    }else {//密码和用户名都合法，判断数据库是否有相同的用户名，没有则将数据写入数据库
        $pwd = md5($_POST['pwd']);
        //echo $pwd;die;
        $sql = "select * from users where username='{$username}'";
        //echo $sql;
        $link = construct();
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        //var_dump($row);
        if ($row) {
            echo '<script>alert("用户名已存在");location="./signin.php?username='.$username.'";</script>';
        } else {
            $sql = "INSERT INTO users(username,pwd,addtime) VALUES ('$username','$pwd',$time)";
            //echo $sql;die;
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_affected_rows($link) > 0) {
                echo '<script>alert("注册成功");location="login.php";</script>';
            } else {
                echo '<script>alert("注册成功失败");location="./signin.php?username='.$username.'";</script>';
            }
        }
    }
}