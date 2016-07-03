<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<?php $person = $_SESSION['person'];?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="index.php"><img src="image/icon/32x32-previos-icon.png"/></a>แก้ไขข้อมูลผู้ใช้งาน</legend>
            <form action="change_profile_save.php" method="post">
                <table border="1">
                    <tbody>
                        <tr>
                            <td>คำนำหน้าชื่อ</td>
                            <td>
                                <?php
                                $sql2 = "SELECT * FROM prefix ORDER BY pref_name ASC";
                                $result2 = mysqli_query($conn, $sql2);
                                ?>
                                <input type="hidden" name="id" value="<?= $person->pers_id ?>"/>
                                <select name="prefix" required>                                    
                                    <?php while ($row2 = mysqli_fetch_array($result2)) { ?>
                                        <?php if ($person->pref_id == $row2['pref_id']) { ?>
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
                            <td><input type="text" name="fname" value="<?= $person->pers_fname ?>" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>สกุล</td>
                            <td><input type="text" name="lname" value="<?= $person->pers_lname ?>"  required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>วันเกิด</td>
                            <td><input type="text" class="date" name="birthdate"  value="<?= $person->pers_birthday ?>"  required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>รหัสบัตร</td>
                            <td><input type="text" name="idcard" value="<?= $person->pers_idcard ?>"  required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>อีเมลล์</td>
                            <td><input type="email" name="email" value="<?= $person->pers_email ?>"  required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>โทร</td>
                            <td><input type="text" name="mobile" maxlength="10" value="<?= $person->pers_phone ?>"  required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>ที่อยู่</td>
                            <td><textarea rows="5" cols="100" name="address" required><?= $person->pers_address ?></textarea><span class="require">*</span></td>
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