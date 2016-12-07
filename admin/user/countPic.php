<?php
countPic();
//统计用户函数
function countPic(){

//引入函数文件
    require '../../public/function.php';
    //包含数据库配置文件
    require '../../public/dbconfig.php';
    require './user_func.php';
    $num = countUser();
    $com= $num['com']/$num['all']*360;
    $vip= $num['vip']/$num['all']*360+$com;
    $dis= $num['dis']/$num['all']*360+$vip;
    $su= $num['su']/$num['all']*360+$dis;

    // 创建图像
    $image = imagecreatetruecolor(500, 500);

    // 分配一些颜色
    //背景颜色  白色
    $white = imagecolorallocate($image,255,255,255);
    //普通会员 黑色
    $black = imagecolorallocate($image,0,0,0);
    $darkblack = imagecolorallocate($image,33,33,33);
    //vip会员 红色
    $red      = imagecolorallocate($image, 255, 0, 0);
    $darkred = imagecolorallocate($image,200,0,0);
    //禁用 灰色
    $gray = imagecolorallocate($image,192,192,192);
    $darkgray = imagecolorallocate($image,150,150,150);
    //超级会员 绿色
    $green = imagecolorallocate($image,0,200,0);
    $darkgreen = imagecolorallocate($image,0,150,0);


    $darkgreen  = imagecolorallocate($image,0,255,1);
    $blue = imagecolorallocate($image,1,0,200);
    $darkblue = imagecolorallocate($image,1,0,246);
    $yellow = imagecolorallocate($image,255,255,0);

    //填充画布
    imagefill($image,0,0,$white);

    //写入图片标题
    imagefttext($image,30,0,150,70,$red,'../../public/msyh.ttf','会员统计');
    //imagefttext($image,14,0,0,470,$black,'../../public/msyh.ttf','普通会员：黑色 vip会员：红色 禁用：灰色 超级会员：绿色');
    imagefttext($image,14,0,125,400,$black,'../../public/msyh.ttf','普通会员('.$num['com'].'个，'.sprintf("%.2f", $num['com']/$num['all']*100) .'%)：黑色');
    imagefttext($image,14,0,125,430,$red,'../../public/msyh.ttf','v i p会员('.$num['vip'].'个，'.sprintf("%.2f",$num['vip']/$num['all']*100) .'%)：红色');
    imagefttext($image,14,0,125,460,$gray,'../../public/msyh.ttf','禁　　用('.$num['dis'].'个，'.sprintf("%.2f", $num['dis']/$num['all']*100) .'%)：灰色');
    imagefttext($image,14,0,125,490,$green,'../../public/msyh.ttf','超级会员('.$num['su'].'个，'.sprintf("%.2f", $num['su']/$num['all']*100) .'%)：绿色');

    // 创建 3D 效果

    for($i=270;$i>250;$i--){
        imagefilledarc($image, 250, $i, 400, 100, 0, $com, $darkblack, IMG_ARC_PIE);
        imagefilledarc($image, 250, $i, 400, 100, $com,$vip, $darkred, IMG_ARC_PIE);
        imagefilledarc($image, 250, $i, 400, 100, $vip, $dis, $darkgray, IMG_ARC_PIE);
        imagefilledarc($image, 250, $i, 400, 100, $dis, $su, $darkgreen, IMG_ARC_PIE);
    }

    imagefilledarc($image, 250, 250, 400, 100, 0, $com, $black, IMG_ARC_PIE);
    imagefilledarc($image, 250, 250, 400, 100, $com,$vip, $red, IMG_ARC_PIE);
    imagefilledarc($image, 250, 250, 400, 100, $vip, $dis, $gray, IMG_ARC_PIE);
    imagefilledarc($image, 250, 250, 400, 100, $dis, $su, $green, IMG_ARC_PIE);


    // 输出图像
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}