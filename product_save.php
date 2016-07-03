<?php

include './db/connect_db.php';
if (!empty($_POST)) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = '';
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image = uploadImage($_FILES['image'], 'product');
        if (empty($image)) {
            echo 'เกิดปัญหาในการอัพโหลดไฟล์';
            echo '<meta http-equiv="refresh" content="10; URL=\'product_manage.php\'" />';
            exit();
        }
    }

    if (empty($id)) { // new
        $sql = "INSERT INTO product (prod_name,prod_image,prod_price,prod_createdate) VALUES 
                ('$name','$image',$price,NOW())";
    } else { // edit
        $sql = "UPDATE  product SET
                    prod_name = '$name' ,prod_price = $price ,
                    prod_createdate = NOW() ";
        if (!empty($image)) {
            $sql .= " ,prod_image = '$image' ";
        }

        $sql .= " WHERE prod_id = $id ";
    }
    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    mysqli_close($conn);
    if ($execute) {
        echo 'บันทึก ข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'product_manage.php\'" />';
        exit();
    } else {
        echo "Error save record: " . mysqli_error($conn) . ' sqll ::==' . $sql;
        //echo '<meta http-equiv="refresh" content="3; URL=\'product_manage.php\'" />';
        exit();
    }
}
