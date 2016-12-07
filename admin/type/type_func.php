<?php
//var_dump($_POST);die;
function add(){
    //判断是否选择了分类
    if($_POST['path'] == ''){
        echo '<script>alert("请选择分类");location="add_modify.php"</script>';
    }elseif($_POST['name']==""){ //判断是否输入了分类名
        echo '<script>alert("请输入分类名");location="add_modify.php"</script>';
    }else {
        //判断是添加顶级分类还是子类
        if ($_POST['path'] != '0') {
            //添加子类
            //var_dump($_POST);
            $path = $_POST['path'];
            $pid = ltrim(strrchr($path, ','), ',');
            $path = $path . ',';

        } else {
            //添加顶级分类
            $pid = 0;
            $path = '0,';
        }
        //echo $pid.'<br>';
        //echo $path;
        $name = $_POST['name'];
        //require '../../public/function.php';
        $link = construct();
        $sql = "INSERT INTO type(name,pid,path) VALUES('$name',$pid,'$path')";
        //echo $sql;
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_affected_rows($link) > 0) {
            echo '<script>alert("添加成功");location="index.php"</script>';
        } else {
            echo '<script>alert("添加失败");location="add_modify.php"</script>';
        }
    }
}