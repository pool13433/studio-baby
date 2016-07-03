<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="index.php"><img src="image/icon/32x32-previos-icon.png"/></a>แก้ไขข้อมูลรหัสผ่าน</legend>
            <form action="change_password_save.php" method="post">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">username</td>
                            <td>
                                <?php $person = $_SESSION['person']; ?>
                                <input type="text" name="username" readonly value="<?=$person->pers_username?>"/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>password ใหม่</td>
                            <td><input type="password" name="password" required/><span class="require">*</span></td>
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