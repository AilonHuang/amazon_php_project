<?php
//引入函数文件
require '../../public/function.php';
//包含数据库配置文件
require '../../public/dbconfig.php';
require './user_func.php';
//判断是做什么操作
//var_dump($_GET);

switch($_GET['act']){
    case 'add': //添加
        add();break;
    case 'modify': //修改
        modify();break;
    case 'del': //删除放入回收再
        del();break;
    case 'realDel': //真正删除
        realDel();break;
    case 'addInfo': //添加详细信息
        addInfo();break;
    case 'modifyInfo':
        modifyInfo();break; //修改详细信息
    case 'recover':  //恢复回收站
        recover();break;
    case 'delSelected'; //批量删除.放入回收站
        delSelected();break;
    case 'selected':
        //echo '批量';
        if($_POST) {
            if (isset($_POST['realDelSelected'])?$_POST['realDelSelected']:'') {
                realDelSelected();
            } elseif ($_POST['recoverSelected']?$_POST['recoverSelected']:'') {
                recoverSelected();
            }
        }
        break;

}
//修改用户详细信息
function modifyInfo(){
    //echo '修改';
    //var_dump($_POST);
    //var_dump($_GET);//die;
    $id = $_POST['id'];
    $username = $_POST['username'];
    $realname = $_POST['realName'];
    $sex = $_POST['sex'];
    $age= $_POST['age'];
    $phone= $_POST['phone'];
    $email = $_POST['email'];
    $education = $_POST['education'];
    $income = $_POST['income'];
    $address = $_POST['address'];
    $maritalStatus = $_POST['maritalStatus'];
    $hobby = $_POST['hobby'];
    //处理爱好
    $hobby = implode(',',$hobby);
    //判断是否修改了图片
    if($_FILES['pic']['error']==0){
        //有文件上传
        $upload = upload('pic','../../public/upload/head/');
        $pic = $upload['name'];
        $sql = "UPDATE user_info SET realname='$realname',sex=$sex,age=$age,phone=$phone,email='$email',education='$education',income=$income,pic='$pic',address='$address',maritalStatus=$maritalStatus,hobby='$hobby' WHERE uid=$id";
    }else{
        $pic = '';
        $sql = "UPDATE user_info SET realname='$realname',sex=$sex,age=$age,phone=$phone,email='$email',education='$education',income=$income,address='$address',maritalStatus=$maritalStatus,hobby='$hobby' WHERE uid=$id";
    }
    //echo $sql;//die;
    $link = construct();
    $result = mysqli_query($link,$sql);
    //var_dump($result);die;
    if($result && mysqli_affected_rows($link)){
        echo '<script>alert("修改成功");location="add_modify_info.php?id='.$id.'&username='.$username.'";</script>';
    }else{
        echo '<script>alert("修改失败");location="add_modify_info.php?id='.$id.'&username='.$username.'";</script>';
    }
}
function realDelSelected(){
    //var_dump($_POST);die;
    if(!isset($_POST['check'])?true:false){
        echo '<script>alert("没有选择");location="recycle.php"</script>';
    }else {
        $ids = implode(',', $_POST['check']);
        //echo $ids;
        $link = construct();
        $sql = "DELETE FROM users WHERE isdel=1 AND id IN ($ids)";
        //echo $sql;die;
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_affected_rows($link) > 0) {
            echo '<script>alert("删除成功");location="recycle.php"</script>';
        } else {
            echo '<script>alert("删除失败");location="recycle.php"</script>';
        }
        mysqli_close($link);
    }
}
function recoverSelected(){
    if(!isset($_POST['check'])?true:false){
        echo '<script>alert("没有选择");location="recycle.php"</script>';
    }else {
        $ids = implode(',', $_POST['check']);
        $link = construct();
        $sql = "UPDATE users SET isdel=0 WHERE id IN ($ids)";
        //echo $sql;die;
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_affected_rows($link) > 0) {
            echo '<script>alert("恢复成功");location="recycle.php"</script>';
        } else {
            echo '<script>alert("恢复失败");location="recycle.php"</script>';
        }
        mysqli_close($link);
    }
}
function delSelected(){
    //var_dump($_POST);die;
    if(!isset($_POST['check'])?true:false){
        echo '<script>alert("没有选择");location="index.php"</script>';
    }else {
        $ids = implode(',', $_POST['check']);
        //echo $ids;
        $link = construct();
        $sql = "UPDATE users SET isdel=1 WHERE id IN ($ids)";
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

	

