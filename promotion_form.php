<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<?php 
    $id = $name = $file = $startdate = $enddate = '';
    if(!empty($_GET['id'])){
       $sql = "SELECT `prom_id`, `prom_name`, `prom_file`, DATE_FORMAT(prom_startdate,'%d-%m-%Y') prom_startdate, DATE_FORMAT(prom_enddate,'%d-%m-%Y') prom_enddate, `prom_createdate` FROM promotion WHERE prom_id = ".$_GET['id']; 
       $result = mysqli_query($conn, $sql);
       $data = mysqli_fetch_object($result);
       //`prom_id`, `prom_name`, `prom_img`, `prom_createdate`
       $id = $data->prom_id;
       $name = $data->prom_name;
       $file = $data->prom_file;
       $startdate = $data->prom_startdate;
       $enddate = $data->prom_enddate;
    }
    
?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="promotion_manage.php"><img src="image/icon/32x32-previos-icon.png"/></a>ฟอร์มจัดการโปรโมชั่น</legend>
            <form action="promotion_save.php" method="post" enctype="multipart/form-data">
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
                            <td>วันเริ่ม</td>
                            <td><input type="text" class="date" name="startdate" value="<?= $startdate ?>" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>วันสิ้นสุด</td>
                            <td><input type="text" class="date" name="enddate" value="<?= $enddate ?>" required/><span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td>ภาพ</td>
                            <td>
                                <input type="file" name="image" value="<?=$file?>" <?= (empty($id) ? 'required' : '')?> accept="image/*" multiple/>
                                <span class="require">*</span>
                            <?php if(!empty($file)){?>
                                <img src="<?=$file?>"/>
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