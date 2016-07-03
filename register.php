<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="index.php"><img src="image/icon/32x32-previos-icon.png"/></a>ลงทะเบียนเข้าใช้งานระบบ</legend>
            <form action="register_save.php" method="post">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">username</td>
                            <td>
                                <input type="text" name="username" required/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td><input type="password" name="password"  required/><span class="require">*</span></td>
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
                                       <option value="<?= $row2['pref_id'] ?>"><?= $row2['pref_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <span class="require">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td>ชื่อ</td>
                            <td><input type="text" name="fname" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>สกุล</td>
                            <td><input type="text" name="lname" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>วันเกิด</td>
                            <td><input type="text" class="date" name="birthdate" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>รหัสบัตร</td>
                            <td><input type="text" name="idcard" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>อีเมลล์</td>
                            <td><input type="email" name="email" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>โทร</td>
                            <td><input type="text" name="mobile" maxlength="10" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>ที่อยู่</td>
                            <td><textarea rows="5" cols="100" name="address" required></textarea><span class="require">*</span></td>
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