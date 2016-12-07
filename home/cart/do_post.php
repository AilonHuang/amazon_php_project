<?php
session_start();
//var_dump($_POST);
//var_dump($_SESSION);
require_once '../../public/function.php';
require_once '../../public/dbconfig.php';
//die;
$link = construct();
$uid = isset($_SESSION['userid'])?$_SESSION['userid']:'';
if(!$uid){
    echo '<script>alert("请先登录");location="../login.php";</script>';
}

$linkname = $_POST['name'];
$phone = $_POST['phone'];
$code = $_POST['code'];
$address = $_POST['address'];
if(!$linkname){
    echo '<script>alert("请输入姓名");location="./showCart.php";</script>';
}else{
    if(!$phone) {
        echo '<script>alert("请输入电话");location="./showCart.php";</script>';
    }else{;
        if(!$code){
            echo '<script>alert("请输入邮编");location="./showCart.php";</script>';
        }else{
            if (!$address){
                echo '<script>alert("请输入地址");location="./showCart.php";</script>';
            }else{
                $link = construct();
                $time = time();
                $num ='';
                $goodsid= '';
                $name='';
                $price = '';
                $pic = '';
                $total ='';
                foreach($_SESSION['cart'] as $k =>$v){
                    $num[]=$v['num'];
                    $goodsid[]=$v['id'];
                    $name[] = $v['name'];
                    $price[] = $v['price'];
                    $pic[] =  $v['pic'];
                    $total += $v['price']*$v['num'];
                    //echo $v['price']*$v['num'].'<br>';
                    //echo $total.'<br>';
                }

//echo $total;
//var_dump($num);
                $num = implode(',',$num);
//var_dump($goodsid);
                $goodsid = implode(',',$goodsid);
                $name = implode('&&',$name);
                $price = implode(',',$price);
                $flag = true;
                $orderid = md5($uid.time());
                $pic = implode(',',$pic);
                $sql = "INSERT INTO orders(uid,linkname,code,phone,total,address,addtime,goodsid,`name`,price,num,orderid,pic) VALUES ($uid,'$linkname','$code','$phone','$total','$address','$time','$goodsid','$name','$price','$num','$orderid','$pic')";
//echo $sql;//die;
                $result= mysqli_query($link,$sql);
                if($result && mysqli_affected_rows($link)>0){
                    //$_SESSION['cart']=array();
                    $_SESSION['cart']=array();
                    echo '<script>alert("提交成功");location="../order/order_goods.php";</script>';
                }else{
                    echo '<script>alert("提交失败");location="./showCart.php";</script>';
                }
            }
        }
    }
}



