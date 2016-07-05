<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Studio Online</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/jquery-ui.css"/>
        <link rel="stylesheet" href="css/jquery.timepicker.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/jquery.timepicker.js"></script>
        <script>
            $(function () {
                var startTime = '09:00:00';
                $(".date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    showOn: "both",
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '-90:+0'
                });
                //http://timepicker.co/options/
                $('.time').timepicker({
                    timeFormat: 'HH:mm:ss',
                    minTime: startTime,
                    maxTime: '17:00:00',
                    startTime: startTime, //new Date(0, 0, 0, 15, 0, 0) ,// 3:00:00 PM - noon
                    interval: 15 // 15 minutes
                });
            });
        </script>
    </head>
    <body>
        <div style="margin: 30px 50px 0px 50px;">
            <table border="1" style="width: 100%">
                <tbody>
                    <tr>
                        <td colspan="2" style="height: 150px;;vertical-align: bottom;text-align: right;background-image: url('image/header.jpg')">
                            <?php if (empty($_SESSION['person'])) { ?>
                                <form action="login.php" method="post">
                                    <label>Username <input type="text" name="username"/></label>
                                    <label>Password <input type="password" name="password"/></label>
                                    <button type="submit" class="button-green">เข้าระบบ</button>
                                    <button type="reset" class="button-orange">ล้างค่า</button>
                                    <a href="register.php">สมัครสมาชิก</a>
                                </form>
                            <?php } else { ?>
                                <?php $person = $_SESSION['person']; ?>
                                <p>
                                    <label style="background-color: white">ชื่อ <?= $person->pers_fname ?>
                                        สกุล <?= $person->pers_lname ?>
                                        สถานะ <?php
                                        if ($person->pers_status == 'ADMIN') {
                                            echo 'Administrator';
                                        } else {
                                            echo 'Customer';
                                        }
                                        ?>
                                        <a href="change_profile.php">แก้ไขข้อมูลส่วนตัว</a>
                                        <a href="change_password.php">เปลี่ยนรหัสผ่าน</a>
                                        <a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ')">ออกจากระบบ</a>
                                    </label>
                                </p>
                            <?php } ?>
                        </td>
                    </tr>