<?php
include './MPDF57/mpdf.php';
include './db/connect_db.php';

$sql = "SELECT ";
$sql .= " order_id,order_code,CONCAT(pers_fname,'    ',pers_lname) fullname,DATE_FORMAT(order_date,'%d-%m-%Y') order_usedate, ";
$sql .= " DATE_FORMAT(order_createdate,'%d-%m-%Y') order_createdate,order_totalprice,order_deposit, ";
$sql .= " CASE order_status WHEN 0 THEN 'ยังไม่จ่าย' ";
$sql .= " WHEN 1 THEN 'จ่ายแล้ว' ";
$sql .= " WHEN 2 THEN 'ยกเลิกจากลูกค้า' ";
$sql .= " WHEN 3 THEN 'เกิดข้อผิดพลาด' ";
$sql .= " END order_status";
$sql .= " FROM order_header  oh";
$sql .= " JOIN person p ON p.pers_id = oh.pers_id";
$sql .= " WHERE 1=1";
if (!empty($_GET)) {
    if (!empty($_GET['date_begin']) && !empty($_GET['date_end'])) {
        $begin = $_GET['date_begin'];
        $end = $_GET['date_end'];
        $sql .= " AND order_createdate BETWEEN STR_TO_DATE('$begin','%d-%m-%Y') AND STR_TO_DATE('$end','%d-%m-%Y')";
    }
    if (!empty($_GET['use_begin']) && !empty($_GET['use_end'])) {
        $begin = $_GET['use_begin'];
        $end = $_GET['use_end'];
        $sql .= " AND order_date BETWEEN STR_TO_DATE('$begin','%d-%m-%Y') AND STR_TO_DATE('$end','%d-%m-%Y')";
    }
    if (is_numeric($_GET['status'])) {
        $sql .= " AND order_status = " . $_GET['status'];
    }
}
$sql .= " ORDER BY oh.pers_id ASC";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
ob_start(); // เริ่ม วาด html
?>
<!--วาด html-->
<h2 style="text-align: center">รายงานข้อมูลยอดสั่งจอง</h2>
<table>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>เลขที่ใบจอง</th>
            <th>ชื่อ-สกุล</th>
            <th>วันที่จอง</th>
            <th>วันที่ใข้งาน</th>
            <th>จำนวนเงินเต็ม</th>
            <th>จำนวนเงินมัดจำ</th>
            <th>สถานะ</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['order_code'] ?></td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['order_usedate'] ?></td>
                <td><?= $row['order_createdate'] ?></td>
                <td><?= $row['order_totalprice'] ?></td>
                <td><?= $row['order_deposit'] ?></td>
                <td><?= $row['order_status'] ?></td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
<?php
$html = ob_get_contents(); // รับ html ที่วาดทั้งหมด
ob_end_clean(); // ล้าง html ทั้งหมด

/*
 * *************** start mpdf lib ************
 */
$mpdf = new mPDF('UTF-8');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetAutoFont();
/*
 * L or landscape: Landscape
  P or portrait: Portrait
 */
$mpdf->AddPage('L');
$mpdf->useDefaultCSS2 = true;

$stylesheet = file_get_contents('./css/report_style.css'); // external css
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html);

$mpdf->Output('studio_reserve_' . date('Ymd-Hms') . '.pdf', 'I');
/*
 * *************** end mpdf lib ************
 */