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
                        `order_id`, `order_code`, 
                        DATE_FORMAT(`order_date`,'%d-%m-%Y') order_date,
                         `order_time_begin`, `order_time_end`, 
                        TIMEDIFF(`order_time_end`, `order_time_begin`) diff_time,
                        `order_number_fermale`, `order_number_male`, 
                        `order_totalprice`, `order_deposit`, `order_status`, 
                        `order_approve_status`, DATE_FORMAT(`order_createdate`,'%d-%m-%Y') order_createdate, 
                        `order_takephoto`,
                        
                        oh.pers_id, CONCAT(p.pers_fname,'  ',p.pers_lname) customer_name
                        FROM order_header  oh 
                        JOIN person p ON p.pers_id = oh.pers_id ";
                $sql .= " WHERE 1=1 ";
                if (!empty($_GET)) {
                    if (!empty($_GET['order_code'])) {
                        $sql .= " AND order_code LIKE '%" . trim($_GET['order_code']) . "%' ";
                    }
                    if (!empty($_GET['order_code'])) {
                        $sql .= " AND (pers_fname LIKE '%" . trim($_GET['order_customer']) . "%' OR pers_lname LIKE '%" . trim($_GET['order_customer']) . "%' ) ";
                    }
                    if (!empty($_GET['order_date'])) {
                        $sql .= " AND order_createdate  = STR_TO_DATE('" . trim($_GET['order_date']) . "','%d-%m-%Y') ";
                    }
                    if (!empty($_GET['use_date'])) {
                        $sql .= " AND order_date  = STR_TO_DATE('" . trim($_GET['use_date']) . "','%d-%m-%Y') ";
                    }

                    //order_status=&approve_status=1
                    if (!empty($_GET['order_status']) || is_numeric($_GET['order_status'])) {
                        $sql .= " AND order_status  = " . $_GET['order_status'];
                    }
                    if (!empty($_GET['approve_status']) && is_numeric($_GET['approve_status'])) {
                        $sql .= " AND order_approve_status  =  " . $_GET['approve_status'];
                    }
                }
                $sql .= " ORDER BY p.pers_fname,oh.order_code DESC";
                //var_dump($sql);
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
                ?>
                <fieldset>
                    <legend>ฟอร์มค้นหาใบจอง</legend>
                    <form method="get" action="reserve_admin.php">
                        <table border="1">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">เลขใบจอง</td>
                                    <td><input type="text" name="order_code" value="<?= (empty($_GET['order_code']) ? '' : $_GET['order_code']) ?>"/></td>
                                    <td style="width: 20%">ลูกค้าสั่งจอง</td>
                                    <td><input type="text" name="order_customer" value="<?= (empty($_GET['order_customer']) ? '' : $_GET['order_customer']) ?>"/></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">วันที่สั่งจอง</td>
                                    <td><input type="text" class="date" name="order_date" value="<?= (empty($_GET['order_date']) ? '' : $_GET['order_date']) ?>"/></td>
                                    <td style="width: 20%">วันที่ใช้งาน</td>
                                    <td><input type="text" class="date" name="use_date" value="<?= (empty($_GET['use_date']) ? '' : $_GET['use_date']) ?>"/></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">สถานะการสั่งจอง</td>
                                    <td>
                                        <?php $order_status = array('ยังไม่จ่าย', 'จ่ายแล้ว', 'ยกเลิก', 'เกิดข้อผิดพลาด'); ?>
                                        <select name="order_status">
                                            <option value=""> -- เลือก --</option>
                                            <?php foreach ($order_status as $index => $data1) { ?>
                                                <?php if ($index == $_GET['order_status']) { ?>
                                                    <option value="<?= $index ?>" selected><?= $data1 ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $index ?>"><?= $data1 ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width: 20%">สถานะการอนุมัติ</td>
                                    <td><!-- สถานะ การอนุมัติ 0 = ยัง,1 = แล้ว,2 = error-->
                                        <?php $approve_status = array('ยังไม่ได้อนุมัติ', 'อนุมัติ', 'เกิดข้อผิดพลาด'); ?>
                                        <select name="approve_status">
                                            <option value=""> -- เลือก --</option>
                                            <?php foreach ($approve_status as $index => $data2) { ?>
                                                <?php if ($index == $_GET['approve_status']) { ?>
                                                    <option value="<?= $index ?>" selected><?= $data2 ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $index ?>"><?= $data2 ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <button type="submit" class="button-green">ค้นหา</button>
                                        <button type="reset" class="button-orange">ล้างฟอร์ม</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                </fieldset>
                <hr/>
                <table border="1">
                    <thead>
                        <tr>
                            <th>รหัสใบจอง</th>
                            <th>ชื่อผู้จอง</th>
                            <th>วันที่ใช้งาน</th>
                            <th>เวลาใช้งาน</th>
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
                        <?php while ($row = mysqli_fetch_array($result)) { ?><tr>
                                <td>
                                    <?= $row['order_code'] ?><br/>
                                    <a href="rpt_pdf_invoice.php?id=<?= $row['order_id'] ?>" target="_blank"><img src="image/icon/32x32-save-icon.png"/></a>
                                    <a href="reserve_delete.php?id=<?= $row['order_id'] ?>" onclick="return confirm('ยืนยันการลบข้อมูล ใบสั่งจองนี้ ใช่หรือไม่')"><img src="image/icon/32x32-delete-icon.png"/></a>
                                </td>
                                <td><?= $row['customer_name'] ?></td>
                                <td><?= $row['order_date'] ?></td>
                                <td><?= $row['order_time_begin'] . ' - ' . $row['order_time_end'] ?></td>
                                <td><?= $row['diff_time'] ?></td>
                                <td><?= 'หญิง : ' . $row['order_number_fermale'] . ' ชาย : ' . $row['order_number_male'] ?></td>
                                <td><?= $row['order_totalprice'] ?></td>
                                <td><?= $row['order_deposit'] ?></td>
                                <td><?= $row['order_createdate'] ?></td>
                                <?php
                                switch ($row['order_status']) { //0 = ยังไม่จ่าย,1 = จ่ายแล้ว,2=fail
                                    case 0: echo '<td style="background-color:orange">ยังไม่จ่าย <br/>';
                                        echo '<a href="reserve_pay.php?id=' . $row['order_id'] . '&code=' . $row['order_code'] . '">ยืนยันการจ่ายเงิน</a><br/>';
                                        echo '<a href="reserve_cancel.php?id=' . $row['order_id'] . '" onclick="return confirm(\'ยืนยันการยกเลิกการสั่งจอง\')">ยกเลิกการจอง</a>';
                                        break;
                                    case 1: echo '<td style="background-color:green">จ่ายแล้ว <br/>';
                                        echo '<a href="reserve_admin_pay_detail.php?id=' . $row['order_id'] . '" style="color:white">ดูรายละเอียดการจ่ายเงิน</a>';
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
                                    case 0: echo '<td style="background-color:orange">ยังไม่ได้อนุมัติ <br/>';
                                        echo '<a href="reserve_approve.php?id=' . $row['order_id'] . '" onclick="return confirm(\'อนุมัตการจอง\')">อนุมัตการจอง</a>';
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