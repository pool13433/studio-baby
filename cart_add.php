<?php

echo '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
session_start();
$carts = array();
if (!empty($_SESSION['carts'])) {
    $carts = $_SESSION['carts'];
}
if (!empty($_POST)) {
    $number = $_POST['number'];
    $type = $_POST['type'];
    if ($type == 'UNIT') {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $carts[] = array(
            'number' => $number,
            'package_id' => '',
            'item_id' => $product_id,
            'item_name' => $product_name,
            'item_price' => $product_price,
            'type_desc' => 'สินค้าประเภทชิ้นเดียว',
            'type' => $type
        );
    } else if ($type == 'PACKAGE') {
        $package_id = $_POST['package_id'];
        $package_set_id = $_POST['package_set_id'];
        $package_set_name = $_POST['package_set_name'];
        $package_set_price = $_POST['package_set_price'];
        $carts[] = array(
            'number' => $number,
            'package_id' => $package_id,
            'item_id' => $package_set_id,
            'item_name' => $package_set_name,
            'item_price' => $package_set_price,
            'type_desc' => 'สินค้าประเภทแพ็กเก็ต',
            'type' => $type
        );
    }
}
$_SESSION['carts'] = $carts;

echo 'บันทึก ข้อมูล ลงตะกร้าสำเร้จ';
echo '<meta http-equiv="refresh" content="1; URL=\'cart.php\'" />';
exit();
