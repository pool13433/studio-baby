<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend>รายงานยอดชุดแพ๊กเก็ตคงเหลือ</legend>
            <form  action="rpt_pdf_package_set.php" method="get" target="_blank">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%">ชื่อชุดแพ๊กเก๊ต</td>
                            <td>
                                <input type="text"  name="name"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%">ช่วงราคา</td>
                            <td>
                                ตั้งแต่<input type="number"  name="price_begin"/>
                                ถึง<input type="number" name="price_end"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%">แพ็กเก็ต</td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM package ORDER BY pac_name ASC";
                                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql)
                                ?>
                                <select name="package">
                                    <option value="">-- เลือก --</option>
                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                        <option value="<?=$row['pac_id']?>"><?=$row['pac_name']?></option>
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