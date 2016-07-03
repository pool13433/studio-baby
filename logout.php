<?php
session_start();
echo '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
unset($_SESSION['person']);
unset($_SESSION['cart']);
echo 'ลงชื่อออกจากระบบสำเร็จ';
echo '<meta http-equiv="refresh" content="2; URL=\'index.php\'" />';
exit();
