<?php
session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $id = $_POST['id'];
    $name = $_POST['name1'].'x'.$_POST['name2'];
    $unit = $_POST['unit'];
    
    if (empty($_POST['id'])) {
        $sql = "INSERT INTO photo_size (size_name,size_unit)
            values ('$name','$unit') ";
    } else {
        $sql = "
                UPDATE photo_size SET
                size_name = '$name',size_unit = '$unit'
                WHERE size_id = $id    
                ";
    }

    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn).' sql :=='.$sql);
    mysqli_close($conn);
    if ($execute) {
        echo 'บันทึก ข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'photo_size_manage.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        //echo '<meta http-equiv="refresh" content="3; URL=\'photo_size_manage.php\'" />';
        exit();
    }
}
