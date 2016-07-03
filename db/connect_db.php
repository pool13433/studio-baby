<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_studio";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) { // ติดต่อไม่ได้
    die("Connection failed: " . mysqli_connect_error());
    exit('can not connect to database !!');
}
/* change character set to utf8 */
if (!mysqli_set_charset($conn, "utf8")) { // ตั้งค่าภาษาที่แสดง
    printf("Error loading character set utf8: %s\n", mysqli_error($conn));
    exit();
}

//echo "Connected successfully";
echo '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';

function uploadImage($image, $target_dir) {
    $target_dir = "image/upload/" . $target_dir . "/";
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $new_name = $target_dir . date('YmdHis') . generateRandomString(5) . '.' . $imageFileType;

// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check file size
    if ($image["size"] > 10000000) { //2000000 = 2 MB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($image["tmp_name"], $new_name)) {
            echo "The file " . basename($image["name"]) . " has been uploaded. <br/>";
            return $new_name;
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
            return '';
        }
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
