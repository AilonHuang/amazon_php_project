<?php
include '../include/header.php';
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
$link = construct();
//var_dump($_GET);
?>
	<link rel="stylesheet" href="../include/css/order_detail.css">

	<div class="order_detail">
	<span>我的帐户›  我的订单› 查看订单详情(含支付信息)</span>
	<h1>查看订单详情(含支付信息) </h1>

<?php
$sql = "SELECT * FROM orders WHERE id={$_GET['id']}";
//echo $sql;
$result = mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_assoc($result)){
		//var_dump($row);

		?>
		<div class="order_detail_top">
			<span class="order_date">下单日：2014年9月3日</span>
			<span class="">订单编号 <?php echo $row['orderid']?> </span>
			<input type="submit" value="查看或打印发票" >
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
					echo '<td>'.sprintf("%.2f",$num[$i]*floatval($price[$i])).'</td>';
					echo '</tr>';
				} ?>
				<tr>
					<td colspan="3"></td>
					<td>总计</td>
					<td><?php echo $row['total']?></td>
				</tr>
				<tr>
					<?php
					//var_dump($row);
					if($row['status']=='0'){
						echo '<td colspan="5" align="right"><a href="../cart/do_account.php?id='.$row['id'].'">去付款</a></td>';
					}
					?>
				</tr>
			</table>
		</div>
	<?php }}?>


<?php
include '../include/footer.php';
?>