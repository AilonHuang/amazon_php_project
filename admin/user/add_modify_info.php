
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>-.-</title>
	<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
</head>
<?php
//引入函数文件
require '../../public/function.php';
require_once '../../public/dbconfig.php';
require_once './user_func.php';
//var_dump($_GET);
//判断是添加还是删除
$id = $_GET['id'];
$link = construct();
$sql = "SELECT * FROM user_info WHERE uid=$id";
//echo $sql;
$result = mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
	//查询到数据，是修改
	$title = '修改详细信息';
	$row = mysqli_fetch_assoc($result);
	$action = 'modifyInfo';
	$input = '<td colspan="2" align="center"><input type="submit"  value="修改信息"/>';
	//var_dump($row);
}else{
	//查询不到数据，是添加
	$title = '添加详细信息';
	$action = 'addInfo';
	$input = '<td colspan="2" align="center"><input type="submit"  value="添加信息"/>';
}
?>
<body>
<h3><?php echo $title?></h3>
<form action="action.php?act=<?php echo $action?>" method="post" enctype="multipart/form-data">
	<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<td align="right">用户名</td>
			<td><input type="text" name="username"  readonly value="<?php echo $_GET['username']?>"/></td>
		</tr>
		<tr>
			<td align="right">真实姓名</td>
			<td><input type="text" name="realName" value="<?php echo isset($row['realname'])?$row['realname']:''?>" required placeholder="请输入真实姓名"/></td>
		</tr>
		<tr>
			<td align="right">性别</td>
			<td>
				<?php
				//调用默认选择函数
				if(isset($row)){
					$selected = defaultSelected($row,'sex','checked');
				}
				?>
				<label><input type="radio" name="sex" value="0" required <?php echo isset($selected[0])?$selected[0]:''?>/>女</label>
				<label><input type="radio" name="sex" value="1" required <?php echo isset($selected[1])?$selected[1]:''?>/>男</label>
				<label><input type="radio" name="sex" value="2" required <?php echo isset($selected[2])?$selected[2]:''?>/>保密</label>
			</td>
		</tr>
		<tr>
			<td align="right">年龄</td>
			<td><input type="text" name="age" required value="<?php echo isset($row['age'])?$row['age']:''?>" placeholder="请输入年龄"/></td>
		</tr>
		<tr>
			<td align="right">电话号码</td>
			<td><input type="text" name="phone" required value="<?php echo isset($row['phone'])?$row['phone']:''?>" placeholder="请输入电话号码"/></td>
		</tr>
		<tr>
			<td align="right">邮箱</td>
			<td><input type="email" name="email" required value="<?php echo isset($row['email'])?$row['email']:''?>" placeholder="请输入邮箱"/></td>
		</tr>
		<tr>
			<td align="right">学历</td>
			<td>
				<?php
				//调用默认选择函数
				if(isset($row)){
					$selected = defaultSelected($row,'education','selected');
				}
				?>
				<select name="education">
					<option value="">--请选择--</option>
					<option value="0" <?php echo isset($selected[0])?$selected[0]:''?>>高中</option>
					<option value="1" <?php echo isset($selected[1])?$selected[1]:''?>>专科</option>
					<option value="2" <?php echo isset($selected[2])?$selected[2]:''?>>本科</option>
					<option value="3" <?php echo isset($selected[3])?$selected[3]:''?>>硕士</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">收入</td>
			<td>
				<?php
				//调用默认选择函数
				if(isset($row)){
					$selected = defaultSelected($row,'income','selected');
					//var_dump($selected);
				}
				?>
				<select name="income">
					<option value="">--请选择--</option>
					<option value="0" <?php echo isset($selected[0])?$selected[0]:''?>>1000~5000</option>
					<option value="1" <?php echo isset($selected[1])?$selected[1]:''?>>5000~10000</option>
					<option value="2" <?php echo isset($selected[2])?$selected[2]:''?>>10000以上</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">婚姻状况</td>
			<td>
				<?php
				//调用默认选择函数
				if(isset($row)){
					$selected = defaultSelected($row,'maritalStatus','checked');
				}
				?>
				<label><input type="radio" name="maritalStatus" value="0"required <?php echo isset($selected[0])?$selected[0]:''?>>单身</label>
				<label><input type="radio" name="maritalStatus" value="1"required <?php echo isset($selected[1])?$selected[1]:''?>>已婚</label>
				<label><input type="radio" name="maritalStatus" value="2" required<?php echo isset($selected[2])?$selected[2]:''?>>离异</label>
				<label><input type="radio" name="maritalStatus" value="3"required <?php echo isset($selected[3])?$selected[3]:''?>> 丧偶</label>
			</td>
		</tr>
		<tr>
			<td align="right">爱好</td>
			<td>
				<?php
				//定义一个爱好数组
				$hobby = array('足球','篮球','排球','游泳','跑步','羽毛球','读书','看电影','旅游');
				if(isset($row)){
					$arr = $row['hobby'];
					$arr = explode(',',$arr);
					//var_dump($arr);
					//遍历数组
					foreach($hobby as $k => $v){
						if(in_array($k,$arr)){
							echo '<label><input type="checkbox" name="hobby[]" checked value="'.$k.'">'.$v.'</label>';
						}else{
							echo '<label><input type="checkbox" name="hobby[]"  value="'.$k.'">'.$v.'</label>';
						}
					}
				}else{
					foreach($hobby as $k=>$v){
						echo '<label><input type="checkbox" name="hobby[]"  value="'.$k.'">'.$v.'</label>';
					}
				}

				?>
			</td>
		</tr>
		<tr>
			<td align="right">头像</td>
			<td><input type="file" name="pic">
				<?php
				if(isset($row)){
					//处理头像
					$path = '../../public/upload/thumbHead/s_50_50_'.$row['pic'];
					if(!file_exists($path)){
						//如果略缩图文件不存在,执行缩放函数
						$thumb = thumb('../../public/upload/head/'.$row['pic'],50,50,'../../public/upload/thumbHead');
						$path = $thumb['pathInfo'];
					}
					//echo $path;
					echo '<img src="'.$path.'">';
				}
				?>

			</td>
		</tr>
		<tr>
			<td align="right">家庭地址</td>
			<td>
				<textarea name="address" style="width:80%;height:50px;"><?php echo isset($row['address'])?$row['address']:'';?></textarea>
			</td>
		</tr>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<tr>
			<?php echo $input?>
			<a href="index.php"><input type="button"  value="返回用户列表"/></a></td>
		</tr>
	</table>
</form>
</body>
</html>