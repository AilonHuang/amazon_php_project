<?php
//添加用户函数
/**
 *
 */
function add(){
    //var_dump($_POST);
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $repwd = $_POST['repwd'];
    $level = $_POST['level'];
    //判断表单是否填写
    if(!$username){//判断用户名是否为空
        echo '<script>alert("请输入用户名");location="./add_modify.php"</script>';
    }else{
        if(!$pwd){//用户名不空，判断密码是否为空
            echo '<script>alert("请输入密码");location="./add_modify.php?username='.$username.'"</script>';
        }else {
            if (!$repwd) {//密码不为空，判断重复密码是否为空
                echo '<script>alert("请输入重复密码");location="./add_modify.php?username=' . $username . '"</script>';
            } else{
                if ('xz' == $level) {
                    echo '<script>alert("请选择会员等级");location="./add_modify.php?username=' . $username . '"</script>';
                } else{

                    if ($pwd != $repwd) {//密码和重复密码都不为空，判断两次密码是否一致
                        echo '<script>alert("两次密码不一致");location="./add_modify.php?username=' . $username . '"</script>';
                    }else{
                        //表单填写完成，进行正则匹配
                        //用户名匹配，6-13位字母
                        //echo '123';
                        $patternUser = '/^[a-zA-Z]{6,13}$/';
                        $user = preg_match($patternUser,$username);
                        //密码匹配，6-13位字母
                        $patternPwd = '/^[a-zA-Z]{6,13}$/';
                        $pwd = preg_match($patternPwd,$pwd);
                        $repwd = preg_match($patternPwd,$repwd);
                        //echo '123';
                        if(!$user){//判断用户名是否合法
                            echo '<script>alert("用户名不合法");location="./add_modify.php?username='.$username.'"</script>';
                        }elseif(!$pwd || !$repwd){//两次密码一致，进行正则匹配
                            echo '<script>alert("密码不合法");location="./add_modify.php?username='.$username.'"</script>';
                        }else{//密码和用户名都合法，判断数据库是否有相同的用户名，没有则将数据写入数据库
                            //调用链接数据库函数
                            $link = construct();
                            $sql = "SELECT username FROM users WHERE username='$username'";
                            //echo $sql;die;
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)>0){
                                echo '<script>alert("添加会员['.$username.']失败，用户名已存在");location="./add_modify.php?username='.$username.'"</script>';
                            }else{
                                //将密码加密
                                $pwd = md5($pwd);
                                //获得当前时间
                                $time = time();
                                $sql = "INSERT INTO users(username,pwd,level,addtime) VALUE('$username','$pwd',$level,$time)";
                                //echo $sql;
                                //发送sql语句
                                $result = mysqli_query($link,$sql);
                                //判断并处理
                                if($result && mysqli_affected_rows($link)>0){
                                    echo '<script>alert("添加会员['.$username.']成功");location="./index.php"</script>';
                                }else{
                                    echo '<script>alert("添加会员['.$username.']失败");location="./add_modify.php"</script>';
                                }

                            }
                            //关闭数据库
                            mysqli_close($link);
                        }
                    }
                }
            }
        }

    }
}
//删除用户到回收站函数
function del(){
    $id = $_GET['id'];
    //var_dump($_GET);
    $link = construct();
    $sql = "UPDATE users SET isdel=1 WHERE id=$id";
    //echo $sql;die;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)>0){
        echo '<script>alert("删除成功,已加入回收站");location="index.php"</script>';
    }else{
        echo '<script>alert("删除失败");location="index.php"</script>';
    }
    //关闭数据库
    mysqli_close($link);
}
//恢复回收站用户
function recover(){
    $id = $_GET['id'];
    //var_dump($_GET);
    $link = construct();
    $sql = "UPDATE users SET isdel=0 WHERE id=$id";
    //echo $sql;die;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)>0){
        echo '<script>alert("恢复成功");location="recycle.php"</script>';
    }else{
        echo '<script>alert("恢复失败");location="recycle.php"</script>';
    }
    //关闭数据库
    mysqli_close($link);
}
//真正删除用户
function realDel(){
    $id = $_GET['id'];
    //var_dump($id);
    $link = construct();
    $sql = "DELETE users,user_info from users LEFT JOIN user_info ON users.id=user_info.uid WHERE users.id=$id";
    //echo$sql;
    $result = mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)>0){
        echo '<script>alert("删除成功");location="recycle.php"</script>';
    }else{
        echo '<script>alert("删除失败");location="recycle.php"</script>';
    }
}
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

