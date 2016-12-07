<?php
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
//var_dump($_GET);
switch($_GET['act']){
    case 'add':
        add();break;
    case 'del':
        del();break;
    case 'tongyi':
        tongyi();break;
    case 'jujue':
        juju();break;
    case 'modify':
        modify();break;
}
function modify(){
    //var_dump($_POST);
    $id = $_GET['id'];
    $name = isset($_POST['name'])?$_POST['name']:'';
    $url = isset($_POST['url'])?$_POST['url']:'';
    if(!$name){
        echo '<script>alert("请输入公司名称");location="add_modify.php?name='.$name.'&url='.$url.'"</script>';
    }elseif(!$url){
        echo '<script>alert("请输入公司url");location="add_modify.php?name='.$name.'&url='.$url.'"</script>';
    }
    require_once '../../public/function.php';
    require_once '../../public/dbconfig.php';

    $link = construct();
    $sql = "UPDATE link SET name='$name',url='$url' WHERE id=$id";
    //echo $sql;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)){
        echo '<script>alert("修改成功");location="index.php";</script>';
    }else{
        echo '<script>alert("修改失败");location="index.php";</script>';
    }
}
function jujue(){
    require_once '../../public/function.php';
    require_once '../../public/dbconfig.php';
    $id = $_GET['id'];
    $link = construct();
    $sql = "DELETE FROM link WHERE id=$id";
//echo $sql;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)){
        echo '<script>alert("已拒绝");location="shenqing.php";</script>';
    }
}
function del(){
    require_once '../../public/function.php';
    require_once '../../public/dbconfig.php';
    $id = $_GET['id'];
    $link = construct();
    $sql = "DELETE FROM link WHERE id=$id";
//echo $sql;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)){
        echo '<script>alert("删除成功");location="index.php";</script>';
    }
}
function tongyi(){
    require_once '../../public/function.php';
    require_once '../../public/dbconfig.php';
    $id = $_GET['id'];
    $link = construct();
    $sql = "UPDATE link SET status=1 WHERE id=$id";
//echo $sql;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)){
        echo '<script>alert("操作成功");location="index.php";</script>';
    }
}
function add(){
    //var_dump($_POST);
    $name = isset($_POST['name'])?$_POST['name']:'';
    $url = isset($_POST['url'])?$_POST['url']:'';
    if(!$name){
        echo '<script>alert("请输入公司名称");location="add_modify.php?name='.$name.'&url='.$url.'"</script>';
    }elseif(!$url){
        echo '<script>alert("请输入公司url");location="add_modify.php?name='.$name.'&url='.$url.'"</script>';
    }
    require_once '../../public/function.php';
    require_once '../../public/dbconfig.php';

    $link = construct();
    $sql = "INSERT INTO link(name,url,status) VALUES('$name','$url',1)";
//echo $sql;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)){
        echo '<script>alert("添加成功");location="index.php";</script>';
    }
}