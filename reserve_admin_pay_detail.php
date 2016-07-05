<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="reserve_admin.php"><img src="image/icon/32x32-previos-icon.png"/></a>รายละเอียดการชำระเงิน</legend>
            <?php
            $orderId = $_GET['id'];
            $sql = "
                    SELECT 
                    p.pay_id, p.bank_id, p.pay_money, p.order_id, DATE_FORMAT(p.pay_date,'%d-%m-%Y') pay_date,
                    p.pay_time, p.pay_file, pay_comment, DATE_FORMAT(p.pay_createdate,'%d-%m-%Y') pay_createdate
                    ,b.bank_code,b.bank_name 
                    FROM order_header oh
                    JOIN payment p ON p.order_id = oh.order_id
                    JOIN bank b ON b.bank_id = p.bank_id
                    WHERE oh.order_id = $orderId
                    ";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
            $data = mysqli_fetch_object($result);
            ?>
            <table border="1">
                <tbody>
                    <tr>
                        <td style="width: 25%;">จำนวนเงินที่โอน</td>
                        <td><?= $data->pay_money ?> บาท</td>
                    </tr>
                    <tr>
                        <td>วัน เวลา ที่โอน</td>
                        <td>วันที่ <?= $data->pay_date ?> เวลา <?= $data->pay_time ?></td>
                    </tr>
                    <tr>
                        <td>จาก ธนาคาร </td>
                        <td><?= $data->bank_name ?></td>
                    </tr>
                    <tr>
                        <td>วันที่แจ้งการโอนเงิน</td>
                        <td><?= $data->pay_createdate ?></td>
                    </tr>
                    <tr>
                        <td>ไฟล์แนบ</td>
                        <td><a href="<?= $data->pay_file ?>" target="_blank">ดูเอกสารแนบ</a></td>
                    </tr>
                </tbody>
            </table>

        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>