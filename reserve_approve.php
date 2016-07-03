<?php
include './db/connect_db.php';
if (!empty($_GET)) {
    $approve_status = 1;
    $sql = "UPDATE order_header SET order_approve_status = $approve_status WHERE order_id = " . $_GET['id'];
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
    if ($execute) {
        echo 'อนุมัตการสั่งจองสำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'reserve_admin.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'reserve_admin.php\'" />';
        exit();
    }
}
