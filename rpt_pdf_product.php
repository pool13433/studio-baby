<?php
include './MPDF57/mpdf.php';
include './db/connect_db.php';

$sql = "SELECT prod_id,prod_name,prod_price,DATE_FORMAT(prod_createdate,'%d-%m-%Y') as prod_createdate FROM product";
$sql .= " WHERE 1=1";
if(!empty($_GET)){
   if(!empty($_GET['price_begin']) && !empty($_GET['price_end'])){
       $begin = $_GET['price_begin'];
       $end = $_GET['price_end'];
       $sql .= " AND prod_price BETWEEN $begin AND $end";
   } 
   if(!empty($_GET['name'])){
       $name = $_GET['name'];
       $sql .= " AND prod_name LIKE '%$name%'";
   } 
}
$sql .= " ORDER BY prod_name ASC";
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
            <th>วันที่สร้าง</th>
        </tr>
    </thead>
    <tbody>
        <?php $i =1; while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['prod_name'] ?></td>
                <td><?= $row['prod_price'] ?></td>
                <td><?= $row['prod_createdate'] ?></td>
            </tr>
        <?php $i++; } ?>
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

$mpdf->Output('studio_product_' . date('Ymd-Hms') . '.pdf', 'I');
/*
 * *************** end mpdf lib ************
 */