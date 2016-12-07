<?php
session_start();
//var_dump($_SESSION);
//var_dump($_GET);
?>
<!DOCTYPE html>
<html>
<head>
	<title>注册</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./include/css/sign_in.css">
</head>
<body>

<div id="sign_in_header">
	<div>
		<a href=""><div></div></a>
	</div>
</div>
<form action="doSignin.php" method="post">
	<div id="sign_in_body">
		<div>
			<h1>创建账户</h1>
			<div id="zhanghao">
				<span>用户名</span>
				<input type="text" name="username" value="<?php echo isset($_GET['username'])?$_GET['username']:'';?>" placeholder="6-13位英文字母">
			</div>
			<div id="mima">
				<span>密码</span>
				<input type="password" name="pwd" placeholder="6-13位英文字母">
			</div>
			<div id="mima">
				<span>重复密码</span>
				<input type="password" name="repwd" placeholder="6-13位英文字母">
				<!--					<span><a href="">选择使用手机号码</a></span>-->
			</div>
			<div id="mima">
				<span>验证码</span>
				<input type="text" name="verify">
				<img src="../public/code_func.php" alt=""  onclick="this.src='../public/code_func.php?'+Math.random()" title="看不清换一张"/>
			</div>
			<div id="yinsi_tiaoli">
				<input type="checkbox" name="">
				<span>我已阅读并同意网站的<a href="">使用条件</a>及<a href="">隐私声明</a></span>
			</div>
			<div id="denglu">
				<input type="submit" value="创建您的亚马逊账户">
			</div>
			<br>
			<hr>
			<div id="more_sign_in">其他注册方式</div>
			<div id="weixin">
				<button>微信账号注册</button>
			</div>

			<br>
			<div id="yinsi_tiaoli">
				<span>已有账户？<a href="login.html">登录</a></span>
			</div>

		</div>
	</div>
</form>

<div id="login_footer">
	<div>
		<a href="">使用条件</a>
		<span></span>
		<a href="">隐私声明</a>
		<span></span>
		<a href="">帮助</a>
	</div>
	<div>
		<span>版权所有 © 1996-2016，亚马逊公司或其关联公司</span>
	</div>

</div>


<?php $_SESSION['verify'] = '';?>
<div id="login_bottom"></div>


</body>
</html>