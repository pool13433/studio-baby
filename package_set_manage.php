<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php
$sql = "SELECT * FROM `package_set` ps 
        JOIN package p ON p.pac_id = ps.pac_id
        ORDER BY ps.pac_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="package_set_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการชุดแพ๊กเก็ต</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อแพ๊กเก็ตหลัก</th>
                        <th>ชื่อเซ็ตแพ๊กเก๊ต</th>
                        <th>ราคา</th>
                        <th>หมายเหตุ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <!-- `pacset_id`, `pac_id`, `pacset_name`, `pacset_price`, `pacset_remark`, `pacset_createdate`-->
                            <td><?=$i?></td>
                            <td><?=$row['pac_name']?></td>
                            <td><?=$row['pacset_name']?></td>
                            <td><?=$row['pacset_price']?></td>
                            <td><?=$row['pacset_remark']?></td>
                            <td style="text-align: center">
                                <a href="package_set_form.php?id=<?=$row['pacset_id']?>"><img src="image/icon/32x32-edit-icon.png"/></a>
                            </td>
                             <td style="text-align: center">
                                <a href="package_set_delete.php?id=<?=$row['pacset_id']?>" onclick="return confirm('ยืนยันการลบข้อมูล')">
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