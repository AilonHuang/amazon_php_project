<table align="center">
    <caption><h1>友情链接申请表</h1></caption>
    <form action="action.php" method="post">
        <tr>
            <td>公司名称：</td>
            <td><input type="text" name="name" value="<?php echo isset($_GET['name'])?$_GET['name']:''?>" id=""><br></td>
        </tr>

        <tr>
            <td>公司链接：</td>
            <td><input type="url" name="url" value="<?php echo isset($_GET['url'])?$_GET['url']:''?>" id=""><br></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit" value="提交申请"></td>
        </tr>
    </form>
</table>

