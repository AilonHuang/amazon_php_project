<?php
//引入函数文件
require '../../public/function.php';
//包含数据库配置文件
require '../../public/dbconfig.php';
require './user_func.php';
//判断是做什么操作
//var_dump($_GET);

switch($_GET['act']){
    case 'modify'://修改
        modify();break;
    case 'addInfo'://添加详细信息
        addInfo();break;
    case 'modifyInfo':
        modifyInfo();break;


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
        echo '<script>alert("修改成功");location="member_center.php?id='.$id.'&username='.$username.'";</script>';
    }else{
        echo '<script>alert("修改失败");location="member_center.php?id='.$id.'&username='.$username.'";</script>';
    }
}


	

