<?php
include '../include/header.php';
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
require_once './goods_func.php';
//var_dump($_GET);
$id = isset($_GET['id'])?$_GET['id']:'';
$pid = isset($_GET['pid'])?$_GET['pid']:'';
$keywords = isset($_GET['keywords'])?$_GET['keywords']:'';

$link = construct();
$sql = "SELECT * FROM goods WHERE state != 2";

//顶级分类
if($id && $pid=='0'){
	$sql = "SELECT * FROM goods WHERE state !=2 AND typeid IN(SELECT id FROM type WHERE pid = $id)";
}elseif($id) {
	$sql = "SELECT * FROM goods WHERE state !=2 AND typeid = $id";
}
if($keywords){
	$sql = "SELECT * FROM goods WHERE state !=2";
}
$search = search();
$sql = $sql.$search['sql'];
$page = page(9,$link,$sql);
$url = "&keywords={$search['keywords']}";
//var_dump($page);
$sql = $sql.$search['sql'].$page['limit'];
//搜索
//echo $sql .'<br>';
$result = mysqli_query($link,$sql);
?>
	<link rel="stylesheet" href="../include/css/goods_list.css">
	<div id="result_info_content">
		<div id="result_info_content_left">
			<div>
				<!--				<span>共--><?php //echo $page['num'] ?><!--条</span><span> --><?php //echo isset($keywords)?'“'.$keywords.'”':'' ?><!--</span>-->
			</div>
		</div>
		<!--<div id="result_info_content_right">
			<font action="" method=""><span>排序:</span>
				<select>
					<option>相关度</option>
					<option>价格:由低到高</option>
					<option>价格:由高到低</option>
					<option>用户评分</option>
					<option>上架时间</option>
				</select>
			</font>
		</div>-->
	</div>
	<div id="goods_content">
		<!-- 左边导航 -->
		<div class="goods_content_left">
			<div>
				<div class="goods_content_left_header">显示搜索结果：</div>
				<ul>
					<li>
						<a href=""><span>Kindle商店</span><span> ></span></a>
					</li>
					<ul>
						<li><a href=""><span>Kindle电子书</span></a></li>
						<li><a href=""><span>进口原版 (Kindle Imported eBooks)</span></a></li>
						<li><a href=""><span>中国现代名家文学作品及欣赏</span></a></li>
						<li><a href=""><span>中国古典小说</span></a></li>
						<li><a href=""><span>Literature & Fiction(文学与虚构类)</span></a></li>
						<li><span>+</span><a href=""><span> 查看更多选择</span></a></li>
					</ul>
				</ul>
				<ul>
					<li>
						<a href=""><span>电脑\IT</span><span> ></span></a>
					</li>
					<ul>
						<li><a href=""><span>平板电脑</span></a></li>
						<li><a href=""><span>平板电脑保护套、壳</span></a></li>
						<li><a href=""><span>Kindle保护套</span></a></li>
						<li><a href=""><span>Kindle配件</span></a></li>
						<li><a href=""><span>Kindle电源适配器</span></a></li>
						<li><span></span><a href=""><span></span></a></li>
					</ul>
				</ul>
				<ul>
					<li>
						<a href=""><span>数码影音</span><span> ></span></a>
					</li>
					<ul>
						<li><a href=""><span>保护壳、保护套</span></a></li>
						<li><a href=""><span>MP3、MP4播放器</span></a></li>
						<li><a href=""><span>普通充电器、底座、适配器</span></a></li>

					</ul>
				</ul>
				<ul>
					<li>
						<span>+</span><a href=""><span>查看全部分类</span></a>
					</li>

				</ul>
				<div class="goods_content_left_header">筛选：</div>
				<h2>配送至</h2>
				<select>
					<option>山东济南市历下区</option>
				</select>
				<h2>亚马逊海外购</h2>
				<a href=""><input type="checkbox" name=""><img src="./include/img/ags_badge.png"></a>
				<h2>平板电脑操作系统</h2>
				<a href=""><input type="checkbox" name="">Kindle</a>
				<h2>图书装帧</h2>
				<ul>
					<li><span><a href="">Kindle电子书</a></span></li>
					<li><span><a href="">平装</a></span></li>
					<li><span><a href="">精装</a></span></li>
				</ul>
				<h2>小说国别</h2>
				<ul>
					<li><span><a href=""><input type="checkbox" name="">中国</a></span></li>
					<li><span><a href=""><input type="checkbox" name="">日本</a></span></li>
					<li><span><a href=""><input type="checkbox" name="">美国</a></span></li>
					<li><span><a href=""><input type="checkbox" name="">英国</a></span></li>
					<li><span><a href=""><input type="checkbox" name="">俄罗斯</a></span></li>
					<li><span><a href=""><input type="checkbox" name="">其他国家</a></span></li>
					<li>
						<span>+</span><span><a href="">查看更多选择</a></span>
					</li>
				</ul>
				<h2>配送<a href=""><span>(这是什么?)</span></a></h2>
				<ul>
					<li><span><a href=""><input type="checkbox" name="">仅限亚马逊配送</a></span></li>
				</ul>
				<h2>客户评分</h2>
				<ul>
					<li><span><i id="a_start5"></i><a id="a_icon_alt" href="">仅五星</a></span></li>
					<div class="clear_float"></div>
					<li><span><i id="a_start4"></i><a id="a_icon_alt" href="">及以上</a></span></li>
					<div class="clear_float"></div>
					<li><span><i id="a_start3"></i><a id="a_icon_alt" href="">及以上</a></span></li>
					<div class="clear_float"></div>
					<li><span><i id="a_start2"></i><a id="a_icon_alt" href="">及以上</a></span></li>
					<div class="clear_float"></div>
					<li><span><i id="a_start1"></i><a id="a_icon_alt" href="">及以上</a></span></li>
					<div class="clear_float"></div>

				</ul>



			</div>
		</div>
		<!-- 左边导航结束 -->
		<!-- 右边开始 -->
		<div id="goods_content_right">
			<!-- 右边顶部开始 -->
			<div id="content_top">
				<div>
					<a href="">
						<img src="../include/img/goods_content_top.jpg">
					</a>
					<div id="content_top_right">
						<a href=""><span>全新kindle电子书阅读器 现货发售</span>
							<div>学习智友， 新“纤”升级，现货发售,点击查看</div></a>
					</div>
				</div>
			</div>
			<!-- 右边顶部结束 -->

			<?php
			if($result && mysqli_num_rows($result)){
				while($row=mysqli_fetch_assoc($result)){
					//var_dump($row);
					?>
					<!-- 右边商品显示开始 -->
					<?php
					/*					$path = '../../public/upload/thumbGoods/s_50_50_'.$row['pic'];
                                        if(!file_exists($path)){
                                            $thumb = thumb('../../public/upload/goods/'.$row['pic'],50,50,'../../public/upload/thumbGoods/');
                                            $path = $thumb['pathInfo'];
                                        }
                                        */?>
					<div class="item_container">
						<div class="goods_img">
							<img  width="160px" height="160px" src="<?php echo '../../public/upload/goods/'.$row['pic'] ?>">
						</div>
						<div class="goods_img_header"></div>
						<a class="gooeds_size" href="">
							<div class="a_box">
								<div class="a_box_inner">
									<span>查看尺寸选项</span>
								</div>
							</div>
						</a>
						<div class="goods_introduce">
							<a href="./goods_detail.php?id=<?php echo $row['id'] ?>"><h2><?php echo $row['name'] ?></h2></a>
						</div>
						<div class="shop_name"><span><?php echo $row['desc'] ?></span></div>
						<div class="goods_price">
							<span><?php echo $row['price'] ?></span>
						</div>
						<div class="arrive_time"><span>部分地区<span>明天</span>即可送达</span></div>
						<div class="chuxiao">
							<!--						<span>原厂保护套组合购20元优惠及<a href="">更多促销</a></span>-->
						</div>
						<div class="goods_button">
							<a href="../cart/addCart.php?id=<?php echo $row['id']?>"><input type="button" name="" value="加入购物车"></a>
							<input type="button" name="" value="加入心愿单">
						</div>
						<div class="store_class">
							<!--						<a href=""><span>Kindle商店:</span><span>查看所有 351,968 个商品</span></a>-->
						</div>
					</div>
				<?php } }?>

			<!-- 右边商品显示结束 -->
		</div>
		<!-- 右边结束 -->
	</div>
	<div class="clear_float"></div>
	<div style="margin:0 auto;text-align: center;">
		<?php echo "{$page['num']}条数据 {$page['dPage']}/{$page['all']}页&nbsp;&nbsp";?>
		<a href="?page=<?php echo '1'.$url ?>">首页</a>
		<a href="?page=<?php echo $page['pre'].$url?>">上一页</a>
		<a href="?page=<?php echo $page['next'].$url?>">下一页</a>
		<a href="?page=<?php echo $page['all'].$url?>">尾页</a>
	</div>
<?php
include '../include/footer.php';
?>