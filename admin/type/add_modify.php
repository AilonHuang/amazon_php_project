<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Insert title here</title>
</head>
<?php
//引入函数文件
require '../../public/function.php';
//包含数据库配置文件
require '../../public/dbconfig.php';
require './type_func.php';
//判断是什么操作
$id = isset($_GET['id'])?$_GET['id']:'';
$act = isset($_GET['act'])?$_GET['act']:'';
$pid = isset($_GET['pid'])?$_GET['pid']:'';
//var_dump($_GET);

$action="action.php?act=add&id=$id";
$title = '添加分类';
if($act=='modify'){
	$action="action.php?act=modify&id=$id&pid=$pid";
	$title = '修改分类';
	$id = $pid;
}
?>
<body>
<h3><?php echo $title?></h3>
<form action="<?php echo $action?>" method="post">
	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<td align="right">选择分类</td>
			<td>
				<select name="path">
					<option value="">--请选择--</option>
					<?php
					echo '<option value="0" selected>顶级分类</option>';
					//if($act==
					$link = construct();
					$sql = "SELECT * FROM type ORDER BY CONCAT(path,id) ASC";
					$result = mysqli_query($link,$sql);
					if($result && mysqli_num_rows($result)>0){
						while($row = mysqli_fetch_assoc($result)){
							$num = substr_count($row['path'],',');
							$num = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$num);
							if($id == $row['id']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							echo '<option value="'.$row['path'].$row['id'].'" '.$selected.'>'.$num.$row['name'].'</option>';
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">分类名称</td>
			<td><input type="text" name="name" value="<?php echo isset($_GET['name'])?$_GET['name']:'';?>" placeholder="请输入分类名称"/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit"  value="<?php echo $title?>"/></td>
		</tr>

	</table>
</form>
</body>
</html>