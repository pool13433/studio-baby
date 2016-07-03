<?php include './inc_header.php'; // นำเข้าไฟล์ header.php เพื่อทำเป็นหัวเว็บ?>
<?php include './db/connect_db.php'; // นำเข้าไฟล์ ติดต่อฐานข้อมูล?>
<?php 
    $id = $name = $code = '';
    if(!empty($_GET['id'])){
       $sql = "SELECT * FROM bank WHERE bank_id = ".$_GET['id']; 
       $result = mysqli_query($conn, $sql);
       $data = mysqli_fetch_object($result);
       $id = $data->bank_id;
       $name = $data->bank_name;
       $code = $data->bank_code;
    }    
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="bank_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการธนาคาร</legend>
            <form action="bank_save.php" method="post">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">ชื่อ</td>
                            <td>
                                <input type="hidden" name="id" value="<?=$id?>"/>
                                <input type="text" name="name" value="<?=$name?>" required/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>คำย่อ</td>
                            <td>
							<input type="text" name="code" value="<?=$code?>" required/>
							<span class="require">*</span></td>
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