<?php
// เรียกใช้งาน session
session_start();

// นำเข้าไฟล์ ติดต่อฐานข้อมูล
include './db/connect_db.php';

if (!empty($_POST)) {// ตรวจสอบค่าที่ได้จากหน้า form ว่ามันมีค่าหรือเปล่า (empty เอาไวตรวจค่าว่าง)
	
	// รับค่าจากหน้า form เก็บใส่ตัวแปร
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    
	// ตรวจสอบค่า ID ของข้อมูลว่าว่างหรือเปล่า
    if (empty($_POST['id'])) { // ตรวจสอบว่าว่าง ทำในนี้
		// สร้างคำสั่ง INSERT เก็บใส่ตัวแปร $sql
        $sql = "INSERT INTO location (loc_name,loc_price)
            values ('$name','$price') ";
    } else { // ไม่ว่าง ทำในนี้
		// สร้างคำสั่ง UPDATE เก็บใส่ตัวแปร $sql
        $sql = "
                UPDATE location SET
                loc_name = '$name',loc_price = '$price'
                WHERE loc_id = $id    
                ";
    }
	
	// ประมวลผลคำสั่้ง INSERT จากตัวแปร $sql เก็บผลการ ประมวลผลใส่ตัวแปร $execute (true,false)
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn).' sql :=='.$sql);
    mysqli_close($conn);
    if ($execute) { // ตรวจสอบสถานะการประมวลผล สำเร็จหรือไม่สำเร็จ
        echo 'บันทึก ข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'location_manage.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'location_manage.php\'" />';
        exit();
    }
}
