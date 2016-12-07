<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>-.-</title>
	<link rel="stylesheet" href="../include/css/backstage.css">
</head>
<?php
//引入函数文件
require '../../public/function.php';
//包含数据库配置文件
require '../../public/dbconfig.php';
require './user_func.php';
?>
<body>
<h3>用户列表</h3>
<div class="details">

	<div class="details_operation clearfix">
		<div class="bui_select">
			<a href="add_modify.php?act=add"><input type="button" value="添&nbsp;&nbsp;加" class="add"></a>

		</div>
		<form action="" method="get">
			<div style="line-height: 30px;font-size: 14px;float:left;margin-left:10px;padding-left: 1px;background-color:#ccc">
				<input style="height: 25px;text-indent:3px;line-height:25px;background-color:white" type="text" name="keywords" value="<?php echo isset($_GET['keywords'])?$_GET['keywords']:'';?>" placeholder="请输入关键字搜索">
			</div>

			<div style="line-height: 30px;font-size: 14px;float:left;margin-left:10px;padding-left: 1px;background-color:#ccc">
				权限：
				<?php
				if(isset($_GET['level'])){
					//var_dump($_GET['level']);
					$selected = defaultSelected($_GET,'level','selected');
					//var_dump($selected);
				}
				?>
				<select name="level" style="background-color:white">
					<option value="">--请选择--</option>
					<option value="0" <?php echo isset($selected[0])?$selected[0]:''?>>普通会员</option>
					<option value="1" <?php echo isset($selected[1])?$selected[1]:''?>>VIP会员</option>
					<option value="2" <?php echo isset($selected[2])?$selected[2]:''?>>禁用</option>
					<option value="3" <?php echo isset($selected[3])?$selected[3]:''?>>超级会员</option>
				</select>
			</div >
			<div style="line-height: 30px;font-size: 14px;float:left;margin-left:10px;padding-left: 1px;background-color:#ccc">
				性别：
				<?php
				$sex = isset($_GET['sex'])?$_GET['sex']:'';
				if($sex){
					foreach($sex as $k => $v){
						//var_dump($sex);
						if($sex[$k]=='0'){
							$checked[0]='checked';
						}
						if($sex[$k]=='1'){
							$checked[1]='checked';
						}
						if($sex[$k]=='2'){
							$checked[2]='checked';
						}
					}
					//var_dump($sex);
				}
				?>
				<input type="checkbox" name="sex[]" value="0" <?php echo isset($checked[0])?$checked[0]:''?>>女
				<input type="checkbox" name="sex[]" value="1" <?php echo isset($checked[1])?$checked[1]:''?>>男
				<input type="checkbox" name="sex[]" value="2" <?php echo isset($checked[2])?$checked[2]:''?>>保密&nbsp;
				id:
				<input style="background-color:white; width:25px;" type="text" name="id1" value="<?php echo isset($_GET['id1'])?$_GET['id1']:'';?>">
				到
				<input style="background-color:white;width:25px;" type="text" name="id2" value="<?php echo isset($_GET['id2'])?$_GET['id2']:'';?>">
			</div>
			<input style="width: 92px;height: 30px;font-family: 微软雅黑; margin-left:10px;   font-size: 14px;background-color: #E8E8E8;  height: 30px;"type="submit" value="搜索">
		</form>
	</div>
	<!--表格-->
	<table class="table" cellspacing="0" cellpadding="0">
		<thead>
		<tr>
			<th width="15%">编号</th>
			<th width="20%">用户名</th>
			<th width="20%">等级</th>
			<th width="20%">添加时间</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<form action="action.php?act=delSelected" method="post">
			<?php

			//调用链接数据库函数
			$link = construct();
			//调用搜索函数
			$search = search();
			//调用分页函数
			$page= page(5,$link,$search['sql'],0);
			$url = "&keywords={$search['keywords']}&level={$search['level']}&id1={$search['id1']}&id2={$search['id2']}";
			//准备sql语句
			$sql = "SELECT * FROM users WHERE isdel=0 {$search['sql']}  ORDER BY id ASC {$page['limit']}";
			//echo $sql;//die;
			//发送sql语句
			$result = mysqli_query($link,$sql);
			//var_dump($result);
			//判断并处理
			if($result && mysqli_num_rows($result)>0){
				$level = array('普通会员','<font color="red">VIP会员</font>','<font color="#ccc">禁用</font>','<font color="green" size="5">超级会员</font>');
				while($row = mysqli_fetch_assoc($result)){
					$time = date('Y-m-d H:i:s',$row['addtime']);
					$str = <<<EOF
			<tr>
			    <td><label><input type="checkbox" name="check[]" value="{$row['id']}" class="check">{$row['id']}</label></td>
			    <td>{$row['username']}</td>
			    <td>{$level[$row['level']]}</td>
			    <td>{$time}</td>
			    <td align="center">
				    <a href="add_modify.php?act=modify&id={$row['id']}"><input type="button" value="修改" class="btn" ></a>
				    <a href="action.php?act=del&id={$row['id']}"><input type="button" value="删除" class="btn" ></a>
				    <a href="add_modify_info.php?id={$row['id']}&username={$row['username']}"><input type="button" value="查看详细信息" class="btn" ></a>
			    </td>
			</tr>
EOF;
					echo $str;
				}
			}
			$str = <<<EOF
        <tr>
            <td ><input type="submit" value="批量删除" class="btn" ></td>
            <td colspan="5" align="right" valign="top">{$page['num']}条数据 {$page['dPage']}/{$page['all']}页&nbsp;&nbsp;
                <a href="?page=1&$url" target="mainFrame" >首页</a>&nbsp;&nbsp;
                <a href="?page={$page['pre']}$url" target="mainFrame" >上一页</a>&nbsp;&nbsp;
                <a href="?page={$page['next']} $url" target="mainFrame" >下一页</a>&nbsp;&nbsp;
                <a href="?page={$page['all']}$url" target="mainFrame" >尾页</a>
            </td>
       </tr>

EOF;
			echo $str;
			?>
		</form>
		</tbody>
	</table>
</div>
</body>
</html>