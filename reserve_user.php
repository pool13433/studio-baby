<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend>แสดงรายการจองการถ่ายภาพทั้งหมด</legend>
            <?php
            if (!empty($_SESSION['person'])) {
                $customer_id = $_SESSION['person']->pers_id;
                $sql = "SELECT 
                        `order_id`, `order_code`, `pers_id`, 
                        order_date as order_date_1,
                         DATEDIFF(order_date,NOW()) diff_date,
                        DATE_FORMAT(`order_date`,'%d-%m-%Y') order_date,                       
                         `order_time_begin`, `order_time_end`, 
                        TIMEDIFF(`order_time_end`, `order_time_begin`) diff_time,
                        `order_number_fermale`, `order_number_male`, 
                        `order_totalprice`, `order_deposit`, `order_status`, 
                        `order_approve_status`, DATE_FORMAT(`order_createdate`,'%d-%m-%Y') order_createdate, 
                        `order_takephoto`
                        FROM order_header WHERE pers_id =  $customer_id 
                        ORDER BY order_code DESC";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
                ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>รหัสใบจอง</th>
                            <th>วันที่ใช้งาน</th>
                            <th>เวลาใช้งาน</th>
                            <th>ระยะเวลาก่อนถึงวันถ่ายทำ</th>
                            <th>เวลาใช้งาน รวม</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <th>เงินมัดจำ</th>
                            <th>วันที่จอง</th>
                            <th>สถานะการจอง</th>
                            <th>สถานะการอนุมัติ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <!-- `order_id`, `order_code`, `pers_id`, `order_date`, `order_time_begin`, `order_time_end`, 
                            `order_number_fermale`, `order_number_male`, `order_totalprice`, `order_deposit`,
                            `order_status`, `order_payment_datetime`, `order_approve_status`, `order_createdate`, `order_takephoto`-->
                            <tr>
                                <td>
                                    <?= $row['order_code'] ?><br/>
                                    <a href="rpt_pdf_invoice.php?id=<?= $row['order_id'] ?>" target="_blank"><img src="image/icon/32x32-save-icon.png"/></a>
                                </td>
                                <td><?= $row['order_date'] ?></td>                                
                                <td><?= $row['order_time_begin'] . ' - ' . $row['order_time_end'] ?></td>
                                <td><?= $row['diff_date'] ?> วัน</td>
                                <td><?=$row['diff_time']?></td>
                                <td><?= 'หญิง : ' . $row['order_number_fermale'] . ' ชาย : ' . $row['order_number_male'] ?></td>
                                <td><?= $row['order_totalprice'] ?></td>
                                <td><?= $row['order_deposit'] ?></td>
                                <td><?= $row['order_createdate'] ?></td>
                                <?php
                                    switch ($row['order_status']) { //0 = ยังไม่จ่าย,1 = จ่ายแล้ว,2=fail
                                        case 0: echo '<td style="background-color:orange">ยังไม่จ่าย <br/>';
                                            echo '<a href="reserve_cancel.php?id='.$row['order_id'].'" onclick="return confirm(\'ยืนยันการยกเลิกการสั่งจอง\')">ยกเลิกการจอง</a><br/>';
                                            if($row['order_approve_status'] == 1){
                                                echo '<a href="reserve_pay.php?id='.$row['order_id'].'&code='.$row['order_code'].'">ยืนยันการจ่ายเงิน</a><br/>';                                                    
                                            }                                            
                                            break;
                                        case 1: echo '<td style="background-color:green">จ่ายแล้ว';
                                            break;
                                        case 2: echo '<td style="background-color:red">ยกเลิกสถานะการจอง';
                                            break;
                                        case 2: echo '<td style="background-color:black;color:white">เกิดข้อผิดพลาด';
                                            break;
                                        default: break;
                                    }
                                    ?>
                                </td>
                                <?php
                                    switch ($row['order_approve_status']) { //สถานะ การอนุมัติ 0 = ยัง,1 = แล้ว,2 = error
                                        case 0: echo '<td style="background-color:orange">ยังไม่ได้อนุมัติ';
                                            break;
                                        case 1: echo '<td style="background-color:green">อนุมัติแล้ว';
                                            break;
                                        case 2: echo '<td style="background-color:black;color:white">เกิดข้อผิดพลาด';
                                            break;
                                        default: break;
                                    }
                                    ?>
                                </td>
    <?php } ?>
                    </tbody>
                </table>
<?php } ?>
        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>