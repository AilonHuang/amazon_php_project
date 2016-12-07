<?php
require '../include/header.php';
//echo '<script>alert("结算成功");location="order_goods.php"</script>';
?>
<?php
//session_start();
//var_dump($_SESSION);
if(!isset($_SESSION['userid'])) {
    echo '<script>alert("请先登陆");location="../login.php"</script>';
}
?>
    <link rel="stylesheet" href="../include/css/account_center.css">

    <div id="top">
        <div class="car">
            <div class="car_left">
                <h2>结算中心</h2>
                <div class="a_row">
                    <div class="a_row_right a_row_price">数量</div>
                    <div class="a_row_right ">价格</div>
                </div>
                <?php
                $totalprice = $totalnum = 0;
                if(!empty($_SESSION['cart'])){
                    foreach($_SESSION['cart'] as $k=>$v){
                        $totalprice += $_SESSION['cart'][$k]['num']*$_SESSION['cart'][$k]['price'];
                        //$totalnum += $_SESSION['cart'][$k]['num'];
                        //echo $totalnum;
                        ?>
                        <div class="box">

                            <div class="box_left">
                                <div>
                                    <img  width="100" height="100" src="../../public/upload/thumbGoods/s_80_80_<?php echo $v['pic']?>">
                                </div>
                                <div class="box_content">
                                    <h4><a href="../goods/goods_detail.php?id=<?php echo $v['id']?>" class="h1_a"><?php echo $v['name']?></a></h4>
                                    <span class="green">现在有货</span><br>
                                    <span>此商品可享受满99元免费送货 </span><br>
                                    <span><a href="./delCart.php?id=<?php echo $v['id'] ?>" class="nav_a">删除</a> | <a href="" class="nav_a">收藏</a></span>
                                </div>
                            </div>
                            <div class="box_right">
                                <div class="box_right_right a_row_price">
                                    <?php echo $v['num']?>
                                </div>
                                <div class="box_right_right total_price"><?php echo $v['price']?></div>
                            </div>

                        </div>
                        <?php
                    }
                }else{
                    echo '<a href="../index.php">购物车没有商品，请添加商品</a>';
                }
                ?>

                <div class="a_row_bottom">

                    <p>
                        <b>小计（<?php echo count(isset($_SESSION['cart'])?$_SESSION['cart']:'0')?>件商品）:</b><span class="total_price"><?php echo sprintf('%.2f',floatval($totalprice)) ?></span>
                    </p>
                </div>
            </div>
            <div class="car_right">
                <p>
                    <b>小计（<?php echo count(isset($_SESSION['cart'])?$_SESSION['cart']:'0')?>件商品）</b>:<span class="total_price"><?php echo sprintf('%.2f',floatval($totalprice)) ?></span>
                </p>
                <div class="car_right_top">
                    <span><span class="green">您的订单可享受免费配送 </span><br><a href="" class="nav_a">了解更多</a></span>
                </div>
                <div class="car_right_center">
                    <form action="do_account.php" method="post">

                        <input type="submit" value="付款">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="center">
    </div>
    <div id="bottom">

    </div>
<?php
require '../include/footer.php';
?>