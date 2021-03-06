<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php 
    $id = $name = $image = '';
    if(!empty($_GET['id'])){
       $sql = "SELECT * FROM package WHERE pac_id = ".$_GET['id']; 
       $result = mysqli_query($conn, $sql);
       $data = mysqli_fetch_object($result);
       //`pac_id`, `pac_name`, `pac_img`, `pac_createdate`
       $id = $data->pac_id;
       $name = $data->pac_name;
       $image = $data->pac_image;
    }
    
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="package_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการแพ๊กเก็ต</legend>
            <form action="package_save.php" method="post" enctype="multipart/form-data">
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
                            <td>ภาพ</td>
                            <td>
                                <input type="file" name="image" value="<?=$image?>" <?= (empty($id) ? 'required' : '')?> accept="image/*"/>
                                <span class="require">*</span>
                            <?php if(!empty($image)){?>
                                <img src="<?=$image?>"/>
                            <?php }?>   
                            </td>
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