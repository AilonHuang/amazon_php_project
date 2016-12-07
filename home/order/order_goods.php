<!DOCTYPE html>
<html>
<head>
	<title>订单页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../include/css/order_goods.css">
</head>
<body>
<?php include '../include/header.php'?>
<!-- 订单中部开始 -->
<div id="my_orders_content">
	<div id="my_order_top">
		<ul>
			<li><a href="">我的账户</a></li>
			<li>›</li>
			<li>我的订单</li>
		</ul>
	</div>
	<div id="haiwaigou">
		<div id="haiwaigou_center">
			<img src="../include/img/ags-logo-inline.png">订单：如果您需要管理和查询2015年11月之前的海外购订单，请点击<a href="">这里</a>
		</div>
	</div>
	<div id="a_row">
		<div>
			<h1>我的订单</h1>
		</div>
		<div id="order_search">
			<form>
				<div>
					<input type="text" placeholder="搜索商品名称、类别或收件人">
				</div>
				<div>
					<button>搜索订单</button>
				</div>

			</form>
		</div>
	</div>
	<div class="clear_float"></div>
	<div id="control_container">
		<div>
			<ul>
				<li><span>订单</span></li>
				<li><span><a href="">未处理或正在处理的订单</a></span></li>
				<li><span><a href="">已取消的订单</a></span></li>
			</ul>
		</div>
		<div id="top_control">
					<span>
						<span>6个订单</span><span>下单时间为</span>
					</span>
			<span>
						<form>
							<button>过去6个月</button>
						</form>
					</span>
		</div>
	</div>

	<?php
	require_once '../../public/function.php';
	require_once '../../public/dbconfig.php';
	$link = construct();
	$sql = "SELECT * FROM orders WHERE uid={$_SESSION['userid']} ORDER by addtime DESC";
	$result = mysqli_query($link,$sql);
	$num = mysqli_num_rows($result);
	//var_dump($num);
	$a = 10;

	while($row = mysqli_fetch_assoc($result)){
		//var_dump($row);
		?>
		<div class="a_box_order">
			<div class="a_box_info">
				<div class="a_box_inner">
					<div class="a_box_info_left">
						<div class="a_span1">
							<div><span>已下订单</span></div>
							<div><span>2016年5月23日</span></div>
						</div>
						<div class="a_span2">
							<div><span>总价</span></div>
							<div><span>￥ <?php echo $row['total']?></span></div>
						</div>
						<div class="a_span3">
							<div><span>收件人</span></div>
							<div><span><?php echo $row['linkname']?></span></div>
						</div>
						<div class="a_span2">
							<div><span>订单状态</span></div>
							<?php $status = array('新订单','已付款','已发货','已收货','无效订单');?>
							<div><span><?php echo $status[$row['status']]?></span></div>
						</div>
					</div>
					<div class="a_box_info_right">
						<div><span>订单编号  <?php echo $row['orderid']?></span></div>
						<div>

							<span><a href=""> 打印订单详情</a></span>
							<span><a href="./order_detail.php?id=<?php echo $row['id'] ?>">查看订单详情(含支付信息)</a></span>
						</div>
					</div>
				</div>
			</div>
			<div>

				<table border="1" width="900px">
					<tr>
						<th width="20%">图片</th>
						<th width="40%">名称</th>
						<!--							<th>单价</th>-->
						<!--							<th>数量</th>-->
						<!--							<th>小计</th>-->
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
						$path = '../../public/upload/thumbGoods/s_50_50_'.$pic[$i];
						//echo $path;
						if(!file_exists($path)){
							//如果略缩图文件不存在,执行缩放函数
							$thumb = thumb('../../public/upload/goods/'.$pic[$i],50,50,'../../public/upload/thumbGoods');
							$path = $thumb['pathInfo'];
						}
						//echo$path;
						echo '<tr>';
						echo '<td><img src="'.$path.'"></td>';
						echo '<td>'.$name[$i].'</td>';
//							echo '<td>'.sprintf("%.2f",$price[$i]).'</td>';
//							echo '<td>'.$num[$i].'</td>';
//							echo '<td>'.sprintf("%.2f",$num[$i]*floatval($price[$i])).'</td>';
						echo '</tr>';
					} ?>
					<!--						<tr>-->
					<!--							<td colspan="3"></td>-->
					<!--							<td>总计</td>-->
					<!--							<td>--><?php //echo $row['total']?><!--</td>-->
					<!--						</tr>-->
				</table>
			</div>
		</div>
	<?php  }?>


</div>
<!-- 订单中部结束 -->

<?php include '../include/footer.php'?>

</body>
</html>