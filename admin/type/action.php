<?php


//var_dump($_GET);
//var_dump($_POST);//die;
include '../../public/function.php';
//包含数据库配置文件
require '../../public/dbconfig.php';
include 'type_func.php';

switch($_GET['act']){
    case 'add':
        add();break;
    case 'modify':
        modify();break;
}

function modify(){
    //调用数据库链接函数
    $link = construct();
    //判断是改名还是改分类
    //获取要操作数据的id name pid
    $id=$_GET['id'];
    $name = $_POST['name'];
    $pid = $_GET['pid'];
    //获取要移入类别的path
    $path = $_POST['path'];
    //获取要移入类别的pid ,作为pid
    if(!$path == 0) {
        $pid2 = ltrim(strrchr($path, ','), ',');
    }else{
        $pid2=$path;
    }
    echo '<br>';

    if ($pid == $pid2) {//如果$pid == $pid2 没有修改分类
        //改名
        //echo '改名';
        $sql = "UPDATE type SET name='$name' WHERE id=$id";
        $result = mysqli_query($link,$sql);
        if($result && mysqli_affected_rows($link)){
            echo '<script>alert("修改成功");location="./index.php"</script>';
        }else{
            echo '<script>alert("修改失败");location="add_modify.php?id='.$id.'&pid='.$pid.'&act=modify&name='.$name.'"</script>';
        }
    } else {
        //改分类
        //echo '改分类';//0,1,3
        $path = $path.',';
//        //移动父类
//        $sql = "UPDATE type SET name='$name',pid=$pid2,path='$path' WHERE id=$id";
//        $result = mysqli_query($link,$sql);
//        var_dump($sql);
        //判断是否有子类
        $sql = "SELECT id FROM type WHERE pid=$id";
        //var_dump($sql);
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) > 0) {//有子类
            //移动父类
            $sql = "UPDATE type SET name='$name',pid=$pid2,path='$path' WHERE id=$id";
            mysqli_query($link,$sql);
            //var_dump($sql);
            $path = $path.$id;
            while ($row = mysqli_fetch_assoc($result)) {
                //var_dump($row);
                //先将子类移动
                $p = $path.',' ;
                // echo $path;
                $sql = "UPDATE type SET pid=$id,path='$p' WHERE id={$row['id']}";
                //var_dump($sql);
                $r = mysqli_query($link,$sql);
            }
            if($r && mysqli_affected_rows($link)){
                echo '<script>alert("修改成功");location="./index.php"</script>';
            }else{
                echo '<script>alert("修改失败");location="add_modify.php?id='.$id.'&pid='.$pid.'&act=modify&name='.$name.'"</script>';
            }
        }else{
            //移动父类
            $sql = "UPDATE type SET name='$name',pid=$pid2,path='$path' WHERE id=$id";
            $result = mysqli_query($link,$sql);
            var_dump($sql);
            if($result && mysqli_affected_rows($link)){
                echo '<script>alert("修改成功");location="./index.php"</script>';
            }else{
                echo '<script>alert("修改失败");location="add_modify.php?id='.$id.'&pid='.$pid.'&act=modify&name='.$name.'"</script>';
            }
        }
    }
}