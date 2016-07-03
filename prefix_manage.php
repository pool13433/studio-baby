<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php
$sql = "SELECT * FROM prefix ORDER BY pref_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="prefix_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการคำนำหน้าชื่อ</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>อธิบาย</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$row['pref_name']?></td>
                            <td><?=$row['pref_desc']?></td>
                            <td style="text-align: center">
                                <a href="prefix_form.php?id=<?=$row['pref_id']?>"><img src="image/icon/32x32-edit-icon.png"/></a>
                            </td>
                             <td style="text-align: center">
                                <a href="prefix_delete.php?id=<?=$row['pref_id']?>" onclick="return confirm('ยืนยันการลบข้อมูล')">
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