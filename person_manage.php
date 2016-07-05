<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php'; ?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <?php
        $fname = $lname = $idcard = $mobile = $email = $address = '';
        $sql = "SELECT * FROM person WHERE 1=1 ";
        if (!empty($_GET['fname'])) {
            $fname = $_GET['fname'];
            $sql .= " AND pers_fname LIKE '%$fname%'";
        }
        if (!empty($_GET['lname'])) {
            $lname = $_GET['lname'];
            $sql .= " AND pers_lname LIKE '%$lname%'";
        }
        if (!empty($_GET['idcard'])) {
            $idcard = $_GET['idcard'];
            $sql .= " AND pers_idcard LIKE '%$idcard%'";
        }
        if (!empty($_GET['mobile'])) {
            $mobile = $_GET['mobile'];
            $sql .= " AND pers_phone LIKE '%$mobile%'";
        }
        if (!empty($_GET['email'])) {
            $email = $_GET['email'];
            $sql .= " AND pers_email LIKE '%$email%'";
        }
        if (!empty($_GET['address'])) {
            $address = $_GET['address'];
            $sql .= " AND pers_address LIKE '%$address%'";
        }
        $sql .= " ORDER BY pers_id ASC";
        $result = mysqli_query($conn, $sql);
        ?>
        <fieldset>
            <legend>ค้นหาผู้ใช้งาน</legend>
            <form method="get" action="">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 15%;">ชื่อ</td>
                            <td style="width: 35%;"><input type="text" name="fname" value="<?=$fname?>"/></td>
                            <td style="width: 15%;">สกุล</td>
                            <td style="width: 35%;"><input type="text" name="lname" value="<?=$lname?>"/></td>
                        </tr>
                        <tr>
                            <td>เลขบัตร</td>
                            <td><input type="text" name="idcard" value="<?=$idcard?>"/></td>
                            <td>เบอร์โทร</td>
                            <td><input type="text" name="mobile" value="<?=$mobile?>"/></td>
                        </tr>
                        <tr>
                            <td>อีเมลล์</td>
                            <td><input type="text" name="email" value="<?=$email?>"/></td>
                            <td>ที่อยู่</td>
                            <td><input type="text" name="address" value="<?=$address?>" style="width: 200px;"/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">
                                <button type="submit" class="button-green">ค้นหา</button>  
                                <button type="reset" class="button-orange">ล้างค่า</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </fieldset> 

        <fieldset>
            <legend><a href="person_form.php"><img src="image/icon/32x32-add-icon.png"/></a>จัดการผู้ใช้งาน</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ-สกุล</th>
                        <th>username-password</th>
                        <th>อีเมลล์</th>
                        <th>โทร</th>
                        <th>ที่อยู่</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['pers_fname'] . '   ' . $row['pers_lname'] ?></td>
                            <td><?= $row['pers_username'] . '   ' . $row['pers_password'] ?></td>
                            <td><?= $row['pers_email'] ?></td>
                            <td><?= $row['pers_phone'] ?></td>
                            <td>
                                <?= $row['pers_address'] ?>
                            </td>
                            <td>
                                <a href="person_form.php?id=<?= $row['pers_id'] ?>"><img src="image/icon/32x32-edit-icon.png"/></a>
                            </td>
                            <td>
                                <a href="person_delete.php?id=<?= $row['pers_id'] ?>" onclick="return confirm('ยืนยันการลบข้อมูล')">
                                    <img src="image/icon/32x32-delete-icon.png"/>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>

        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>