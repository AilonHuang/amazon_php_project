<?php
session_start();
//退出登录

//session_name（）获取session的名称
//1.使客户端COOKIE过期，让sessionid失效
setcookie(session_name(),null,time()-1,'/');
//2.清除当前页面session数组中的值
$_SESSION['user'] = array();
//3.摧毁服务器的SESSION文件
//session_destroy();

echo '<script>alert("退出成功");location="./login.php"</script>';