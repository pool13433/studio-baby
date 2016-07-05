<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$sql = "SELECT `prom_id`, `prom_name`, `prom_file`, DATE_FORMAT(prom_startdate,'%d-%m-%Y') prom_startdate, DATE_FORMAT(prom_enddate,'%d-%m-%Y') prom_enddate, `prom_createdate` FROM promotion ORDER BY prom_id ASC";
$result = mysqli_query($conn, $sql);
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <!-- ยินดีต้อนรับ -->
        <h1>ยินดีตอนรับ</h1>
    </td>
</tr>
<?php include './inc_footer.php'; ?>