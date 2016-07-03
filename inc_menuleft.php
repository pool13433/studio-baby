<fieldset>
    <legend>เมนูการเข้าใช้งาน</legend>
    <ul>
        <?php if (!empty($_SESSION['person'])) { ?>    
            <?php if($_SESSION['person']->pers_status == 'ADMIN') { ?>
                <li><a href="package_manage.php">แพ็กเก็ต</a></li>
                <li><a href="package_set_manage.php">ชุดแพ็กเก็ต</a></li>
                <li><a href="photo_size_manage.php">ขนาดรูป</a></li>
                <li><a href="product_manage.php">สินค้า</a></li>
                <li><a href="album_manage.php">อัลบัม</a></li>
                <li><a href="bank_manage.php">ธนาคาร</a></li>
                <li><a href="location_manage.php">สถานที่</a></li>
                <li><a href="promotion_manage.php">โปรโมชั่น</a></li>
                <hr/>
                <li><a href="reserve_admin.php">ประวัติการสั่งจอง</a></li>
                <hr/>
                <li><a href="rpt_reserve.php">รายงานยอดจองการถ่ายภาพ</a></li>
                <li><a href="rpt_product.php">รายงานยอดสินค้า</a></li>
                <li><a href="rpt_package_set.php">รายงานยอดชุดแพ๊กเก็ต</a></li>
                <hr/>
                <li><a href="prefix_manage.php">คำนำหน้าชือ</a></li>
                <li><a href="person_manage.php">ผู้ใช้งาน</a></li>
                
            <?php } else { ?>
                <li><a href="product_package.php">แพ๊กเก็ต</a></li>
                <li><a href="product_unit.php">สินค้า</a></li>
                <li><a href="cart.php">ตะกร้า</a></li>
                <li><a href="reserve_user.php">ประวัติการสั่งจอง</a></li>
            <?php } ?>
                <li><a href="album.php">อัลบัม</a></li>
                <li><a href="promotion.php">โปรโมชั่น</a></li>
        <?php } ?>
    </ul>
</fieldset>