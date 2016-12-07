
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="../include/css/backstage.css">
</head>
<body>
<h3>分类列表</h3>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add">
        </div>

    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="15%">编号</th>
            <th width="15%">分类树</th>
            <th width="15%">名称</th>
            <th width="15%">父ID</th>
            <th width="25%">路径</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require '../../public/function.php';
        //包含数据库配置文件
        require '../../public/dbconfig.php';
        $link = construct();
        $sql = "SELECT * FROM type ORDER BY CONCAT(path,id) ASC";
        //echo $sql;
        $result = mysqli_query($link,$sql);
        if($result && mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                //var_dump($row);
                $num = substr_count($row['path'],',');
                $num = str_repeat('&nbsp&nbsp&nbsp&nbsp',$num);
                if($row['pid']==0){
                    $img = '<img src="../include/images/dirfirst.gif">';
                }else{
                    $img = '<img src="../include/images/dirsecond.gif">';
                }
                $str = <<<EOF
		<tr>
		    <td><label><!-- <input type="checkbox" class="check"> -->{$row['id']}</label></td>
		    <td>{$num}{$img}</td>
		    <td>{$row['name']}</td>
		    <td>{$row['pid']}</td>
		    <td>{$row['path']}</td>
		    <td align="center">
			 <a href="add_modify.php?id={$row['id']}&pid={$row['pid']}&act=modify&name={$row['name']}"><input type="button" value="修改" class="btn" ></a>
			 <a href="add_modify.php?id={$row['id']}&act=add"><input type="button" value="添加子分类" class="btn"><a>
		    </td>
		</tr>
EOF;
                echo $str;
            }
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