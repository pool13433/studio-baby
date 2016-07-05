<?php

include './db/connect_db.php';
if (!empty($_GET['id'])) {
    $albumId = $_GET['album_id'];
    $sql = "DELETE FROM album_file WHERE file_id = " . $_GET['id'];
    $execute = mysqli_query($conn, $sql) or die(mysqli_errno($conn) . ' sql :==' . $sql);
    if ($execute) {
        echo 'ลบข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'album_form.php?id=' . $albumId . '\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'album_form.php?id=' . $albumId . '\'" />';
        exit();
    }
}