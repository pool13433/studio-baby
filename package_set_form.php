<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$default = 15;
$id = $package_id = $name = $price = $remark = '';
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM package_set WHERE pacset_id = " . $_GET['id'];
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_object($result);
    // `pacset_id`, `pac_id`, `pacset_name`, `pacset_price`, `pacset_remark`, `pacset_createdate`
    $id = $data->pacset_id;
    $package_id = $data->pac_id;
    $name = $data->pacset_name;
    $price = $data->pacset_price;
    $remark = $data->pacset_remark;
    $date = $data->pacset_createdate;
}

function checkPackageSetDetail($conn, $pacset_id, $index) {
    $sql = "SELECT * FROM package_set_detail WHERE pacset_id = $pacset_id AND setd_index = $index";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_object($result);
    } else {
        return '';
    }
}
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="package_set_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการชุดแพ๊กเก็ต</legend>
            <form action="package_set_save.php" method="post">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">ชื่อ</td>
                            <td>
                                <input type="hidden" name="id" value="<?= $id ?>"/>
                                <input type="text" name="name" value="<?= $name ?>" required/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>เเพ๊คเก็ต</td>
                            <td>
                                <?php
                                $sql1 = "SELECT * FROM package ORDER BY pac_name";
                                $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn) . ' sql ::==' . $sql1);
                                ?>
                                <select name="package" required>
                                    <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
                                        <?php if ($row1['pac_id'] == $package_id) { ?>
                                            <option value="<?= $row1['pac_id'] ?>" selected><?= $row1['pac_name'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $row1['pac_id'] ?>"><?= $row1['pac_name'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <span class="require">*</span></td>
                        </tr>       
                        <tr>
                            <td style="width: 20%;">ราคา</td>
                            <td>
                                <input type="number" name="price" value="<?= $price ?>" required/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">หมายเหตุ</td>
                            <td>
                                <textarea rows="5" cols="50" name="remark"><?= $remark ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">รายละเอียด</td>
                            <td>

                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">ลำดับ</th>
                                            <th>ขนาด</th>
                                            <th>จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql3 = "SELECT * FROM photo_size ORDER BY size_name ASC";
                                        $result3 = mysqli_query($conn, $sql3);
                                        $row_photo_size = mysqli_num_rows($result3);
                                        ?>
                                        <?php //for ($i = 0; $i < $row_photo_size; $i++) { 
                                            $i = 0;
                                            while ($pic_size = mysqli_fetch_array($result3)){                                            
                                        ?>
                                            <?php
                                            $no = $size = $index = $detail_id = $pacset_id = '';
                                            if (!empty($_GET['id'])) {
                                                $pac_set_detail = checkPackageSetDetail($conn, $id, $i);
                                                if (gettype($pac_set_detail) == 'object') {
                                                    $no = $pac_set_detail->setd_number;
                                                    $size = $pac_set_detail->size_id;
                                                    $index = $pac_set_detail->setd_index;
                                                    $detail_id = $pac_set_detail->setd_id;
                                                    $pacset_id = $pac_set_detail->pacset_id;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td><?= ($i + 1) ?>
                                                    <input type="hidden" name="index<?= $i ?>" value="<?= $index ?>"/>
                                                    <input type="hidden" name="detail<?= $i ?>" value="<?= $detail_id ?>"/>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="size<?= $i ?>" value="<?=$pic_size['size_id']?>"/>
                                                    <?=$pic_size['size_name'];?>                                                    
                                                </td>
                                                <td><input type="number" name="no<?= $i ?>" value="<?= $no ?>"/></td>
                                            </tr>
                                        <?php  $i++;} ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="record_photo_size" value="<?= $row_photo_size ?>"/></td>
                            <td><button type="submit" class="button-green">บันทึก</button>
                                <button type="reset" class="button-orange">ล้างฟอร์ม</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>
