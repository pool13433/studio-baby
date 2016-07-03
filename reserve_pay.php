<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="reserve_user.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มยืนยันการจ่ายเงิน</legend>
            <form action="reserve_pay_save.php" method="post" enctype="multipart/form-data">
                <table border="1">
                    <tbody>
                        <tr>
                            <td>รหัสการจอง</td>
                            <td>
                                <input type="hidden"  name="pay_id"  value="<?= $_GET['id'] ?>"/>
                                <input type="text"  name="pay_code"  value="<?= $_GET['code'] ?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนเงินที่จ่าย</td>
                            <td>
                                <input type="number"  name="pay_money" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>ธนาคาร</td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM bank ORDER BY bank_name ASC";
                                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
                                ?>
                                <select name="pay_bank" required>
                                    <option value="">-- เลือก ธนาคาร -- </option>
                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                        <option value="<?=$row['bank_id']?>"><?=$row['bank_name'].'('.$row['bank_code'].')'?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">วันที่ เวลาที่ชำระเงิน</td>
                            <td>
                                <label>
                                    วันที่ <input type="text" class="date" name="pay_date" required/>
                                    เวลา <input type="times" name="pay_time" required/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>แนบไฟล์</td>
                            <td>
                                <input type="file"  name="pay_file" required accept="image/*,application/pdf"/>
                            </td>
                        </tr>
                        <tr>
                            <td>เพิ่มเติม</td>
                            <td>
                                <textarea rows="5" cols="50" name="pay_comment"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit" class="button-green" onclick="return confirm('ยืนยันการแจ้งการชำระเงิน')">ยืนยันการแจ้งการชำระเงิน</button>
                                <button type="reset" class="button-orange">ล้างฟอร์ม</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>