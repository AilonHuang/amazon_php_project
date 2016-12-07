
<link rel="stylesheet" href="../include/css/footer.css">
<div class="footer">
	<table border="0" width="765" align="center">
		<tr>
			<td valign="top">
				了解我们
				<ul>
					<li><a href="" class="nav_a">人才招聘</a></a></li>
					<li><a href="" class="nav_a">关于我们</a></a></li>
					<li><a href="" class="nav_a">新闻中心</a></a></li>
					<li><a href="" class="nav_a">公益社区</a></a></li>
					<li><a href="" class="nav_a">移动客户端</a></a></a></li>
				</ul>
			</td>
			<td width="50px">&nbsp;</td>
			<td valign="top">
				合作信息
				<ul>
					<li><a href="" class="nav_a">全球开店</a></li>
					<li><a href="" class="nav_a">我要开店</a></li>
					<li><a href="" class="nav_a">亚马逊物流</a></li>
					<li><a href="" class="nav_a">加入联盟</a></li>
					<li><a href="" class="nav_a">我要推广</a></li>
					<li><a href="" class="nav_a">合作伙伴</a></li>
				</ul>
			</td>
			<td width="50px">&nbsp;</td>
			<td valign="top">
				购物资讯
				<ul>
					<li><a href="" class="nav_a">潜力搜索</a></li>
					<li><a href="" class="nav_a">潜力商品</a></li>
					<li><a href="" class="nav_a">购物指南</a></li>
					<li><a href="" class="nav_a">热门促销</a></li>
				</ul>
			</td>
			<td width="50px">&nbsp;</td>
			<td valign="top">
				支付方式
				<ul>
					<li><a href="" class="nav_a">亚马逊支付</a></li>
					<li><a href="" class="nav_a">亚马逊帐户</a></li>
					<li><a href="" class="nav_a">货到付款</a></li>
					<li><a href="" class="nav_a">支付宝与财付通</a></li>
					<li><a href="" class="nav_a">网上银行</a></li>
				</ul>
			</td>
			<td width="50px">&nbsp;</td>
			<td valign="top">
				帮助和购物指南
				<ul>
					<li><a href="" class="nav_a">订单查询</a></li>
					<li><a href="" class="nav_a">配送费收取标准</a></li>
					<li><a href="" class="nav_a">在线自助退换货</a></li>
					<li><a href="" class="nav_a">退换货政策</a></li>
					<li><a href="" class="nav_a">亚马逊助手</a></li>
					<li><a href="" class="nav_a">帮助</a></li>
				</ul>
			</td>

		</tr>
	</table>
	<div style="margin: 0 auto;text-align: center">
		<h3>友情链接</h3>
		<?php
		//require_once '../../public/function.php';
		//require_once '../../public/dbconfig.php';
		$link = construct();
		$sql = "SELECT * FROM link WHERE status=1";
		$result = mysqli_query($link,$sql);
		if($result && mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				//var_dump($row);
				$str = <<<EOF
<tr>
			<font size="5" style="margin-left:10px"><a href="{$row['url']}" target="black">{$row['name']}</a></font>
			
		</tr>
EOF;
				echo $str;
			}
		}
		?>
		<br>
		<a href="<?php echo  $css_path?>/link/index.php">申请友情链接</a>
	</div>

	<div class="bottom">
		<div class="footer_logo">
			<a href=""><img src="<?php echo $css_path ?>/include/img/footer_logo.gif"></a>
		</div>
		<div class="footer_line_left">
			<ul>
				<li class="float_li"><a href="" class="nav_a">美国</a></li>
				<li class="float_li"><a href="" class="nav_a">加拿大</a></li>
				<li class="float_li"><a href="" class="nav_a">巴西</a></li>
				<li class="float_li"><a href="" class="nav_a">墨西哥</a></li>
				<li class="float_li"><a href="" class="nav_a">英国</a></li>
				<li class="float_li"><a href="" class="nav_a">德国</a></li>
				<li class="float_li"><a href="" class="nav_a">法国</a></li>
				<li class="float_li"><a href="" class="nav_a">法国</a></li>
				<li class="float_li"><a href="" class="nav_a">法国</a></li>
				<li class="float_li"><a href="" class="nav_a">法国</a></li>
				<li><a href="" class="nav_a">澳大利亚</a></li>
			</ul>
		</div>
		<div class="footer_line_right">
			<ul>
				<li class="float_li"><span class="gray">亚马逊家族网站:</span></li>
				<li class="float_li"><a href="" class="nav_a">Amazon Web Services</a></li>
				<li class="float_li"><a href="" class="nav_a">Diapers.com</a></li>
				<li class="float_li"><a href="" class="nav_a">Shopbop</a></li>
				<li><span class="gray">YAMAXUN™</span></li>
			</ul>
		</div>

		<div class="footer_line_left1">
			<li class="float_li"><a href="" class="nav_a">使用条件</a></li>
			<li class="float_li"><a href="" class="nav_a">隐私声明</a></li>
			<li class="float_li"><a href="" class="nav_a">基于兴趣的广告</a></li>
			<li><span class="gray">版权所有 © 1996-2016，亚马逊公司或其关联公司</span></li>
		</div>
		<div class="footer_line_left2">
			<li><span class="gray">北京市公安局朝阳分局备案110105004167</span></li>
			<li class="float_li"><a href="" class="nav_a">电信与信息服务业务经营许可证：京ICP证010225号</a></li>
		</div>
		<div class="footer_line_left3">
			<li><span class="gray">互联网药品信息服务资格证书 京-非经营性-2012-0005</span></li>
			<li><span class="gray">出版物经营许可证新出发京批字第直0852号 </span></li>
			<li class="float_li"><a href="" class="nav_a">食品流通许可证：SP1101051010069209</a></li>
		</div>
		<div class="footer_line_left4">
			<li><span class="gray">网络文化经营许可证京网文[2012] 0405 -126号</span></li>
			<li class="float_li"><a href="" class="nav_a">营业执照：91110105721471662U</a></li>
		</div>
	</div>
</div>
