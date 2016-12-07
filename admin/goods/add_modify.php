
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>-.-</title>
	<link href="..include/css/global.css"  rel="stylesheet"  type="text/css" media="all" />
</head>
<?php
//var_dump($_GET);

$typeid=isset($_GET['typeid'])?$_GET['typeid']:'';
require_once '../../public/function.php';
require_once './goods_func.php';

//包含数据库配置文件
require '../../public/dbconfig.php';
$id = isset($_GET['id'])?$_GET['id']:'';

if($id){
	$button = $title = '修改商品';
	$input = '<input type="submit"  value="'.$button.'"/>';
	$action = 'action.php?act=modify&id='.$id.'&typeid='.$typeid.'';
}else{
	$button = $title ='添加商品';
	$input = '<input type="submit"  value="'.$button.'"/>';
	$action = 'action.php?act=add';
}
if((isset($_GET['act'])?$_GET['act']:'') =='show'){
	$title ='商品详细';
	$button = '返回商品列表';
	$action = 'index.php';
	$readonly = 'readonly';
	$input = '';
}else{
	$readonly = '';
}
?>

<body>
<h3><?php echo $title ?></h3>
<form action="<?php echo $action?>" method="post" enctype="multipart/form-data">
	<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<td align="right">商品分类</td>
			<td>
				<select name="type">
					<option value="">--请选择--</option>
					<!--循环分类-->
					<?php
					$link = construct();
					$sql = "SELECT * FROM type ORDER BY CONCAT(path,id) ASC";
					$result = mysqli_query($link,$sql);
					if($result && mysqli_num_rows($result)){
						while($row = mysqli_fetch_assoc($result)){
							if($row['id']==$typeid){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							if($row['pid']==0){
								$disabled = 'disabled';
							}else{
								$disabled = '';
							}
							$num = substr_count($row['path'],',');
							$num = str_repeat('—',$num);
							echo '<option value="'.$row['id'].'"'.$disabled.$selected.'>'.$num.$row['name'].'</option>';
						}
					}
					?>
				</select>
			</td>
		</tr>
		<?php
		if($id) {
			$sql = "SELECT * FROM goods WHERE id=$id";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			//var_dump($row);
		}
		?>
		<tr>
			<td align="right">商品名称</td>
			<td><input type="text" name="name" value="<?php echo $row['name']?>" <?php echo $readonly?> placeholder="请输入商品名称"/></td>
		</tr>

		<tr>
			<td align="right">商品价格</td>
			<td><input type="text" name="price" value="<?php echo $row['price']?>" <?php echo $readonly?> placeholder="请输入商品价格"/></td>
		</tr>
		<tr>
			<td align="right">商品库存</td>
			<td><input type="text" name="store" value="<?php echo $row['store']?>" <?php echo $readonly?> placeholder="请输入商品库存"/></td>
		</tr>
		<tr>
			<td align="right">生产厂家</td>
			<td><input type="text" name="company" value="<?php echo $row['company']?>" <?php echo $readonly?> placeholder="请输入生产厂家"/></td>
		</tr>
		<tr>
			<td align="right">商品状态</td>
			<td>
				<?php
				if($row) {
					$selected = defaultSelected($row, 'state', 'selected');
				}
				?>
				<select name="state">
					<option value="">--请选择--</option>
					<option value="0" <?php echo isset($selected[0])?$selected[0]:''; ?>>新品</option>
					<option value="1" <?php echo isset($selected[1])?$selected[1]:''; ?>>上架</option>
					<option value="2" <?php echo isset($selected[2])?$selected[2]:''; ?>>下架</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">商品描述</td>
			<td>
				<textarea name="desc" id="editor_id" style="width:70%;height:50px;" <?php echo $readonly?>><?php echo $row['desc']?></textarea>
			</td>
		</tr>
		<tr>
			<td align="right">商品图像</td>
			<td>
				<input type="file" name="pic">
				<?php
				if($row) {
					echo '<img src="../../public/upload/thumbGoods/s_80_80_'.$row['pic'].'">';
				}
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<?php echo $input?>
				<a href="index.php"><input type="button"  value="返回商品列表"/></a>
			</td>
		</tr>
	</table>
</form>
</body>
</html>