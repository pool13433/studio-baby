<?php
include './MPDF57/mpdf.php';
include './db/connect_db.php';

$sql = "SELECT pacset_id,pacset_name,pacset_price,p.pac_name FROM package_set ps ";
$sql .= " JOIN package p ON p.pac_id = ps.pac_id ";
$sql .= " WHERE 1=1";
if (!empty($_GET)) {
    if (!empty($_GET['price_begin']) && !empty($_GET['price_end'])) {
        $begin = $_GET['price_begin'];
        $end = $_GET['price_end'];
        $sql .= " AND ps.pacset_price BETWEEN $begin AND $end";
    }
    if (!empty($_GET['name'])) {
        $name = $_GET['name'];
        $sql .= " AND ps.pacset_name LIKE '%$name%'";
    }
    if (is_numeric($_GET['package'])) {
        $package = $_GET['package'];
        $sql .= " AND  ps.pac_id = $package";
    }
}
$sql .= " ORDER BY ps.pac_id,ps.pacset_name ASC";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
ob_start(); // เริ่ม วาด html
?>
<!--วาด html-->
<h2 style="text-align: center">รายงานยอดสินค้าคงเหลือ</h2>
<table>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อ</th>
            <th>ราคา</th>
            <th>แพ๊กเก็ตหลัก</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['pacset_name'] ?></td>
                <td><?= $row['pacset_price'] ?></td>
                <td><?= $row['pac_name'] ?></td>
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

$mpdf->Output('studio_set_' . date('Ymd-Hms') . '.pdf', 'I');
/*
 * *************** end mpdf lib ************
 */