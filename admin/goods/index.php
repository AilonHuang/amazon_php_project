
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="../include/css/backstage.css">
    <link rel="stylesheet" href="../include/js/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
</head>
<?php
//引入函数文件
require '../../public/function.php';
require './goods_func.php';
?>

<body>
<h3>商品列表</h3>
</div>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <a href="add_modify.php"><input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPro()"></a>
        </div>
    </div>
    <form action="" method="get">
        <div style="line-height: 30px;font-size: 14px;float:left;margin-left:10px;padding-left: 1px;background-color:#ccc">
            <input style="height: 25px;text-indent:3px;line-height:25px;background-color:white" type="text" name="keywords" value="<?php echo isset($_GET['keywords'])?$_GET['keywords']:'';?>" placeholder="请输入关键字搜索">
        </div>

        <div style="line-height: 30px;font-size: 14px;float:left;margin-left:10px;padding-left: 1px;background-color:#ccc">
            状态：
            <?php
            if(isset($_GET['state'])){
                //var_dump($_GET['stete']);
//                $selected = defaultSelected($_GET,'level','selected');
                //var_dump($selected);
            }
            ?>
            <select name="level" style="background-color:white">
                <option value="">--请选择--</option>
                <option value="0" <?php echo isset($selected[0])?$selected[0]:''?>>新品</option>
                <option value="1" <?php echo isset($selected[1])?$selected[1]:''?>>上架</option>
                <option value="2" <?php echo isset($selected[2])?$selected[2]:''?>>下架</option>
            </select>
        </div >
        <input style="width: 92px;height: 30px;font-family: 微软雅黑; margin-left:10px;   font-size: 14px;background-color: #E8E8E8;  height: 30px;"type="submit" value="搜索">
    </form>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="5%">编号</th>
            <th width="10%">商品名称</th>
            <th width="5%">商品分类</th>
            <th width="10%">商品图片</th>
            <th width="5%">商品价格</th>
            <th width="5%">商品状态</th>
            <th width="10%">添加时间</th>
            <th width="10%">操作</th>
        </tr>
        </thead>
        <tbody>
        <form action="action.php?act=delSelected" method="post">
            <?php
            require_once '../../public/function.php';
            //包含数据库配置文件
            require '../../public/dbconfig.php';
            //require_once './goods_function.php';
            //调用链接数据库函数
            $link = construct();
            //调用搜索函数
            $search = search();
            //调用分页函数
            $page= page(5,$link,$search['sql'],0);
            $url = "&keywords={$search['keywords']}&state={$search['state']}";
            $sql = "SELECT goods.* ,`type`.name AS typeName FROM goods,`type`  WHERE goods.typeid=type.id {$search['sql']} {$page['limit']}";
            //echo $sql;
            $result = mysqli_query($link,$sql);
            while($row=mysqli_fetch_assoc($result)){
                //定义图片路径
                $path = '../../public/upload/thumbGoods/s_80_80_'.$row['pic'];
                //echo $path;
                //echo '<img src="../../public/upload/goods/'.$row['pic'].'">';
                if(!file_exists($path)){
                    //如果文件不存在，调用缩放函数
                    $thumb = thumb('../../public/upload/goods/'.$row['pic'],80,80,'../../public/upload/thumbGoods/');
                    //var_dump($thumb);
                    if($thumb){
                        $path  = $thumb['pathInfo'];
                    }else{
                        $path = '';
                    }
                }

                $time = date('Y-m-d H:i:s',$row['addtime']);
                $state = array('新添加','<font color="green">在售</font>','<font color="#ccc">下架</font>');
                $str = <<<EOF
        <tr>
            <td><label><input type="checkbox" name="check[]" value="{$row['id']}" class="check">{$row['id']}</label></td>
            <td>{$row['name']}</td>
            <td>{$row['typeName']}</td>
            <td><img src="$path"></td>
            <td>{$row['price']}元</td>
            <td>{$state[$row['state']]}</td>
            <td>$time</td>
            <td align="center">
              <a href="./add_modify.php?act=show&id={$row['id']}&typeid={$row['typeid']}"><input type="button" value="详情" class="btn"></a>
              <a href="./add_modify.php?act=modify&id={$row['id']}&typeid={$row['typeid']}"><input type="button" value="修改" class="btn" ></a>
             
            </td>
        </tr>
EOF;
                echo $str;
            }
            $str = <<<EOF
        <tr>
            <td ></td>
            <td colspan="7" align="right" valign="top">{$page['num']}条数据 {$page['dPage']}/{$page['all']}页&nbsp;&nbsp;
                <a href="?page=1$url" target="mainFrame" >首页</a>&nbsp;&nbsp;
                <a href="?page={$page['pre']}$url" target="mainFrame" >上一页</a>&nbsp;&nbsp;
                <a href="?page={$page['next']} $url" target="mainFrame" >下一页</a>&nbsp;&nbsp;
                <a href="?page={$page['all']}$url" target="mainFrame" >尾页</a>
            </td>
       </tr>
EOF;
            echo $str;
            ?>
        </tbody>
        </form>
    </table>
</div>
</body>
</html>