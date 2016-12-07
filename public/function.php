<?php
//包含数据库配置文件
//require '../../public/dbconfig.php';
//定义一个连接数据库函数
/**
 * @return mysqli
 */
function construct(){
    //链接数据库
    $link = @mysqli_connect(HOST,USER,PWD) or die('连接数据库失败');
    //选择数据库
    mysqli_select_db($link,DBNAME) or die('选择数据库失败');
    //设置字符集
    mysqli_set_charset($link,CHARSET);
    //返回 链接数据库成功返回的对象标示
    return $link;
}


//用户自定义的函数库文件
//制作文件上传函数
//@param1  文件上传的表单名称
//$result = upload('picname','./xiongda');
//var_dump($result);
function upload($pic,$path = './upload',$size = 1000000,array $type = array('image/jpeg','image/png','image/gif')){
    //1.赋值变量
    $file = $_FILES[$pic];
    //2.判断错误号
    if($file['error'] > 0){
        switch($file['error']){
            case 1:
                return '超过了pHP配置文件中设置的upload_max_filesize的值';
            case 2:
                return '超过了HTML表单中设置的MAX_FILS_SIZE设置的值';
            case 3:
                return '只有部分文件被上传';
            case 4;
                return '没有文件上传';
            case 6:
                return '找不到临时目录';
            case 7:
                return '写入失败';
        }
    }
    //3.判断上传文件的大小
    if($file['size'] > $size){
        return '文件上传过大';
    }
    //4.判断上传文件的类型
    if(!in_array($file['type'],$type)){
        return '文件类型不合法';
    }
    //5.判断上传图片的保存的路径
    if(!file_exists($path)){
        mkdir($path);
    }
    //6.为保存的图片重命名
    //获取图片后缀
    $suffix = strrchr($file['name'],'.');
    //做新名  并且 判断 该名字 是否在指定路径中出现，如果出现 在更换其他名字
    do{
        //制作新名
        $newName = md5(time().uniqid().mt_rand(1,1000)).$suffix;
        //拼接完整路径
        //$path = './upload';
        //$path = './upload/'
        $newPath = rtrim($path,'/').'/'.$newName;
    }while(file_exists($newPath));
    //echo $newPath;
    //7.移动图片
    //定义返回的数组
    $info = array();
    if(move_uploaded_file($file['tmp_name'],$newPath)){
        //如果成功 将文件路径 和文件名 用数组反馈
        //将新的图片名 装在数组中
        $info['name'] = $newName;
        //将上传保存的路径  装在数组中
        $info['path'] = $path;
        //将完整的路径和图片名  保存在数组中
        $info['pathInfo'] = $newPath;
        //返回数组
        return $info;
    }else{
        return false;
    }
}


//图片缩放
function thumb($back,$w=100,$h=100,$path='./thumb/',$pre='s_'){
    //打开一张要缩放的图片
    $arr  = explode('.',$back);
    //var_dump($arr);
    //获取后缀
    $suffix = array_pop($arr);
    if($suffix == 'jpg'){
        $suffix = 'jpeg';
    }
    //拼接打开一张已有图片的 变量函数
    $str = 'imagecreatefrom'.$suffix;
    //调用函数 打开图片
    $img = $str($back);
    //获取图片的宽高
    list($width,$height) = getimagesize($back);
    //计算图片缩放比例
    if(($w/$width) > ($h/$height)){
        $dw = $w;
        $dh = $height * ($w/$width);
    }else{
        $dh = $h;
        $dw = $width * ($h/$height);
    }
    //创建缩放画布
    $s_img = imagecreatetruecolor($dw,$dh);
    //执行缩放
    imagecopyresampled($s_img,$img,0,0,0,0,$dw,$dh,$width,$height);
    //将缩放的图片保存   判断保存路径
    if(!file_exists($path)){
        mkdir($path);
    }
    //处理图片路径最后的/
    $path = rtrim($path,'/').'/';
    //制作缩放的图片名
    $newName = $pre.$w.'_'.$h.'_'.basename($back);
    //s_100_100_cjk.jpg
    //定义保存图片的变量函数
    $string = 'image'.$suffix;
    //调用保存函数
    $result = $string($s_img,$path.$newName);
    //销毁资源
    imagedestroy($s_img);
    imagedestroy($img);
    $info = array();
    if($result){
        $info['path'] = $path;
        $info['name'] = $newName;
        $info['pathInfo'] = $path.$newName;
        return $info;
    }else{
        return false;
    }
}