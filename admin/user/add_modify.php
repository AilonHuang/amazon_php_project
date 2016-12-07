<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script type="text/javascript"></script>
	<title>Insert title here</title>
</head>
<?php
//引入函数库
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
require_once './user_func.php';
//判断是添加还是删除
if(!isset($_GET['id'])){
	$title = '添加用户';
	$action = 'action.php?act=add';
	$input = '<td colspan="3" align="center"><input type="submit"  value="添加用户"/></td>';
}else{
	$id = $_GET['id'];
	//echo $id;
	$title =  '修改用户';
	$action = 'action.php?act=modify';
	$input = '<input type="hidden" name="id" value="'.$id.'"><td colspan="3" align="center"><input type="submit"  value="修改用户"/></td>';
	//链接数据库
	$link = construct();
	$sql = "SELECT * FROM users WHERE id=$id";
	//echo $sql;
	$result = mysqli_query($link,$sql);
	//var_dump($result);
	if($result && mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
	}
	//var_dump($row);
	//调用默认选择函数
	$selected = defaultSelected($row,'level','selected');
	//var_dump($selected);

}
?>
<body>
<h3><?php echo $title?></h3>
<form action="<?php echo $action?>" method="post" enctype="multipart/form-data">
	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<td align="right">用户名</td>
			<td><input type="text" name="username" value="<?php echo isset($row['username'])?$row['username']:''; echo isset($_GET['username'])?$_GET['username']:'' ?>" placeholder="请输入用户名"/>6-13位英文字母</td>
		</tr>
		<tr>
			<td align="right">密码</td>
			<td><input type="password" name="pwd" />6-13位字母</td>
		</tr>
		<tr>
			<td align="right">重复密码</td>
			<td><input type="password" name="repwd" />6-13位字母</td>
		</tr>
		<!--	<tr>
                <td align="right">邮箱</td>
                <td><input type="text" name="email" placeholder="请输入管理员邮箱"/></td>
            </tr>-->
		<!--<tr>
            <td align="right">性别</td>
            <td><label><input type="radio" name="sex" value="0" checked="checked"/>女<label>
            <label><input type="radio" name="sex" value="1" />男</label>
            <label><input type="radio" name="sex" value="2" />保密</label>
            </td>
        </tr>-->
		<tr>
			<td align="right">会员等级</td>
			<td>
				<select name="level">
					<option value="xz">--请选择--</option>
					<option value="0" <?php echo isset($selected[0])?$selected[0]:''?>>普通会员</option>
					<option value="1" <?php echo isset($selected[1])?$selected[1]:''?>>VIP会员</option>
					<option value="2" <?php echo isset($selected[2])?$selected[2]:''?>>禁用</option>
					<option value="3" <?php echo isset($selected[3])?$selected[3]:''?>>超级会员</option>
				</select>
			</td>
		</tr>
		<!-- 	<tr>
                 <td align="right">头像</td>
                 <td><input type="file" name="myFile" /></td>
             </tr> -->
		<tr>
			<?php echo $input?>
		</tr>

	</table>
</form>
</body>
</html>