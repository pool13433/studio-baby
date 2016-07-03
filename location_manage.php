<?php include './inc_header.php'; // นำเข้าไฟล์ header.php เพื่อทำเป็นหัวเว็บ ?>
<?php include './db/connect_db.php'; // นำเข้าไฟล์ ติดต่อฐานข้อมูล ?>
<?php
// สร้าง query เลือก ข้อมูลตาราง Bank เก็บไส่ตัวแปร $sql
$sql = "SELECT * FROM location ORDER BY loc_name ASC";

//  เอา query ที่อยู่ในตัวแปร $sql มาประมวลผล (mysqli_query คือ คำสั่งประมวลผล) ได้ผลลัพธ์มาเก็บใส่ตัวแปล $result
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="location_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการสถานที่ถ่ายภาพ</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>ราคา</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- เอา ตัวแปร $result มาแปลงค่า ด้วยคำสั่ง mysqli_fetch_array เพื่อให้ได้ข้อมูลเป็น แถว ๆ เก็บไว้ที่ตัวแปรชื่อว่า $row-->
                    <?php $i = 1;
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['loc_name'] ?></td>
                            <td><?= $row['loc_price'] ?></td>
                            <td style="text-align: center">
                                <a href="location_form.php?id=<?= $row['loc_id'] ?>">
                                    <img src="image/icon/32x32-edit-icon.png"/>
                                </a>
                            </td>
                            <td style="text-align: center">
                                <a href="location_delete.php?id=<?= $row['loc_id'] ?>" 
                                   onclick="return confirm('ยืนยันการลบข้อมูล')">
                                    <img src="image/icon/32x32-delete-icon.png"/>
                                </a>
                            </td>
                        </tr>
    <?php $i++;
} ?>
                </tbody>
            </table>

        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>