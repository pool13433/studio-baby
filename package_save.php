<?php

include './db/connect_db.php';
if (!empty($_POST)) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $image = '';
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image = uploadImage($_FILES['image'], 'package');
        if (empty($image)) {
            echo 'เกิดปัญหาในการอัพโหลดไฟล์';
            echo '<meta http-equiv="refresh" content="10; URL=\'package_manage.php\'" />';
            exit();
        }
    }

    if (empty($id)) { // new
        $sql = "INSERT INTO package (pac_name,pac_image,pac_createdate) VALUES 
                ('$name','$image',NOW())";
    } else { // edit
        $sql = "UPDATE  package SET
                    pac_name = '$name' ,
                    pac_createdate = NOW() ";
        if (!empty($image)) {
            $sql .= " ,pac_image = '$image' ";
        }

        $sql .= " WHERE pac_id = $id ";
    }
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    mysqli_close($conn);
    if ($execute) {
        echo 'บันทึก ข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'package_manage.php\'" />';
        exit();
    } else {
        echo "Error save record: " . mysqli_error($conn) . ' sqll ::==' . $sql;
        //echo '<meta http-equiv="refresh" content="3; URL=\'package_manage.php\'" />';
        exit();
    }
}
