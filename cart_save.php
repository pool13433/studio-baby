<?php

session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $person = $_SESSION['person'];
    $order_code = date('Ymd_Hms');
    $customer_id = $person->pers_id;
    $total_price = $_POST['total_price'];
    $total_deposit = $_POST['total_deposit'];
    $use_date = $_POST['use_date'];
    $use_time1 = $_POST['use_time1'];
    $use_time2 = $_POST['use_time2'];
    $use_male = $_POST['use_male'];
    $use_fermale = $_POST['use_fermale'];
    $order_status = 0; // 0 = ยังไม่ได้จ่าย,1= จ่ายแล้ว,2 เกิดข้อผิดพลาด
    $approve_status = 0; // 0 = ยังไม่ได้อนุมัต ,1= อนุมัติแล้ว , 3= เกิดข้อผิดพลาด
    $sql = "
            INSERT INTO order_header (order_code,`pers_id`, `order_date`, `order_time_begin`,`order_time_end`, `order_number_fermale`,
            `order_number_male`, `order_totalprice`, `order_deposit`, `order_status`,
            `order_approve_status`, `order_createdate`) VALUES 
            ('$order_code',$customer_id,STR_TO_DATE('$use_date','%d-%m-%Y'),'$use_time1','$use_time2',$use_fermale,
             $use_male,$total_price,$total_deposit,$order_status,
            $approve_status,NOW()
            )
             ";
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . 'sql :==' . $sql);
    $last_id = mysqli_insert_id($conn);
    if ($execute) {
        /*
         * Insert intem to cart
         */
        $carts = $_SESSION['carts'];
        foreach ($carts as $key => $item) {
            $package_id = $item['package_id'];
            $choose_id = $item['item_id'];
            $number = $item['number'];
            $item_price = $item['item_price'];
            $type = $item['type'];
            $sql = "INSERT INTO order_item (`order_id`, `choose_id`, `item_no`, `item_price`, `item_type`) 
                    VALUES
                    ($last_id,$choose_id,$number,$item_price,'$type')
                    ";
            $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . 'sql :==' . $sql);
        }
        
        /*
         * Insert Location To Reserve Location
         */
        $locations = $_POST['location'];
        foreach ($locations as $index => $loc) {
            $sql = "INSERT INTO order_location (`order_id`, `loc_id` ) VALUES ($last_id,$loc)";
            $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . 'sql :==' . $sql);
        }
    }
    if ($execute) {
        unset($_SESSION['carts']);
        echo 'บันทึก ข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'reserve_user.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'reserve_user.php\'" />';
        exit();
    }
}
