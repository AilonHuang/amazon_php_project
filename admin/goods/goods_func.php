<?php
function page($page,$link,$sql,$isdel=0){
    //查询一共多少条
    $sql = "SELECT goods.* ,`type`.name AS typeName FROM goods,`type`  WHERE goods.typeid=type.id $sql";
    //echo$sql;//die;
    $result = mysqli_query($link,$sql);
    $arr['num']= mysqli_num_rows($result);
    //求出总页数
    $arr['all'] = ceil($arr['num']/$page);
    //获得当前页
    $arr['dPage'] = isset($_GET['page'])?$_GET['page']:1;
    //处理下一页
    $arr['next'] =  $arr['dPage']+1>$arr['all']?$arr['all']: $arr['dPage']+1;
    //处理上一页
    $arr['pre'] =  $arr['dPage']-1<1?1: $arr['dPage']-1;
    //制作limit语句
    $num = ( $arr['dPage']-1)*$page;
    $arr['limit'] = "LIMIT $num,$page";
    return $arr;
}
function search(){
    //var_dump($_GET);
    //获取搜索关键字
    $arr['keywords'] = isset($_GET['keywords'])?$_GET['keywords']:'';
    //var_dump(isset($arr['keywords']));
    //获取搜索stete
    $arr['state'] = isset($_GET['level'])?$_GET['level']:'';
    //默认搜索语句
    $keywords = " AND goods.name LIKE '%{$arr['keywords']}%'";
    //var_dump($keywords);
    $state = "AND state={$arr['state']}";

    //var_dump($sex);
    //判断是否有关键字
    if(!$arr['keywords']){
        $keywords = '';
    }
    //判断是否选择了等级
    if($arr['state'] ==""){
        $state = '';
    }
    $arr['sql'] = "$keywords $state ";
    //var_dump($arr);
    return $arr;
}
//默认选中
function defaultSelected(array $row,$name,$selected){
    $zero = $one = $two = $three = '';
    //var_dump($row[$name]);
    $select = array();
    if($row[$name]=='0'){
        $select[0]= "$selected";
    }elseif($row[$name]=='1'){
        $select[1] = "$selected";
    }elseif($row[$name]=='2'){
        $select[2] = "$selected";
    }elseif($row[$name]=='3'){
        $select[3] = "$selected";
    }
    //var_dump($select);
    return $select;
}