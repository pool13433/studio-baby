<?php

include './db/connect_db.php';
if (!empty($_POST)) {
    $record_photo_size = $_POST['record_photo_size'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    $package = $_POST['package'];
    $price = $_POST['price'];
    $remark = $_POST['remark'];
    $last_id = '';
    if (empty($_POST['id'])) {
        $sql = "
            INSERT INTO package_set (`pac_id`, `pacset_name`, `pacset_price`, `pacset_remark`, `pacset_createdate`)
            VALUES 
            ($package,'$name',$price,'$remark',NOW())
            ";
    } else {
        $sql = "
                UPDATE package_set SET 
                pac_id = $package,pacset_name = '$name',
                pacset_price = $price,pacset_remark = '$remark',
                pacset_createdate = NOW()
                WHERE pacset_id = $id
               ";
    }
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    if (empty($_POST['id'])) {
        $last_id = mysqli_insert_id($conn);
    } else {
        $last_id = $id;
    }
    if ($execute) {
        
        $sql = "DELETE FROM package_set_detail WHERE pacset_id = $last_id";
                    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
        
        for ($i = 0; $i < $record_photo_size; $i++) {
            $str = strval($i);
            $size = $_POST['size' . $str];
            $no = $_POST['no' . $str];
            $detail_id = $_POST['detail' . $str];
            $index = $_POST['index' . $str];
            
            if(!empty($no)){
                $sql = "INSERT INTO package_set_detail (`pacset_id`, `size_id`, `setd_number`, `setd_index`)
                    VALUES 
                    ($last_id,$size,$no,$i)
                    ";       
               $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);    
            }
            /*if (!empty($no)) {
                if (is_numeric($index)) {
                   
                } else {
                    $sql = "
                            UPDATE package_set_detail SET
                            pacset_id = $last_id,
                            size_id  = $size,
                            setd_number = $no    
                            WHERE setd_id = $detail_id
                            ";
                }               
                $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
            } else {
                if (is_numeric($detail_id)) {
                    $sql = "DELETE FROM package_set_detail WHERE setd_id = $detail_id";
                    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
                }
            }*/
        }
        if ($execute) {
            echo 'บันทึก ข้อมูล สำเร็จ';
            echo '<meta http-equiv="refresh" content="1; URL=\'package_set_manage.php\'" />';
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
            //echo '<meta http-equiv="refresh" content="3; URL=\'package_set_manage.php\'" />';
            exit();
        }
    } else {
        echo "Error Insert Data: " . mysqli_error($conn);
        //echo '<meta http-equiv="refresh" content="3; URL=\'package_set_manage.php\'" />';
        exit();
    }
}
