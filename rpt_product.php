<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend>รายงานยอดสินค้าคงเหลือ</legend>
            <form  action="rpt_pdf_product.php" method="get" target="_blank">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%">ชื่อสินค้า (มีคำที่ค้นหาในชื่อ)</td>
                            <td>
                                <input type="text"  name="name"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%">ช่สงราคา</td>
                            <td>
                                ตั้งแต่<input type="number"  name="price_begin"/>
                                ถึง<input type="number" name="price_end"/>
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