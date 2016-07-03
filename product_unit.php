<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$sql = " SELECT * FROM product ";
if (!empty($_GET['product_id'])) {
    $sql .= " WHERE prod_id = " . $_GET['product_id'];
}
$sql .= " ORDER BY prod_name ASC";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
$index = 1;
$default_column = 3;
$datas_record = array();
$data_column = array();
while ($row = mysqli_fetch_array($result)) {
    $data_column[] = $row;
    if ($index == $default_column) {
        $datas_record[] = $data_column;
        $data_column = array();
        $index = 0;
    }
    $index++;
}
if (count($data_column) > 0) {
    $datas_record[] = $data_column;
}
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend>แสดงสินค้าในร้าน</legend>
            <table border="1">

                <tbody>
                    <?php foreach ($datas_record as $records) { ?>
                        <tr>
                            <?php $columns = $records ?>
                            <?php foreach ($columns as $column) { ?>
                                <td>
                                    <table style="width: 100%">
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <img src="<?= $column['prod_image'] ?>"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= $column['prod_name'] ?></td>
                                                <td>ราคา <?= $column['prod_price'] ?> บาท</td>
                                            </tr>
                                            <tr style="vertical-align: text-top">
                                                <td colspan="2">
                                                    <form action="cart_add.php" method="post">
                                                        <input type="number" name="number" required/>
                                                        <input type="hidden" name="product_id" value="<?= $column['prod_id'] ?>"/>
                                                        <input type="hidden" name="product_name" value="<?= $column['prod_name'] ?> "/>
                                                        <input type="hidden" name="product_price" value="<?= $column['prod_price'] ?> "/>
                                                        <input type="hidden" name="type" value="UNIT"/>
                                                        <button type="submit">หยิบใส่ตะกร้า</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>                   
                </tbody>
            </table>
        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>