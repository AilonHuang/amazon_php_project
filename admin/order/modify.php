<?php
//var_dump($_GET);//die;
$id = isset($_GET['id'])?$_GET['id']:'';
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
require_once './order_func.php';
$link = construct();
$sql = "SELECT phone,address,status FROM orders WHERE id=$id";
//echo $sql;
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
//var_dump($row);
$selected = defaultSelected($row,'status','selected');
//var_dump($selected);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
</head>
<body>
<h3>修改订单</h3>
<form action="action.php?act=modify" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">手机号</td>
            <td><input type="text" name="phone" value="<?php echo $row['phone']?>" placeholder="请输入手机号"/></td>
        </tr>
        <tr>
            <td align="right">地址</td>
            <td><textarea name="address" id="" cols="30" rows="3"><?php echo $row['address']?></textarea></td>
        </tr>
        <tr>
            <td align="right">状态</td>
            <td>
                <select name="status">
                    <option value="">--请选择--</option>
                    <option value="0" <?php echo isset($selected[0])?$selected[0]:''?>>新订单</option>
                    <option value="1" <?php echo isset($selected[1])?$selected[1]:''?>>已付款</option>
                    <option value="2" <?php echo isset($selected[2])?$selected[2]:''?>>已发货</option>
                    <option value="3" <?php echo isset($selected[3])?$selected[3]:''?>>已收货</option>
                    <option value="4" <?php echo isset($selected[4])?$selected[4]:''?>>无效订单</option>
                </select>
            </td>
        </tr>
        <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
        <tr>
            <td colspan="2" align="center"><input type="submit"  value="修改"/></td>
        </tr>

    </table>
</form>
</body>
</html>