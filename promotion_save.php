<?php

include './db/connect_db.php';
if (!empty($_POST)) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $image = '';
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image = uploadImage($_FILES['image'], 'promotion');
        if (empty($image)) {
            echo 'เกิดปัญหาในการอัพโหลดไฟล์';
            echo '<meta http-equiv="refresh" content="10; URL=\'promotion_manage.php\'" />';
            exit();
        }
    }

    if (empty($id)) { // new
        $sql = "INSERT INTO promotion (`prom_name`, `prom_file`, `prom_startdate`, `prom_enddate`, `prom_createdate`) VALUES 
                ('$name','$image',STR_TO_DATE('$startdate','%d-%m-%Y'), STR_TO_DATE('$enddate','%d-%m-%Y'),NOW())";
    } else { // edit
        $sql = "UPDATE  promotion SET
                    prom_name = '$name' ,
                    prom_startdate = STR_TO_DATE('$startdate','%d-%m-%Y') ,    
                    prom_enddate = STR_TO_DATE('$enddate','%d-%m-%Y') ,   
                    prom_createdate = NOW() ";
        if (!empty($image)) {
            $sql .= " ,prom_file = '$image' ";
        }

        $sql .= " WHERE prom_id = $id ";
    }
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    mysqli_close($conn);
    if ($execute) {
        echo 'บันทึก ข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'promotion_manage.php\'" />';
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn) . ' sqll ::==' . $sql;
        //echo '<meta http-equiv="refresh" content="3; URL=\'package_manage.php\'" />';
        exit();
    }
}
