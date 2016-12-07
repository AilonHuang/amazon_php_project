<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Insert title here</title>
</head>
<?php
//var_dump($_GET);
if(isset($_GET['id'])?$_GET['id']:''){
	$id = $_GET['id'];
	$action = 'modify&id='.$id;
	$title = '修改有情链接';

	$input = '<td colspan="2" align="center"><input type="submit"  value="修改友情链接"/></td>';
	require_once '../../public/function.php';
	require_once '../../public/dbconfig.php';
	$link = construct();
	$sql = "SELECT * FROM link WHERE status=1 AND id=$id";
	//echo $sql;
	$result = mysqli_query($link,$sql);
	if($result && mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		//var_dump($row);
	}
}else{
	$action ='add';
	$title = '添加有情链接';
	$input = '<td colspan="2" align="center"><input type="submit"  value="添加友情链接"/></td>';
}

?>
<body>
<h3><?php echo $title?></h3>
<form action="action.php?act=<?php echo $action?>" method="post">
	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<td align="right">公司名称</td>
			<td><input type="text" name="name" value="<?php echo isset($row['name'])?$row['name']:''?>" placeholder="请输入公司名称"/></td>
		</tr>
		<tr>
			<td align="right">公司链接</td>
			<td><input type="url" name="url" value="<?php echo isset($row['url'])?$row['url']:''?>"/></td>
		</tr>
		<tr>
			<?php echo $input?>
		</tr>

	</table>
</form>
</body>
</html>