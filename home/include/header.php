<?php
session_start();
//var_dump($_SESSION);
//var_dump($_SERVER['SCRIPT_FILENAME']);
$path = basename(($_SERVER['SCRIPT_FILENAME']));
//
//var_dump($path);
if($path == 'index.php'){
	$index = 'index.php';
	$func_path = '../public';
	$css_path = '.';
	$cart_path = './cart/showCart.php';
	$user_path = './user/member_center.php';
	$goods_path = './goods/goods_list.php';
	$order_path = './order/order_goods.php';
}else{
	$index = '../index.php';
	$func_path = '../../public';
	$css_path = '..';
	$cart_path = '../cart/showCart.php';
	$user_path = '../user/member_center.php';
	$goods_path = '../goods/goods_list.php';
	$order_path = '../order/order_goods.php';
}
if($path=='member_center.php'){
	$user_path = './member_center.php';
	$cart_path = '../cart/showCart.php';
}
if($path=='goods_list.php'){
	$cart_path = '../cart/showCart.php';
}
require_once $func_path.'/function.php';
require_once $func_path.'/dbconfig.php';
$link = construct();
if($path=='member_center.php'){
	if(!isset($_SESSION['userid'])) {
		echo '<script>alert("请先登陆");location="../login.php"</script>';
	}
}
?>


<link rel="stylesheet" href="<?php echo $css_path?>/include/css/header.css">
<!-- 顶部广告条 -->
<div id="ad">
	<div id="ad_pic">
		<a href="">
			<img src="<?php echo $css_path?>/include/img/topAdPic.jpg">
		</a>
	</div>
</div>
<!-- 顶部广告条结束 -->

<!-- 顶部搜索框 -->
<div id="top">
	<!-- 亚马逊logo -->
	<div id="top_left">
		<a href="<?php echo $index?>"><div id="top_logo"></div></a>
	</div>
	<!-- 搜索框 -->
	<div id="top_center">
		<form action="<?php echo $goods_path?>" method="get">
			<!-- 搜索选择 -->
			<!--<div id="search_select">-->
			<!--<select name="type">
                    <option value="">--请选择--</option>
                    <!--循环分类-->
			<?php
			/*						$link = construct();
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
                                    */?>
			<!--</select>-->
			<!--</div>-->
			<!-- 搜索框 -->
			<div id="search_input">
				<input type="text" name="keywords" placeholder="搜索商品">
			</div>
			<!-- 搜索按钮 -->
			<div id="search_button">
				<a href=""><input type="image" value=""></a>
			</div>
		</form>
	</div>
	<div id="top_right">
	</div>
</div>
<!-- 顶部搜索框结束 -->


<div class="clear_float"></div>


<!-- 顶部导航条 -->
<div id="top_nav">
	<div id="top_nav_left">
		<div>
			<a href="<?php echo $goods_path?>">
				<span>浏览</span><br/>
				<span>全部商品分类</span>
			</a>
		</div>
		<div id="left_nav">
			<div id="left_nav_left">
				<?php
				$sql = "SELECT * FROM type WHERE pid=0";
				$result = mysqli_query($link,$sql);
				if($result && mysqli_num_rows($result)>0):
					while($row = mysqli_fetch_assoc($result)):
						//echo $row['name'];
						?>
						<span>
					<a href="<?php echo $goods_path.'?id='.$row['id'].'&pid='.$row['pid'].'&name='.$row['name']; ?>"><?php echo $row['name'];?></a>
					<div id="left_nav_store_nav">
						<span><?php echo $row['name'];?></span>
						<div>
							<?php
							$sql = "SELECT * FROM type WHERE pid != 0 AND pid={$row['id']}";
							//echo $sql;
							$res = mysqli_query($link,$sql);
							//var_dump($res);
							if($res && mysqli_num_rows($res)){
								//var_dump($res);
								while($r=mysqli_fetch_assoc($res)):
									?>
									<div class="right_nav_title">
								<a href="<?php echo $goods_path.'?id='.$r['id'].'&name='.$r['name']; ?>"
									<span><?php echo $r['name']?></span>
										</a>
							</div>
									<div>
								<!--<a href=""><span>Kindle</span></a>|
								<a href=""><span>Kindle Paperwhite</span></a>|
								<a href=""><span>Kindle Voyage</span></a>|
								<a href=""><span>Kindle Oasis</span></a>
								<a href=""><span></span>Kindle配件</a>-->
							</div>
								<?php endwhile; } ?>
						</div>
					</div>
				</span>
					<?php endwhile;endif;mysqli_close($link);?>
				<a href="<?php echo $goods_path?>"><span>全部分类</span></a>
			</div>
			<!-- <div id="left_nav_right"></div> -->
		</div>
	</div>
	<div id="top_nav_center">
		<div>
			<a href="<?php echo $user_path ?>?id=<?php echo isset($_SESSION['userid'])?$_SESSION['userid']:''?>">我的亚马逊</a>&nbsp;
			<a href="">Z秒杀</a>&nbsp;
			<a href="">礼品卡</a>&nbsp;
			<a href="">我要开店</a>&nbsp;
			<a href="">海外购</a>&nbsp;
			<a href="">帮助</a>&nbsp;
			<a href="">In English</a>
		</div>
	</div>
	<div id="top_nav_right">
		<div>
			<div id="denglu">
				<a href="<?php echo isset($_SESSION['username'])?$user_path.'?id='.$_SESSION['userid']:$css_path.'/login.php'?>">
					<span><?php echo isset($_SESSION['username'])?$_SESSION['username']:'您好.登录';?></span>
					<br/>
					<span>我的账户</span>
				</a>
				<div>
					<a href="<?php echo isset($_SESSION['username'])?$user_path.'?id='.$_SESSION['userid']:$css_path.'/login.php'?>"><?php echo isset($_SESSION['username'])?'':'立即登录';?></a> <br>
					<a href="<?php echo isset($_SESSION['username'])?$order_path:$order_path?>"><?php echo isset($_SESSION['username'])?'我的订单':'';?></a><br>
					<a href="<?php echo isset($_SESSION['username'])?($css_path.'/logout.php'):($css_path.'/signin.php')?>"><?php echo isset($_SESSION['username'])?'不是'.$_SESSION['username'].'？退出':'新客户 立即注册';?></a><br>
				</div>
			</div>
			<div id="gouwuche" style="margin-left: 0px">
				<a href="<?php echo $cart_path?>" style="font-size:14px font-weight:800">
					<span ><?php echo count(isset($_SESSION['cart'])?$_SESSION['cart']:null)?></span>
					<span>购物车</span>
				</a>
			</div>
			<div id="xinyuandan">
				<a href="">
					<span>心愿单</span>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- 顶部导航条结束 -->

