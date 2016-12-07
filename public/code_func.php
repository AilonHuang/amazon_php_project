<?php
session_start();
function code($fontFamily='',$w=100,$h=40,$num=4){
	//创建画布
	$img = imagecreatetruecolor($w,$h);
	//分配颜色
	$back = imagecolorallocate($img,mt_rand(200,250),mt_rand(200,250),mt_rand(200,250));
	$red = imagecolorallocate($img,255,0,0);
	//绘画
		//背景
		imagefill($img,0,0,$back);
		//边框
		imagerectangle($img,0,0,$w-1,$h-1,$red);
		//线
		for($i=0;$i<10;$i++){
			$lineColor = imagecolorallocate($img,mt_rand(170,200),mt_rand(170,200),mt_rand(170,200));
			imageline($img,mt_rand(2,$w-2),mt_rand(2,$h-2),mt_rand(2,$w-2),mt_rand(2,$h-2),$lineColor);
		}
		//点
		for($i =0 ;$i<10;$i++){
			$pixelColor = imagecolorallocate($img,mt_rand(130,170),mt_rand(130,170),mt_rand(130,170));
			imagesetpixel($img,mt_rand(2,$w-2),mt_rand(2,$h-2),$pixelColor);
		}
		//字
			//做字
			$str = '3456789abcdefghijkmnpqrstuvwxyABCDEFGHJKLMNPQRSTUVWXYZ';
			for($i=0;$i<$num;$i++){
				$newStr = $str{mt_rand(0,strlen($str)-1)};
				$fontColor = imagecolorallocate($img,mt_rand(0,130),mt_rand(0,130),mt_rand(0,130));
				$x = ($w/$num)*$i+mt_rand(3,8);

				if($fontFamily == ''){
					$y = mt_rand(5,20);
					imagechar($img,mt_rand(3,5),$x,$y,$newStr,$fontColor);
				}else{
					$y = mt_rand($h/2,$h)-3;
					imagettftext($img,mt_rand(12,18),0,$x,$y,$fontColor,$fontFamily,$newStr);
				}
				$_SESSION['verify'] .= $newStr;
			}
		
	//告诉浏览器图片信息
	header('Content-type:image/jpeg');
	//输出图片
	imagejpeg($img);
	//释放资源
	imagedestroy($img);
}
code('./msyh.ttf');