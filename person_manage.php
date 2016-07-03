<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php
$sql = "SELECT * FROM person ORDER BY pers_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="person_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการผู้ใช้งาน</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ-สกุล</th>
                        <th>username-password</th>
                        <th>อีเมลล์</th>
                        <th>โทร</th>
                        <th>ที่อยู่</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$row['pers_fname'].'   '.$row['pers_lname']?></td>
                            <td><?=$row['pers_username'].'   '.$row['pers_password']?></td>
                            <td><?=$row['pers_email']?></td>
                            <td><?=$row['pers_email']?></td>
                            <td>
                                <?=$row['pers_address']?>
                            </td>
                            <td>
                                <a href="person_form.php?id=<?=$row['pers_id']?>"><img src="image/icon/32x32-edit-icon.png"/></a>
                            </td>
                            <td>
                                <a href="person_delete.php?id=<?=$row['pers_id']?>" onclick="return confirm('ยืนยันการลบข้อมูล')">
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