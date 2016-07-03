<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$sql = "SELECT `prom_id`, `prom_name`, `prom_file`, DATE_FORMAT(prom_startdate,'%d-%m-%Y') prom_startdate, DATE_FORMAT(prom_enddate,'%d-%m-%Y') prom_enddate, `prom_createdate` FROM promotion ORDER BY prom_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend>โปรโมชั่นร้าน</legend>

            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <table border="0" style="width: 33%;display: inline-table">
                    <tbody>
                        <tr>
                            <td>
                                <img src="<?= $row['prom_file'] ?>" style="max-width: 320px;"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #e3ece4">
                                <p style="display: inline-block">ระยะเวลา <?= $row['prom_startdate'] ?> - <?= $row['prom_enddate'] ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            <?php } ?>

        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>