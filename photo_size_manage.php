<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php
$sql = "SELECT * FROM photo_size ORDER BY size_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="photo_size_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการขนาดรูป</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>หน่วย</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$row['size_name']?></td>
                            <td><?=$row['size_unit']?></td>
                            <td style="text-align: center">
                                <a href="photo_size_form.php?id=<?=$row['size_id']?>"><img src="image/icon/32x32-edit-icon.png"/></a>
                            </td>
                             <td style="text-align: center">
                                <a href="photo_size_delete.php?id=<?=$row['size_id']?>" onclick="return confirm('ยืนยันการลบข้อมูล')">
                                    <img src="image/icon/32x32-delete-icon.png"/>
                                </a>
                            </td>
                        </tr>
                    <?php $i++;} ?>
                </tbody>
            </table>

        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>