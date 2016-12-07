<?php

//var_dump($_POST);
//var_dump($_GET);
//die;
//var_dump($_FILES);
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
switch($_GET['act']){
    case 'add':
        add();break;
    case 'modify':
        modify();break;
    case 'delSelected':
        delSelected();break;
}


function add(){
    $type = $_POST['type'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $store = $_POST['store'];
    $company = $_POST['company'];
    $state = $_POST['state'];
    $desc = $_POST['desc'];
    $time = time();
    //判断是否选择了图片
    if(!$_FILES['pic']['error']==0){
        //没有图片上传
        echo '<script>alert("请选择图片");location="add_modify.php"</script>';
    }

    //图片上传
    //include '../../public/function.php';
    $upload = upload('pic','../../public/upload/goods/');
    //var_dump($upload);
    $pic = $upload['name'];

    $link = construct();
    $sql = "INSERT INTO goods(`typeid`,`name`,`price`,`company`,`desc`,`pic`,`store`,`state`,`addtime`) VALUES($type,'$name',$price,'$company','$desc','$pic',$store,$state,$time)";
    //echo $sql;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)>0){
        echo '<script>alert("添加成功");location="./index.php"</script>';
    }else{
        echo '<script>alert("添加失败");location="./add_modify.php"</script>';
    }
}

function modify(){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $store = $_POST['store'];
    $company = $_POST['company'];
    $state = $_POST['state'];
    $desc = $_POST['desc'];
    $id = $_GET['id'];
    $typeid = $_POST['type'];
    //echo $id;
    //判断是否修改了图片
    if($_FILES['pic']['error']==0){
        //有文件上传
        $upload = upload('pic','../../public/upload/goods/');
        $pic = $upload['name'];
        $sql = "UPDATE goods SET typeid=$typeid,`name`='$name',price=$price,store=$store,company='$company',state=$state,`desc`='$desc',`pic`='$pic' WHERE id=$id";
    }else{
        $pic = '';
        $sql = "UPDATE goods SET typeid=$typeid,`name`='$name',price=$price,store=$store,company='$company',state=$state,`desc`='$desc' WHERE id=$id";
    }
    //echo $sql;//die;
    $link = construct();
    $result = mysqli_query($link,$sql);
    //var_dump($result);die;
    if($result && mysqli_affected_rows($link)){
        echo '<script>alert("修改成功");location="index.php";</script>';
    }else{
        echo '<script>alert("修改失败");location="add_modify.php?id='.$id.'&typeid='.$typeid.'";</script>';
    }

}
function delSelected(){
    if(!isset($_POST['check'])?true:false){
        echo '<script>alert("没有选择");location="index.php"</script>';
    }else {
        $ids = implode(',', $_POST['check']);
        //echo $ids;
        $link = construct();
        $sql = "DELETE FROM goods WHERE id IN ($ids)";
        //echo $sql;die;
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_affected_rows($link) > 0) {
            echo '<script>alert("删除成功");location="index.php"</script>';
        } else {
            echo '<script>alert("删除失败");location="index.php"</script>';
        }
        mysqli_close($link);
    }
}
