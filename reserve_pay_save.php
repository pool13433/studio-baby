<?php

include './db/connect_db.php';
if (!empty($_POST)) {
    $pay_id = $_POST['pay_id'];
    $pay_code = $_POST['pay_code'];
    $pay_money = $_POST['pay_money'];
    $pay_bank = $_POST['pay_bank'];
    $pay_date = $_POST['pay_date'];
    $pay_time = $_POST['pay_time'];
    $pay_comment = $_POST['pay_comment'];
    $file = '';
    if (is_uploaded_file($_FILES['pay_file']['tmp_name'])) {
        $file = uploadImage($_FILES['pay_file'], 'payment');
        if (empty($file)) {
            echo 'เกิดปัญหาในการอัพโหลดไฟล์';
            echo '<meta http-equiv="refresh" content="10; URL=\'package_manage.php\'" />';
            exit();
        }
    }

    $sql = "  INSERT INTO payment (`bank_id`, `order_id`,pay_money,`pay_date`, `pay_time`, `pay_file`, `pay_comment`, `pay_createdate`)
            VALUES 
            ($pay_bank,$pay_id,$pay_money,STR_TO_DATE('$pay_date','%Y-%m-%d'),'$pay_time','$file','$pay_comment',NOW())
            ";
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    if ($execute) {
        $pay_status = 1;
        $sql = "UPDATE order_header SET order_status = $pay_status WHERE order_id = $pay_id";
        $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
        if ($execute) {
            echo 'แจ้งสถานะการจ่ายเงิน สำเร็จ';
            echo '<meta http-equiv="refresh" content="1; URL=\'reserve_user.php\'" />';
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
            //echo '<meta http-equiv="refresh" content="3; URL=\'reserve_user.php\'" />';
            exit();
        }
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        //echo '<meta http-equiv="refresh" content="3; URL=\'reserve_user.php\'" />';
        exit();
    }
}