
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="../include/css/backstage.css">
</head>

<body>
<h3>订单列表</h3>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <!--            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdmin()">-->
        </div>

    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="5%">编号</th>
            <th width="5%">用户编号</th>
            <th width="5%">订单编号</th>
            <th width="20%">商品名</th>
            <th width="5%">商品图</th>
            <th width="5%">数量</th>
            <th width="5%">收件人</th>
            <th width="10%">电话</th>
            <th width="10%">地址</th>
            <th width="10%">下单时间</th>
            <th width="5%">状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once '../../public/function.php';
        require_once '../../public/dbconfig.php';
        require_once './order_func.php';
        $link = construct();
        $page=page(5,$link);
        //var_dump($page);
        $sql = "SELECT * FROM orders ORDER BY status ASC ,addtime DESC {$page['limit']}";
        //echo $sql;
        $result = mysqli_query($link,$sql);
        if($result && mysqli_num_rows($result)){
            $status = array('新订单','已付款','已发货','已收货','无效订单');
            while($row=mysqli_fetch_assoc($result)){
                //var_dump($row);
                $goodsid = explode(',',$row['goodsid']);
                $name = explode('&&',$row['name']);
                $num = explode(',',$row['num']);
                $n = count($goodsid);
                $price = explode(',',$row['price']);
                $pic = explode(',',$row['pic']);
                $time = date('Y-m-d H:i:s',$row['addtime']);
                //var_dump($name);
                /*for($i=0;$i<$n;$i++){
                    $path = '../../public/upload/thumbGoods/s_50_50_/'.$pic[$i];
                    if(!file_exists($path)){
                        $thumb = thumb('../../public/upload/goods/'.$pic[$i],50,50,'../../public/upload/thumbGoods/');
                        $path = $thumb['pathInfo'];
                    }
                    */?>
                <tr>
                    <!--这里的id和for里面的c1 需要循环出来-->
                    <td><label><input type="checkbox" id="c1" class="check"> <?php echo $row['id']?></label></td>
                    <td><?php echo $row['uid']?></td>
                    <td><?php echo $row['orderid']?></td>
                    <td>
                        <?php
                        for($i=0;$i<$n;$i++){
                            echo '<div style="position:relative;line-height: 50px">'.($i+1)."：".$name[$i].'</div>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        for ($i=0;$i<$n;$i++){
                            $path = '../../public/upload/thumbGoods/s_50_50_/'.$pic[$i];
                            if(!file_exists($path)){
                                $thumb = thumb('../../public/upload/goods/'.$pic[$i],50,50,'../../public/upload/thumbGoods/');
                                $path = $thumb['pathInfo'];
                            }
                            echo '<img src="'.$path.'">';
                        }
                        ?><br>
                    </td>
                    <td>
                        <?php
                        for($i=0;$i<$n;$i++){
                            echo '<div style="position:relative;line-height: 50px">'.$num[$i].'</div>';
                        }
                        ?>
                    </td>
                    <td><?php echo $row['linkname']?></td>
                    <td><?php echo $row['phone']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $time?></td>
                    <td><?php echo $status[$row['status']]?></td>
                    <td align="center">
                        <a href="modify.php?act=modify&id=<?php echo $row['id']?>"><input type="button" value="修改" class="btn" ></a>
                        <!--                            <a href="action.php?act=del&id={$row['id']}"><input type="button" value="删除" class="btn" ></a>-->
                        <a href="info.php?id=<?php echo $row['id']?>"><input type="button" value="查看详细信息" class="btn" ></a>
                    </td>
                </tr>
                <tr>

                </tr>
            <?php }}?>
        <td colspan="12" align="right" valign="top"><?php echo $page['num']?>条数据 <?php echo $page['dPage']?>/<?php echo $page['all']?>页&nbsp;&nbsp;
            <a href="?page=1" target="mainFrame" >首页</a>&nbsp;&nbsp;
            <a href="?page=<?php echo $page['pre']?>" target="mainFrame" >上一页</a>&nbsp;&nbsp;
            <a href="?page=<?php echo  $page['next']?>" target="mainFrame" >下一页</a>&nbsp;&nbsp;
            <a href="?page=<?php echo $page['all']?>" target="mainFrame" >尾页</a>
        </td>
        </tbody>
    </table>
</div>
</body>

</html>