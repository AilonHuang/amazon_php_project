
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="../include/css/backstage.css">
</head>

<body>
<h2>申请列表</h2>
<div class="details">
    <div class="details_operation clearfix">
        <!-- <div class="bui_select">
             <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdmin()">
         </div>
 -->
    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="15%">编号</th>
            <th width="25%">公司名称</th>
            <th width="30%">公司链接</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once '../../public/function.php';
        require_once '../../public/dbconfig.php';
        $link = construct();
        $sql = "SELECT * FROM link WHERE status=0";
        //echo $sql;
        $result = mysqli_query($link,$sql);
        if($result && mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);
            //var_dump($row);

            $str = <<<EOF
 <tr>
            <!--这里的id和for里面的c1 需要循环出来-->
            <td><label><input type="checkbox" id="c1" class="check"></label>{$row['id']}</label></td>
            <td>{$row['name']}</td>
            <td>{$row['url']}</td>
            <td align="center">
            <a href="action.php?act=tongyi&id={$row['id']}"><input type="button" value="同意" class="btn"></a>
            <a href="action.php?act=jujue&id={$row['id']}"><input type="button" value="拒绝" class="btn"></a>
            </td>
        </tr>
EOF;
            echo $str;
        }
        ?>


        <tr>
            <td colspan="4"></td>
        </tr>

        </tbody>
    </table>
</div>
</body>

</html>