<?php include './inc_header.php'; ?>
<?php
$catrs = array();
$total_number = 0;
$total_price = 0;
$total_all = 0;
if (!empty($_SESSION['carts'])) {
    $catrs = $_SESSION['carts'];
}
$count_items = count($catrs);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend>แสดงสินค้าในตะกร้า 
                <a href="product_package.php"><img src="image/icon/32x32-photos-icon.png"/>เลือก แพ็กเก๊ตต่อ</a>
                <a href="product_unit.php"><img src="image/icon/32x32-photo-icon.png"/>เลือก สินค้าต่อ</a>
            </legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ประเภท</th>
                        <th>ชื่อ</th>
                        <th>จำนวน</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>ราคารวม</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $auto = 1;
                    foreach ($catrs as $index => $data) {
                        ?>
                        <tr>
                            <td><?= ($auto) ?></td>
                            <td><?= $data['type_desc'] ?></td>
                            <td>
                                <?php if ($data['type'] == 'UNIT') { ?>
                                    <a href="product_unit.php?product_id=<?= $data['item_id'] ?>"><?= $data['item_name'] ?></a>
                                <?php } else { ?>
                                    <a href="product_package_set.php?product_id=<?= $data['item_id'] ?>&id=<?= $data['package_id'] ?>"><?= $data['item_name'] ?></a>
    <?php } ?>
                            </td>
                            <td style="text-align: center"><?= $data['number'] ?></td>
                            <td style="text-align: center"><?= $data['item_price'] ?></td>
                            <td style="text-align: center"><?= $data['item_price'] * $data['number'] ?></td>
                            <td>
                                <a href="cart_delete.php?index=<?= $index ?>" onclick="return confirm('ยืนยันการลบข้อมูลนี้ออกจากตะกร้า ใช่หรือไม่')"><img src="image/icon/32x32-delete-icon.png"/></a>
                            </td>
                        </tr>
                        <?php
                        $total_number += $data['number'];
                        $total_price += $data['item_price'];
                        $total_all += $data['item_price'] * $data['number'];
                        ?>
                        <?php $auto++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">รวม</th>
                        <th><?= $total_number ?> ชิ้น</th>
                        <th><?= $total_price ?> บาท </th>
                        <th colspan="2"><?= $total_all ?> บาท</th>
                    </tr>
                </tfoot>
            </table>
            <?php if ($count_items > 0) { ?>
                <a href="cart_confirm.php?total_price=<?= $total_all ?>">ถัดไป</a>
<?php } ?>
        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>