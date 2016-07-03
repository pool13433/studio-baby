<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php 
    $id = $name = $price = '';
    if(!empty($_GET['id'])){
       $sql = "SELECT * FROM location WHERE loc_id = ".$_GET['id']; 
       $result = mysqli_query($conn, $sql);
       $data = mysqli_fetch_object($result);
       $id = $data->loc_id;
       $name = $data->loc_name;
       $price = $data->loc_price;
    }
    
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="location_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการสถานที่ถ่ายภาพ</legend>
            <form action="location_save.php" method="post" enctype="multipart/form-data">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">ชื่อสถานที่</td>
                            <td>
                                <input type="hidden" name="id" value="<?=$id?>"/>
                                <input type="text" name="name" value="<?=$name?>" required/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>ราคา</td>
                            <td><input type="number" name="price" value="<?=$price?>" required/><span class="require">*</span></td>
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