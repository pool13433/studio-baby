<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$id = $name1 = $name2 = $unit = '';
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM photo_size WHERE size_id = " . $_GET['id'];
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_object($result);
    $id = $data->size_id;
    $name = explode("x", $data->size_name);
    $name1 = $name[0];
    $name2 = $name[1];
    $unit = $data->size_unit;
}
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="photo_size_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการขนาดรูป</legend>
            <form action="photo_size_save.php" method="post">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">ชื่อขนาดรูป</td>
                            <td>
                                <input type="hidden" name="id" value="<?= $id ?>"/>
                                <input type="number" name="name1" value="<?= $name1 ?>" required/>
                                X
                                <input type="number" name="name2" value="<?= $name2 ?>" required/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>หน่วย</td>
                            <td> 
                                <select name="unit" required>
                                    <?php $units = array( 'เซนติเมตร','นิ้ว'); ?>
                                    <?php foreach ($units as $index => $value) { ?>
                                        <?php if ($unit == $value) { ?>
                                            <option value="<?= $value ?>" selected><?= $value ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <span class="require">*</span></td>
                        </tr>                        
                        <tr>
                            <td></td>
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