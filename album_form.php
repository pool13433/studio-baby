<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php 
    $id = $name_th = $name_eng = '';
    if(!empty($_GET['id'])){
       $sql = "SELECT * FROM album WHERE album_id = ".$_GET['id']; 
       $result = mysqli_query($conn, $sql);
       $data = mysqli_fetch_object($result);
       $id = $data->album_id;
       $name_th = $data->album_nameth;
       $name_eng = $data->album_nameeng;
    }
    
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="album_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการอัลบัม</legend>
            <form action="album_save.php" method="post" enctype="multipart/form-data">
                <table border="1">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">ชื่อไทย</td>
                            <td>
                                <input type="hidden" name="id" value="<?=$id?>"/>
                                <input type="text" name="name_thai" value="<?=$name_th?>" required/>
                                <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>ชื่ออังกฤษ</td>
                            <td><input type="text" name="name_eng" value="<?=$name_eng?>" required/><span class="require">*</span></td>
                        </tr>            
                         <tr>
                            <td>เลือกรูปแสดง</td>
                            <td>
                                <input type="file" name="image[]" multiple value="<?=$name_eng?>"
                                <?= (empty($id) ? 'required' : '')?> accept="image/*"/>
                                <span class="require">*</span>
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