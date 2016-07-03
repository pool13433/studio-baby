<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$sql = "SELECT * FROM `package` ORDER BY pac_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="package_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการแพ๊กเก็ต</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th style="width: 5%;">ลำดับ</th>
                        <th style="width: 15%;">ภาพ</th>
                        <th>ชื่อแพ๊กเก็ต</th>                        
                        <th style="width: 5%;">แก้ไข</th>
                        <th style="width: 5%;">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= $i?></td>                            
                            <td><img src="<?= $row['pac_image'] ?>"/></td>
                            <td><?= $row['pac_name'] ?></td>
                            <td style="text-align: center">
                                <a href="package_form.php?id=<?= $row['pac_id'] ?>"><img src="image/icon/32x32-edit-icon.png"/></a>
                            </td>
                            <td style="text-align: center">
                                <a href="package_delete.php?id=<?= $row['pac_id'] ?>" onclick="return confirm('ยืนยันการลบข้อมูล')">
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