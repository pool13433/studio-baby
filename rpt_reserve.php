<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend>รายงานยอดการขาย</legend>
            <form  action="rpt_pdf_reserve.php" method="get" target="_blank">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%">วันที่สั่งจอง</td>
                            <td>
                                วันที่จอง<input type="text" class="date" name="date_begin"/>ถึง<input type="text" class="date" name="date_end"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%">วันที่จองใข้งาน</td>
                            <td>
                                วันที่เริ่มใช้งาน<input type="text" class="date" name="use_begin"/>ถึง<input type="text" class="date" name="use_end"/>
                            </td>
                        </tr>
                        <tr>
                            <td>สถานะการจอง</td>
                            <td>
                                <?php $status = array('รอชำระเงิน', 'ชำระเงินแล้ว', 'ยกเลิกจากลูกค้า', 'เกิดข้อผิดพลาด') ?>
                                <select name="status">
                                    <option value="">-- เลือก --</option>
                                    <?php foreach ($status as $index => $data) { ?>
                                        <option value="<?= $index ?>"><?= $data ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="button-green">ออกรายงาน</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </form>
        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>