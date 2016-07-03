<?php
include './MPDF57/mpdf.php';
include './db/connect_db.php';

/*
 * Query Order Header
 */
$sql = " SELECT ";
$sql .= " oh.order_id, oh.order_code, oh.pers_id, DATE_FORMAT(oh.order_date,'%d-%m-%Y') order_date, oh.order_time_begin, oh.order_time_end, ";
$sql .= " oh.order_number_fermale, oh.order_number_male, oh.order_totalprice, oh.order_deposit, ";
$sql .= " oh.order_status, oh.order_approve_status, DATE_FORMAT(oh.order_createdate,'%d-%m-%Y') order_createdate, oh.order_takephoto, ";

$sql .= " CASE order_status WHEN 0 THEN 'ยังไม่จ่าย' ";
$sql .= " WHEN 1 THEN 'จ่ายแล้ว' ";
$sql .= " WHEN 2 THEN 'ยกเลิกจากลูกค้า' ";
$sql .= " WHEN 3 THEN 'เกิดข้อผิดพลาด' ";
$sql .= " END order_status,";

//สถานะ การอนุมัติ 0 = ยัง,1 = แล้ว,2 = error
$sql .= " CASE order_approve_status WHEN 0 THEN 'รอการอนุมัติ' ";
$sql .= " WHEN 1 THEN 'อนุมัติแล้ว' ";
$sql .= " WHEN 2 THEN 'เกิดข้อผิดพลาด' ";
$sql .= " END order_approve_status,";

$sql .= " CONCAT(p.pers_fname,'    ',p.pers_lname) as fullname,p.pers_phone,p.pers_email,p.pers_idcard,";
$sql .= " p.pers_birthday,p.pers_address ";
$sql .= " FROM order_header oh";
$sql .= " JOIN person p ON p.pers_id = oh.pers_id ";
$sql .= " WHERE oh.order_id = " . $_GET['id'];
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
$order = mysqli_fetch_object($result);
$order_id = $order->order_id;

$sql_pac = "SELECT 
        oi.order_id, oi.choose_id, oi.item_no, oi.item_price, oi.item_type,p.pac_name   
        FROM order_item oi
        JOIN package p ON p.pac_id = oi.choose_id
        WHERE oi.item_type = 'PACKAGE' AND oi.order_id = $order_id
        ";
$result_pac = mysqli_query($conn, $sql_pac) or die(mysqli_error($conn) . ' sql ::==' . $sql_pac);

$sql_pro = "SELECT 
        oi.order_id, oi.choose_id, oi.item_no, oi.item_price, oi.item_type,p.prod_name   
        FROM order_item oi
        JOIN product p ON p.prod_id = oi.choose_id
        WHERE oi.item_type = 'UNIT' AND oi.order_id = $order_id
        ";
$result_pro = mysqli_query($conn, $sql_pro) or die(mysqli_error($conn) . ' sql ::==' . $sql_pro);


$sql_loc = "SELECT ol.order_id, ol.loc_id,l.loc_name,l.loc_price FROM order_location ol
        JOIN location l ON l.loc_id = ol.loc_id
        WHERE ol.order_id = $order_id
        ";
$result_loc = mysqli_query($conn, $sql_loc) or die(mysqli_error($conn) . ' sql ::==' . $sql_loc);
$final_total_price = 0;
ob_start(); // เริ่ม วาด html
?>
<!--วาด html-->
<h2 style="text-align: center">ใบสั่งจองคอร์สถ่ายภาพ</h2>
<table>
    <tbody>
        <tr>
            <td style="width: 20%">รหัสใบจอง</td>
            <td><?= $order->order_code ?></td>
            <td style="width: 20%">วันที่จอง</td>
            <td><?= $order->order_createdate ?></td>
        </tr>
        <tr>
            <td>ชื่อคนจอง</td>
            <td><?= $order->fullname ?></td>
            <td>รหัสบัตร</td>
            <td><?= $order->pers_idcard ?></td>
        </tr>
        <tr>
            <td>โทรศัพท์</td>
            <td><?= $order->pers_phone ?></td>
            <td>ทีึ่อยู่</td>
            <td><?= $order->pers_address ?></td>
        </tr>
        
        <tr>
            <td>วันที่จองใช้งาน</td>
            <td><?= $order->order_date ?></td>
            <td>เวลาที่จองใช้งาน</td>
            <td><?= $order->order_time_begin ?> - <?= $order->order_time_end ?></td>
        </tr>
        <tr>
            <td>ผู้ชาย</td>
            <td><?= $order->order_number_male ?></td>
            <td>ผู้หญิง</td>
            <td><?= $order->order_number_fermale ?></td>
        </tr>
        <tr>
            <td>สถานะการจอง</td>
            <td><?= $order->order_status ?></td>
            <td>สถานะการอนุมัติ</td>
            <td><?= $order->order_approve_status ?></td>
        </tr>
        <tr>
            <td>ราคารวมสินค้าที่เลือก</td>
            <td><?= $order->order_totalprice ?></td>
            <td>จ่ายมัดจำ</td>
            <td><?= $order->order_deposit ?></td>
        </tr>
        <tr>
            <td  style="vertical-align: text-top">รายการสินค้าที่จอง</td>
            <td style="vertical-align: text-top">
                <ul>
                    <?php while ($row_pac = mysqli_fetch_array($result_pac)) { ?>
                    <li>PACKAGE: <?=$row_pac['pac_name']?> ราคา <?=$row_pac['item_price']?> จำนวน <?=$row_pac['item_no']?> ชิ้น</li>
                    <?php } ?>
                    <?php while ($row_pro = mysqli_fetch_array($result_pro)) { ?>
                    <li>PRODUCT: <?=$row_pro['prod_name']?> ราคา <?=$row_pro['item_price']?> จำนวน <?=$row_pro['item_no']?> ชิ้น</li>
                    <?php } ?>
                </ul>               
            </td>
            <td  style="vertical-align: text-top">สถานที่ถ่ายทำ</td>
            <td  style="vertical-align: text-top">                
                <ul>
                    <?php while ($row_loc = mysqli_fetch_array($result_loc)) { ?>
                    <li>LOCATION: <?=$row_loc['loc_name']?> ราคา <?=$row_loc['loc_price']?></li>
                    <?php $final_total_price .= $row_loc['loc_price']?>
                    <?php } ?>
                </ul>        
            </td>
        </tr>
        <tr>
            <td>ราคารวมสินค้าที่เลือก  + ค่าใช้จ่ายค่าสถานที่</td>
            <td><?= $order->order_totalprice+$final_total_price ?></td>
            <td></td>
            <td></td>
        </tr>
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