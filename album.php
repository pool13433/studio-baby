<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$sql = "SELECT * FROM album ORDER BY album_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend>อัลบัม</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ชืิ่ออัลบัม</th>
                        <th>ภาพ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= $row['album_nameth'] ?></td>
                            <td>
                                <?php
                                $sql_file = "SELECT * FROM album_file WHERE album_id = " . $row['album_id'];
                                $result_file = mysqli_query($conn, $sql_file) or die(mysqli_error($conn) . 'sql ::==' . $sql_file);
                                while ($row1 = mysqli_fetch_array($result_file)) {
                                    ?>
                                    <img src="<?= $row1['file_name'] ?>"/>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>