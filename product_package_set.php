<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$datas_record = array();
$package_id = '';
if (!empty($_GET['id'])) {
    $package_id = $_GET['id'];
    $sql = "SELECT * FROM package_set WHERE pac_id = $package_id ";
    if(!empty($_GET['product_id'])){
       $sql .= " AND pacset_id = ".$_GET['product_id']; 
    }
    $sql .= "  ORDER BY pacset_name ASC";
    //var_dump($sql);
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
    $index = 0;
    $default_column = 3;

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
}
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="product_package.php"><img src="image/icon/32x32-previos-icon.png"/></a>แสดงสินค้ากลุ่ม [<?= (empty($_GET['name']) ? '' : $_GET['name']) ?>]</legend>
            <table border="1">

                <tbody>
                    <?php foreach ($datas_record as $records) { ?>
                        <tr style="vertical-align: top">
                            <?php $columns = $records ?>
                            <?php foreach ($columns as $column) { ?>
                                <td>
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td>ชื่อชุด <?= $column['pacset_name'] ?></td>
                                                <td>ราคา  <?= $column['pacset_price'] ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <?php
                                                    $pacset_id = $column['pacset_id'];
                                                    $sql = "SELECT * FROM package_set_detail psd
                                                        JOIN photo_size ps ON ps.size_id = psd.size_id
                                                            WHERE psd.pacset_id = $pacset_id 
                                                            ORDER BY psd.setd_number ASC";
                                                    //var_dump($sql);
                                                    $result1 = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
                                                    ?>
                                                    <ul>
                                                        <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
                                                            <li>ขนาดรูป <?= $row1['size_name'] ?> จำนวน <?= $row1['setd_number'] ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr style="vertical-align: text-top">
                                                <td colspan="2">
                                                    <form action="cart_add.php" method="post">
                                                        <input type="number" name="number" required/>
                                                        <input type="hidden" name="package_id" value="<?= $package_id ?>"/>
                                                        <input type="hidden" name="package_set_id" value="<?= $column['pacset_id'] ?> "/>
                                                        <input type="hidden" name="package_set_name" value="<?= $column['pacset_name'] ?> "/>
                                                        <input type="hidden" name="package_set_price" value="<?= $column['pacset_price'] ?> "/>
                                                        <input type="hidden" name="type" value="PACKAGE"/>
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