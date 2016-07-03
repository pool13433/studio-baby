<?php

include './db/connect_db.php';
if (!empty($_GET)) {
    $status_cancel = 2;
    $order_id = $_GET['id'];
    $sql = "UPDATE order_header SET order_status = $status_cancel WHERE order_id = $order_id";
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    if ($execute) {
        echo 'ยกเลิกการจองสำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'reserve_user.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        //echo '<meta http-equiv="refresh" content="3; URL=\'reserve_user.php\'" />';
        exit();
    }
}
