<?php

session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $id = $_POST['id'];
    $name_th = $_POST['name_thai'];
    $name_eng = $_POST['name_eng'];

    $image = '';

    if (empty($_POST['id'])) {
        $sql = "INSERT INTO album (album_nameth,album_nameeng,album_createdate)
            values ('$name_th','$name_eng',NOW()) ";
    } else {
        $sql = "
                UPDATE album SET
                album_nameth = '$name_th',album_nameeng = '$name_eng',
                album_createdate = NOW()    
                WHERE album_id = $id    
                ";
    }
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    if (empty($id)) {
        $last_id = mysqli_insert_id($conn);
    } else {
        $last_id = $id;
    }
    $file_ary = reArrayFiles($_FILES['image']);
    //var_dump($file_ary);
    //exit();
    foreach ($file_ary as $files) {
        if (is_uploaded_file($files['tmp_name'])) {
            $image = uploadImage($files, 'album');
            if (empty($image)) {
                echo 'เกิดปัญหาในการอัพโหลดไฟล์';
                echo '<meta http-equiv="refresh" content="10; URL=\'package_manage.php\'" />';
                exit();
            }
            $sql = "INSERT INTO album_file (`album_id`, `file_name`)
                    VALUES 
                    ($last_id,'$image')
                    ";
            $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
        }
    }


    mysqli_close($conn);
    if ($execute) {
        echo 'บันทึก ข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'album_manage.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'album_manage.php\'" />';
        exit();
    }
}

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
