<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$sql = "SELECT `pac_id`, `pac_name`, `pac_image`, `pac_createdate`       
        ,(SELECT count(*) FROM package_set WHERE pac_id = p.pac_id) as count_item
        FROM package p ORDER BY pac_name ASC";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
$cnt = mysqli_num_rows($result);
var_dump($cnt);
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
                                                    <img src="<?= $column['pac_image'] ?>" style="width: 100%;"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= $column['pac_name'] ?> [มี <?= $column['count_item'] ?> ชุด]</td>
                                                <td><a href="product_package_set.php?id=<?= $column['pac_id'] ?>&name=<?= $column['pac_name'] ?>">ชุดแพ๊กเก็ต</a></td>
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