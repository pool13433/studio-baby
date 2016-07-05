<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php
$id = $username = $password = $prefix = $fname = $lname = $birthdate = $idcard = $mobile = $address = $email = '';
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM person WHERE pers_id = " . $_GET['id'];
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_object($result);
    $id = $data->pers_id;
    $username = $data->pers_username;
    $password = $data->pers_password;
    $prefix = $data->pref_id;
    $fname = $data->pers_fname;
    $lname = $data->pers_lname;
    $idcard = $data->pers_idcard;
    $birthdate = $data->pers_birthday;
    $mobile = $data->pers_phone;
    $address = $data->pers_address;
    $email = $data->pers_email;
}
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="person_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการผู้ใช้งาน</legend>
            <form action="person_save.php" method="post" name="person">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">username</td>
                            <td>
                                <input type="hidden" name="id" value="<?= $id ?>"/>
                                <input type="text" name="username" value="<?= $username ?>" required/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td><input type="password" name="password" value="<?= $password ?>" minlength="8" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>คำนำหน้าชื่อ</td>
                            <td>
                                <?php
                                $sql2 = "SELECT * FROM prefix ORDER BY pref_name ASC";
                                $result2 = mysqli_query($conn, $sql2);
                                ?>
                                <select name="prefix" required>
                                    <?php while ($row2 = mysqli_fetch_array($result2)) { ?>
                                        <?php if ($row2['pref_id'] == $prefix) { ?>
                                            <option value="<?= $row2['pref_id'] ?>" selected><?= $row2['pref_name'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $row2['pref_id'] ?>"><?= $row2['pref_name'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <span class="require">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td>ชื่อ</td>
                            <td><input type="text" name="fname" value="<?= $fname ?>" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>สกุล</td>
                            <td><input type="text" name="lname" value="<?= $lname ?>" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>วันเกิด</td>
                            <td><input type="text" class="date" name="birthdate" value="<?= $birthdate ?>" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>รหัสบัตร</td>
                            <td><input type="text" name="idcard" value="<?= $idcard ?>" maxlength="13" minlength="13" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>อีเมลล์</td>
                            <td><input type="email" name="email" value="<?= $email ?>" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>โทร</td>
                            <td><input type="text" name="mobile" maxlength="10" minlength="10" value="<?= $mobile ?>" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>ที่อยู่</td>
                            <td><textarea rows="5" cols="100" name="address" required><?= $address ?></textarea><span class="require">*</span></td>
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
<script type="text/javascript">
    $(function () {
        $('form[name="person"]').submit(function () {
            var password = $(this).find('input[name="password"]').val();
            var idcard = $(this).find('input[name="idcard"]').val();
            var mobile = $(this).find('input[name="mobile"]').val();
            if (password.length < 8) {
                alert('กรุณากรอกข้อมูล password 8 ตัวอักษรขึ้นไปเท่านั้น');
                return false;
            }
            if (idcard.length == 13) {
                alert('กรุณากรอกข้อมูล รหัสบัตร  13 ตัวอักษรเท่านั้น');
                return false;
            }
            if (mobile.length == 10) {
                alert('กรุณากรอกข้อมูลเบอร์โทร  10 ตัวอักษรเท่านั้น');
                return false;
            }
            if (confirm('ยืนยันการบันทึกผู้ใช้งาน')) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>