<?php
include './db/connect_db.php';
if (!empty($_GET['id'])) {
    $sql = "DELETE FROM prefix WHERE pref_id = " . $_GET['id'];
    $execute = mysqli_query($conn, $sql) or die(mysqli_errno($conn).' sql :=='.$sql);
    if ($execute) {
        echo 'ลบข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'prefix_manage.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'prefix_manage.php\'" />';
        exit();
    }
}