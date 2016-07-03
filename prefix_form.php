<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php 
    $id = $name = $description = '';
    if(!empty($_GET['id'])){
       $sql = "SELECT * FROM prefix WHERE pref_id = ".$_GET['id']; 
       $result = mysqli_query($conn, $sql);
       $data = mysqli_fetch_object($result);
       $id = $data->pref_id;
       $name = $data->pref_name;
       $description = $data->pref_desc;
    }
    
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="prefix_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการคำนำหน้าชื่อ</legend>
            <form action="prefix_save.php" method="post">
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
                            <td>อธิบาย</td>
                            <td><textarea rows="5" cols="60" name="desciption"><?=$description?></textarea><span class="require">*</span></td>
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