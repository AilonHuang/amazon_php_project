
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>-.-</title>
	<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
	<link href="../../home/include/css/order_detail.css"  rel="stylesheet"  type="text/css" media="all" />
	<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
	<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
	<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
	<script>
		KindEditor.ready(function(K) {
			window.editor = K.create('#editor_id');
		});
		$(document).ready(function(){
			$("#selectFileBtn").click(function(){
				$fileField = $('<input type="file" name="thumbs[]"/>');
				$fileField.hide();
				$("#attachList").append($fileField);
				$fileField.trigger("click");
				$fileField.change(function(){
					$path = $(this).val();
					$filename = $path.substring($path.lastIndexOf("\\")+1);
					$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
					$attachItem.find(".left").html($filename);
					$("#attachList").append($attachItem);
				});
			});
			$("#attachList>.attachItem").find('a').live('click',function(obj,i){
				$(this).parents('.attachItem').prev('input').remove();
				$(this).parents('.attachItem').remove();
			});
		});
	</script>
</head>
<body>
<h3>查看订单详情</h3>
<?php
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
$link = construct();
$sql = "SELECT * FROM orders WHERE id={$_GET['id']}";
$status = array('新订单','已付款','已发货','已收货','无效订单');
//echo $sql;
$result = mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
	$row = mysqli_fetch_assoc($result);
	//var_dump($row);

	?>
	<div class="order_detail_top">
		<span class="order_date"><?php echo date('Y-m-d H:i:s',$row['addtime'])?></span>
		<span class="">订单编号 <?php echo $row['orderid']?> </span>
		<!--			<input type="submit" value="查看或打印发票" >-->
	</div>
	<div class="order_detail_middle">
		<div class="left">
			<h5>配送地址</h5>
			<span><?php echo $row['linkname'] ?></span><br>
			<span><?php echo $row['address']?></span><br>
			<!--		<span>百事春秋</span><br>-->
			<span><?php echo $row['code']?></span>
		</div>
		<div class="center">
			<h5>付款方式</h5>
			<span><?php if($row['status']==0 ||$row['status']== 4){echo '未付款';}else{echo '自动付款';} ?></span><br>
		</div>
		<div class="center">
			<?php $status = array('新订单','已付款','已发货','已收货','无效订单');?>
			<h5>订单状态</h5>
			<span><span><?php echo $status[$row['status']]?></span></span><br>
		</div>
		<div class="right">
			<h5>订单汇总</h5>
			<div class="right_left">

				<div>
					<!--				<span>商品小计：</span>-->
				</div>
				<div>
					<span>配送费：</span>
				</div>

				<div>
					<!--				<span>小计：</span>-->
				</div>
				<div>
					<h5>总计：</h5>
				</div>
			</div>
			<div class="right_right">
				<!--			<div><span>￥123</span></div>-->
				<div><span>￥0</span></div>
				<!--			<div><span>￥123</span></div>-->
				<h5><?php echo $row['total']?></h5>
			</div>
		</div>
	</div>
	<div class="order_detail_bottom">
		<table border="1" width="1100px">
			<tr>
				<th>图片</th>
				<th>名称</th>
				<th>单价</th>
				<th>数量</th>

				<th>收件人</th>
				<th>电话</th>
				<th>地址</th>
				<th>下单时间</th>
				<th>状态</th>
				<th>小计</th>
			</tr>
			<?php
			$goodsid = explode(',',$row['goodsid']);
			$name = explode('&&',$row['name']);
			$num = explode(',',$row['num']);
			$n = count($goodsid);
			$price = explode(',',$row['price']);
			$pic = explode(',',$row['pic']);
			//var_dump($name);
			for($i=0;$i<$n;$i++){

				echo '<tr>';
				echo '<td><img src="../../public/upload/thumbGoods/s_80_80_'.$pic[$i].'"></td>';
				echo '<td>'.$name[$i].'</td>';
				echo '<td>'.sprintf("%.2f",$price[$i]).'</td>';
				echo '<td>'.$num[$i].'</td>';

				echo '<td>'.$row['linkname'].'</td>';
				echo '<td>'.$row['phone'].'</td>';
				echo '<td>'.$row['address'].'</td>';
				echo '<td>'.date('Y-m-d H:i:s',$row['addtime']).'</td>';
				echo '<td>'.$status[$row['status']].'</td>';
				echo '<td>'.sprintf("%.2f",$num[$i]*floatval($price[$i])).'</td>';
				echo '</tr>';
			} ?>
			<tr>
				<td colspan="8"></td>
				<td>总计</td>
				<td><?php echo $row['total']?></td>
			</tr>
		</table>
	</div>
<?php }?>

</body>
</html>