<?php
session_start();
//var_dump($_SESSION);
if(isset($_SESSION['userid'])?$_SESSION['userid']:''){
	echo '<script>alert("已登录");location="index.php"</script>';
}
//var_dump($_SERVER);
//$_SESSION['url'] = $_SERVER['HTTP_REFERER'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./include/css/login.css">
</head>
<body>

<div id="login_header">
	<div>
		<a href="./index.php"><div></div></a>
	</div>
</div>
<form action="./doLogin.php" method="post">

	<div id="login_body">
		<div>
			<h1>登录</h1>
			<div id="zhanghao">
				<span>用户名</span>
				<input type="text" name="username" value="<?php echo isset($_GET['username'])?$_GET['username']:'';?>" placeholder="6-13位英文字母">
			</div>
			<div id="mima">
				<span>密码</span>
				<input type="password" name="pwd" placeholder="6-13位英文字母">
			</div>
			<div id="zhanghao">
				<span>验证码</span>
				<input type="text" name="verify">
				<img src="../public/code_func.php" alt=""  onclick="this.src='../public/code_func.php?'+Math.random()" title="看不清换一张"/>
			</div>
			<div id="denglu">
				<input type="submit" value="登录">
			</div>
			<br>
			<hr>
			<div id="more_login">更多登录方式</div>
			<div id="weixin">
				<button>微信账号登录</button>
			</div>

			<br>
			<hr>
			<div id="new_user">Amazon的新客户?</div>

			<div id="zhuce">
				<button><a href="signin.php">创建您的Amazon账户</a></button>
			</div>

			<div id="yinsi_tiaoli">
				<span>登录即表示您同意网站的<a href="">使用条件</a>及<a href="">隐私声明</a></span>
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



<div id="login_bottom"></div>
<?php $_SESSION['verify'] = '';?>

</body>
</html>
