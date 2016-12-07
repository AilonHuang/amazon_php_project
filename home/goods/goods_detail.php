<?php
include '../include/header.php';
/*require_once '../public/function.php';
require_once '../public/dbconfig.php';*/
$link = construct();
$sql = "SELECT * FROM goods WHERE id={$_GET['id']}";
//echo $sql;
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
?>

	<link rel="stylesheet" href="../include/css/detail.css">
	<div id="detail">
		<div class="middle_left">
			<img src="../../public/upload/thumbGoods/s_80_80_<?php echo $row['pic']?>" width="300px" height="300px">
		</div>
		<div class="middle_center">
			<div class="produce_title">
				<?php echo $row['name'];?>
			</div>
			<hr color="#ddd">
			<span class="line">售价：<span class="produce_price"><?php echo $row['price']?></span> <b>免运费</b>且可<b>货到付款</b> <a href="" class="nav_a">详情</a></span>
			<hr color="#ddd">
			<span>颜色：<span class="bold">黑</span></span><br>
			<span>配送至：<select><option>济南市槐荫区</option></select></span><span class="have_goods">现在有货</span>
		</div>
		<div class="middle_right">
			<form action="../cart/addCart.php?id=<?php echo $row['id']?>" method="post">
				<!--			<input type="hidden" name="id" value="--><?php //echo $row['id']?><!--">-->
				数量：
				<select name="num">
					<?php
					for($i=1;$i<=$row['store'];$i++) {
						echo '<option value="'.$i.'">'.$i.'</option >';
					}
					?>
				</select><br>
				<input type="submit" value="加入购物车">
			</form>
		</div>
	</div>


<?php
include '../include/footer.php';
?>