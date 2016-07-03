<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php
$sql = "SELECT * FROM product ORDER BY prod_name ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="product_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการสินค้า</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รูป</th>
                        <th>ชื่อ</th>
                        <th>ราคา</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i= 1; while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><img src="<?=$row['prod_image']?>"/></td>
                            <td><?=$row['prod_name']?></td>
                            <td><?=$row['prod_price']?></td>
                            <td style="text-align: center">
                                <a href="product_form.php?id=<?=$row['prod_id']?>"><img src="image/icon/32x32-edit-icon.png"/></a>
                            </td>
                             <td style="text-align: center">
                                <a href="product_delete.php?id=<?=$row['prod_id']?>" onclick="return confirm('ยืนยันการลบข้อมูล')">
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