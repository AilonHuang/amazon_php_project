<?php
function page($page,$link){
    //查询一共多少条
    $sql = "SELECT * FROM orders";
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

//默认选中
function defaultSelected(array $row,$name,$selected){
    //echo $name;
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
    }elseif($row[$name]=='4'){
        $select[4] = "$selected";
    }
    //var_dump($select);
    return $select;
}
