<?php

//修改用户函数
function modify(){
    //var_dump($_POST);
    $id = $_POST['id'];
    //echo $id;//die;
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $repwd = $_POST['repwd'];
    $level = $_POST['level'];
    //判断用户名是否合法6-13位字母
    $pattern = '/^[a-zA-Z]{6,13}$/';
    $result = preg_match($pattern,$username);
    if(!$result){
        echo '<script>alert("用户名不合法");location="./add_modify.php?id='.$id.'"</script>';
    }
    //判断两是否修改了密码
    if(!empty($pwd) && !empty($repwd)){
        if($pwd != $repwd){
            echo '<script>alert("两次密码不一致");location="./add_modify.php?id='.$id.'"</script>';
        }
        //将密码加密
        $pwd = md5($pwd);
        $pwd = ",pwd='$pwd'";
    }elseif(!empty($pwd) || !empty($repwd)){
        echo '<script>alert("两次密码不一致");location="./add_modify.php?id='.$id.'"</script>';
    }
    //判断是否选择了会员等级
    if('xz' == $level){
        echo '<script>alert("请选择会员等级");location="./add_modify.php?id='.$id.'"</script>';
    }
    //将数据写入数据库
    //调用链接数据库函数
    $link = construct();
    $sql = "UPDATE users SET username='$username'$pwd,level=$level WHERE id=$id";
    //echo $sql;die;
    //发送sql语句
    $result = mysqli_query($link,$sql);
    //判断并处理
    if($result && mysqli_affected_rows($link)>0){
        echo '<script>alert("修改会员['.$username.']成功");location="./index.php"</script>';
    }else{
        echo '<script>alert("修改会员['.$username.']失败");location="./add_modify.php?id='.$id.'"</script>';
    }
    //关闭数据库
    mysqli_close($link);
}
//添加用户详细信息
function addInfo(){
    //var_dump($_POST);
    //var_dump($_FILES);
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
    //判断文件上传
    if(!empty($_FILES) && $_FILES['pic']['error']==0){
        //有文件上传
        $upload = upload('pic','../../public/upload/head/');
        $pic = $upload['name'];
    }else{
        echo '<script>alert("没有选择图片");location="add_modify_info.php?id='.$id.'&username='.$username.'"</script>';
    }
    $link = construct();
    $sql = "INSERT INTO user_info(uid,realname,sex,age,phone,email,education,income,pic,address,maritalStatus,hobby) VALUES($id,'$realname',$sex,$age,'$phone','$email',$education,$income,'$pic','$address',$maritalStatus,'$hobby')";
    //echo $sql;
    $result = mysqli_query($link,$sql);
    //var_dump($result);die;
    if($result && mysqli_affected_rows($link)>0){
        echo '<script>alert("添加成功");location="add_modify_info.php?id='.$id.'&username='.$username.'"</script>';
    }else{
        echo '<script>alert("添加失败");location="add_modify_info.php?id='.$id.'&username='.$username.'"</script>';
    }
}

//默认选中
function defaultSelected(array $row,$name,$selected){
    $zero = $one = $two = $three = '';
    //var_dump($row[$name]);
    $select = array();
    if($row[$name]=='0'){
        $select[0]= "$selected";
    }elseif($row[$name]=='1'){
        $select[1] = "$selected";
    }elseif($row[$name]=='2'){
        $select[2] = "$selected";
    }elseif($row[$name]=='3'){
        $select[3] = "$selected";
    }
    //var_dump($select);
    return $select;
}