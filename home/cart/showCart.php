<?php
include '../include/header.php';
//var_dump($_SESSION);
/*//require_once '';
$link = construct();
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
var_dump($row)*/
?>
    <link rel="stylesheet" href="../include/css/car.css">

    <div class="car">
        <div class="car_left">
            <h2>购物车</h2>
            <div class="a_row">
                <div class="a_row_right a_row_price">数量</div>
                <div class="a_row_right ">价格</div>
            </div>
            <?php
            if(isset($_SESSION['userid'])?$_SESSION['userid']:''){
                $display = 'block';
            }else{
                $display = 'none';
            }
            //echo $display;
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
                                <a href="./updateCart.php?id=<?php echo $v['id']?>&num=-1"><input type="button" value="-"></a> <?php echo $v['num']?> <a href="./updateCart.php?id=<?php echo $v['id']?>&num=1"><input type="button" value="+"></a>
                            </div>
                            <div class="box_right_right total_price"><?php echo $v['price']?></div>
                        </div>

                    </div>
                    <?php
                }
                echo '<a href="./delCart.php"><input type="button" value="清空购物车"></a>';
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
        <div class="car_right" >
            <div class="car_right_top">
                <span><span class="green">您的订单可享受免费配送 </span><br><a href="" class="nav_a">了解更多</a></span>
            </div>
            <div class="car_right_center" >
                <p>
                    <b>小计（<?php echo count(isset($_SESSION['cart'])?$_SESSION['cart']:'0')?>件商品）</b>:<span class="total_price"><?php echo sprintf('%.2f',floatval($totalprice)) ?></span>
                </p>
                <p>
                    <?php
                    if(isset($_SESSION['userid'])?$_SESSION['userid']:''){

                    }else{
                        echo '<a href="../login.php"><input type="button" value="登录进行提交"></a>';
                    }
                    ?>

                </p>
                <form action="do_post.php" method="post" style="display: <?php echo $display?>;">
                    <p>
                        <b>姓名</b><span class="total_price"> <input type="text" name="name"></span>
                    </p>
                    <p>
                        <b>电话</b><span class="total_price"> <input type="number" name="phone"></span>
                    </p>
                    <p>
                        <b>邮编</b><span class="total_price"> <input type="number" name="code"></span>
                    </p>
                    <p>
                        <b>地址</b><span class="total_price"><textarea name="address" id="" cols="30" rows="5"></textarea></span>
                    </p>
                    <?php if(isset($_SESSION['cart'])?$_SESSION['cart']:''){
                        echo '<input type="submit" value="提交订单">';
                    } ?>
                </form>
            </div>
        </div>
    </div>

<?php
include '../include/footer.php';
?>