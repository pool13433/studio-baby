<?php include './inc_header.php'; ?>
<?php include './db/connect_db.php';?>
<tr>
    <td style="width:20%;vertical-align: text-top"><?php include './inc_menuleft.php'; ?></td>
    <td style="vertical-align: text-top">
        <fieldset>
            <legend><a href="cart.php"><img src="image/icon/32x32-previos-icon.png"/></a>แสดงสินค้าในตะกร้า</legend>
            <form action="cart_save.php" method="post">
                <table border="1">
                    <tbody>
                        <tr>
                            <td>ราคารวม</td>
                            <td><input type="text"  name="total_price" required value="<?= $_GET['total_price'] ?>"/></td>
                        </tr>
                        <tr>
                            <td>จำนวนเงินมัดจำ</td>
                            <td>
                                <input type="number"  name="total_deposit" required/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">เลือกวันที่ เวลาที่ใช้งานถ่ายภาพ</td>
                            <td>
                                <label>
                                    วันที่ใช้งาน <input type="text" class="date" name="use_date" required/>
                                </label>    
                                <label>   ช่วงเวลาที่ใช้งาน <input type="times" class="time" name="use_time1" required/></label>
                                <label> ถึง <input type="times" class="time" name="use_time2" required/></label>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนผู้ถ่ายภาพ</td>
                            <td>
                                <label>
                                    ชาย <input type="number"  name="use_male" required value="0"/>
                                    หญิง<input type="number" name="use_fermale" required value="0"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>สถานที่ถ่ายทำ</td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM location ORDER BY loc_name ASC";
                                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql ::==' . $sql);
                                ?>
                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                    <label><input type="checkbox" name="location[]" value="<?= $row['loc_id'] ?>"/>[<?= $row['loc_name'].'  '.$row['loc_price']?>]</label>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit" class="button-green" onclick="return confirm('ยืนยันการสั่งจอง')">ยืนยันการจอง</button>
                                <button type="reset" class="button-orange">ล้างฟอร์ม</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </fieldset>
    </td>
</tr>
<?php include './inc_footer.php'; ?>