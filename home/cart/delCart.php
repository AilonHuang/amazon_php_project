<?php
session_start();
if(isset($_GET['id'])){
    unset($_SESSION['cart'][$_GET['id']]);
}else{
    $_SESSION['cart'] = array();
}
echo '<script>alert("删除成功");location="./showCart.php"</script>';