<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="index.php"><img src="image/icon/32x32-previos-icon.png"/></a>แก้ไขข้อมูลรหัสผ่าน</legend>
            <form action="change_password_save.php" method="post" name="changepassword">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">username</td>
                            <td>
                                <?php $person = $_SESSION['person']; ?>
                                <input type="text" name="username" readonly value="<?= $person->pers_username ?>"/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td><input type="password" name="password_old"  required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>password ใหม่</td>
                            <td><input type="password" name="password_new" minlength="8" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>password ใหม่ อีกครั้ง</td>
                            <td><input type="password" name="password_renew" minlength="8" required/><span class="require">*</span></td>
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
        var password = '<?= $person->pers_password ?>';

        $('form[name="changepassword"]').submit(function () {
            var password_old = $(this).find('input[name="password_old"]').val();
            var password_new = $(this).find('input[name="password_new"]').val();
            var password_renew = $(this).find('input[name="password_renew"]').val();
            console.log('password ::==' + password);
            console.log('password_old ::==' + password_old);
            console.log('password_new ::==' + password_new);
            console.log('password_renew ::==' + password_renew);
            if (password != password_old) {
                alert('กรอกรหัสผ่านเก่า ไม่ถูกต้อง');
                return false;
            }
            if (password_new != password_renew) {
                alert('กรอกรหัสผ่านใหม่ ไม่ตรงกัน');
                return false;
            }
            if (confirm('ยืนยันการเปลี่ยนรหัสผ่าน')) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>