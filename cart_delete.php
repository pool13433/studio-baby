<?php

echo '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
session_start();
$carts = array();
if (!empty($_SESSION['carts'])) {
    $carts = $_SESSION['carts'];
}
if (!empty($_GET)) {
    $index = $_GET['index'];
    unset($carts[intval($index)]);
}
$_SESSION['carts'] = $carts;

echo 'ลบ ข้อมูล ออกจากตะกร้าสำเร้จ';
echo '<meta http-equiv="refresh" content="1; URL=\'cart.php\'" />';
exit();
