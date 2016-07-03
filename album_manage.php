<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php
$sql = "SELECT *,(SELECT COUNT(*) FROM album_file WHERE album_id = a.album_id ) cnt FROM album a ORDER BY album_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="album_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการอัลบัม</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อไทย</th>
                        <th>ชื่ออังกฤษ</th>
                        <th>จำนวนภาพ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$row['album_nameth']?></td>
                            <td><?=$row['album_nameeng']?></td>
                            <td style="text-align: center"><b><?=$row['cnt']?> ภาพ</b></td>
                            <td style="text-align: center">
                                <a href="album_form.php?id=<?=$row['album_id']?>"><img src="image/icon/32x32-edit-icon.png"/></a>
                            </td>
                             <td style="text-align: center">
                                <a href="album_delete.php?id=<?=$row['album_id']?>" onclick="return confirm('ยืนยันการลบข้อมูล')">
                                    <img src="image/icon/32x32-delete-icon.png"/>
                                </a>
                            </td>
                        </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>

        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>