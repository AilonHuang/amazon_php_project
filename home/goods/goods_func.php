<?php
function page($page,$link,$sql){
    //var_dump($sql);
    //查询一共多少条
    //$sql = "SELECT * FROM goods $sql";
    //var_dump($sql);//die;
    $result = mysqli_query($link,$sql);
//    var_dump($result);
    $arr['num']= mysqli_num_rows($result);
    //求出总页数
    //var_dump($arr['num']);
    $arr['all'] = ceil($arr['num']/$page);
    //获得当前页
    $arr['dPage'] = isset($_GET['page'])?$_GET['page']:1;
    //处理下一页
    $arr['next'] =  $arr['dPage']+1>$arr['all']?$arr['all']: $arr['dPage']+1;
    //处理上一页
    $arr['pre'] =  $arr['dPage']-1<1?1: $arr['dPage']-1;
    //制作limit语句
    $num = ( $arr['dPage']-1)*$page;
    $arr['limit'] = " LIMIT $num,$page";
    //var_dump($arr);
    return $arr;
}
function search(){
    //var_dump($_GET);
    //获取搜索关键字
    $arr['keywords'] = isset($_GET['keywords'])?$_GET['keywords']:'';
    //var_dump(isset($arr['keywords']));
    //默认搜索语句
    $keywords = " AND name LIKE '%{$arr['keywords']}%'";
    //var_dump($keywords);
    //判断是否有关键字
    if(!$arr['keywords']){
        $keywords = '';
    }
    $arr['sql'] = $keywords;
    //var_dump($arr);
    return $arr;
}