//搜索用户函数
/**
 * @return array 搜索关键字和where语句
 */
function search(){
    //var_dump($_GET);
    //获取搜索关键字
    $arr['keywords'] = isset($_GET['keywords'])?$_GET['keywords']:'';
    //var_dump(isset($arr['keywords']));
    //获取搜索level
    $arr['level'] = isset($_GET['level'])?$_GET['level']:'';
    //获取搜索sex
    $arr['sex'] =isset($_GET['sex'])?$_GET['sex']:'';
    //获取id号区间
    $arr['id1'] = isset($_GET['id1'])?$_GET['id1']:'';
    $arr['id2'] = isset($_GET['id2'])?$_GET['id2']:'';
    //判断是否选择了性别
    if($arr['sex'] ==""){
        $sex = '';
    }else{
        $arr['sex'] = implode(',',$arr['sex']);
        $sex = "AND id IN(SELECT uid FROM user_info WHERE sex IN({$arr['sex']}))";
    }

    //var_dump($arr['sex']);
    //默认搜索语句
    $keywords = " AND username LIKE '%{$arr['keywords']}%'";
    //var_dump($keywords);
    $level = "AND level={$arr['level']}";
    if(($arr['id1'])!='' && $arr['id2']==''){
        $id = "AND id=>{$arr['id1']}";
    }elseif($arr['id1']=='' && $arr['id2']!=''){
        $id = "AND id<={$arr['id2']}";
    }else {
        $id = "AND id BETWEEN {$arr['id1']} AND {$arr['id2']}";
    }
    //var_dump($sex);
    //判断是否有关键字
    if(!$arr['keywords']){
        $keywords = '';
    }
    //判断是否选择了等级
    if($arr['level'] ==""){
        $level = '';
    }
    //判断是否选择了等级
    if($arr['id1'] =="" && $arr['id2'] ==""){
        $id = '';
    }

    $arr['sql'] = "$keywords $level $sex $id";
    //var_dump($arr);
    return $arr;
}
//统计会员个数
function countUser(){
    $link = construct();

    $sql['all'] = "SELECT id FROM users WHERE isdel = 0";
    $sql['com'] = "SELECT id FROM users WHERE level = 0 AND isdel = 0";
    $sql['vip'] = "SELECT id FROM users WHERE level=1 AND isdel = 0";
    $sql['dis'] = "SELECT id FROM users WHERE level=2 AND isdel = 0";
    $sql['su'] = "SELECT id FROM users WHERE level=3 AND isdel = 0";
    //var_dump($sql);
    foreach($sql as $k =>$v){
        $result = mysqli_query($link,$v);
        $num[$k] = mysqli_num_rows($result);
    }
    return $num;
}

//分页处理函数
/**
 * @param $page 定义每页多少条
 * @param $link mysqli_connect()打开的资源
 * @param $like 搜索的like语句
 * @return array 返回一个分页数组下一页 上一页 总页数 limit语句
 */
function page($page,$link,$sql,$isdel=0){
    //查询一共多少条
    $sql = "SELECT * FROM users WHERE isdel=$isdel $sql";
    //echo$sql;//die;
    $result = mysqli_query($link,$sql);
    $arr['num']= mysqli_num_rows($result);
    //求出总页数
    $arr['all'] = ceil($arr['num']/$page);
    //获得当前页
    $arr['dPage'] = isset($_GET['page'])?$_GET['page']:1;
    //处理下一页
    $arr['next'] =  $arr['dPage']+1>$arr['all']?$arr['all']: $arr['dPage']+1;
    //处理上一页
    $arr['pre'] =  $arr['dPage']-1<1?1: $arr['dPage']-1;
    //制作limit语句
    $num = ( $arr['dPage']-1)*$page;
    $arr['limit'] = "LIMIT $num,$page";
    return $arr;
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