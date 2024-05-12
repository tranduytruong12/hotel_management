<!-- main wrapper -->
<div class="main_wrapper d-flex flex-row">
    <!-- side navigate wrapper -->
    <div class="sidenav text-wrap p-0 m-0">
        <nav class="nav nav-pills flex-column text-center p-0 m-0">
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " aria-current="page" href="../app/index.php?">Dashboard</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=category">Danh mục khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 active" href="../app/index.php?page=apartment-list">Danh sách
                khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=add-apartment">Thêm khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=add-room">Thêm phòng khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=manage">Quản lý phòng đặt</a>
        </nav>
    </div>

    <!-- php variable $apartmentInfo: id, name, price, description, category_id -->

    <!-- main content wrapper -->
    <div class="maincontent container-fluid">
        <!-- to do -->
        <div class="mb-2">
            <div class="backbutton">
                <a href="index.php?page=apartment-list" type="button" class="update_info_apartment btn btn-sm btn-primary me-0 m-1">
                    TRỞ VỀ DANH SÁCH
                </a>
            </div>
            <h5 class="m-0"><?php if ($apartmentInfo == false) {
                                echo 'KHÔNG TÌM THẤY ';
                            } ?>THÔNG TIN KHÁCH SẠN</h5>
        </div>

        <div class="view row g-3" <?php if ($apartmentInfo == false) {
                                        echo 'hidden';
                                    } ?>>
            <!-- ten san pham, ma san pham, loai san pham, ngay ra mat, 
                        doi tuong, size, mau sac mo ta, gia san pham, so luong trong kho, 
                        hinh dai dien, anh mo ta, huy bo, xac nhan -->


            <!-- php variable $apartment_id -->
            <!-- php variable $apartmentInfo: id, name, price, description, category_id -->
            <!-- $inventoryObj, $categoryObj, $apartmentObj -->
            <br>
            <div class="mx-3 my-1">
                                <figure class="" style="width:300px">
                                    <img src="<?= $inventoryObj->get_image_by_id($apartmentInfo['id']) ?>" alt="Hình ảnh phòng mã <?= $room_name ?>" style="width:300px">

                </figure>
            </div>
            <div class="view__name col-12">
                <div>
                    Tên khách sạn
                </div>
                <div class="vaule border rounded-2 p-2">
                    <?php echo $apartmentInfo['name'] ?>
                </div>
            </div>

            <div class="view__name col-6">
                <div>
                    Địa chỉ
                </div>
                <div class="vaule border rounded-2 p-2">
                    <?php if ($apartmentInfo['address'])
                        echo $apartmentInfo['address'];
                    else
                        echo "Unknown"; ?>
                </div>
            </div>
            <div class="view__name col-6">
                <div>
                    Tình trạng
                </div>
                <div class="vaule border rounded-2 p-2">
                    <?php if ($apartmentInfo['status'] != 0)
                        echo 'Còn phòng';
                    else
                        echo 'Hết phòng'; ?>
                </div>
            </div>
            <?php
            $category = $categoryObj->get_category_by_id($apartmentInfo['category_id']);
            $location_name = $categoryObj->get_location_with_id($category['location_id']);
            $rating = $apartmentObj->get_rate_by_id($apartmentInfo['id']);
            ?>

            <div class="view__cus col-md-6 col-lg-4">
                <div>
                    Địa điểm
                </div>
                <div class="vaule border rounded-2 p-2">
                    <?php echo $location_name ?>
                </div>
            </div>

            <div class="view__type col-md-6 col-lg-4">
                <div>
                    Loại khách sạn
                </div>
                <div class="value border rounded-2 p-2">
                    <?php echo $category['catagory_name'] ?>
                </div>
            </div>
            <div class="view__type col-md-6 col-lg-4">
                <div>
                    Đánh giá
                </div>
                <div class="value border rounded-2 p-2">
                    <?php echo $rating ?>
                </div>
            </div>
            <?php
            $appartment_room_img_list = $inventoryObj->get_room_by_appartment_id($apartment_id);
            ?>
            <div class="view_image col-12">
                <div>
                    Các loại phòng khách sạn
                </div>

                <div class="Image border rounded-2 p-1 d-flex flex-wrap">

                    <?php
                    if (!empty($appartment_room_img_list)) {
                        $i = 0;
                        foreach ($appartment_room_img_list as $room_type_img) {
                            $img = $room_type_img['image'];
                            $price = $room_type_img['price'];
                            $room_type = $room_type_img['room_id'];
                            $room_name = $inventoryObj->get_name_by_room_id($room_type);
                            $i++;

                    ?>
                            <div class="mx-3 my-1">
                                <figure class="" style="width:200px">
                                    <img src="<?= $img ?>" alt="Hình ảnh phòng mã <?= $room_name ?>" style="width:200px">
                                    <figcaption class="text-center"><?= $room_name ?> - <?= $price ?> VNĐ</figcaption>
                                </figure>
                            </div>

                    <?php
                        }
                    }else{
                        echo "<p>Không có phòng</p>";
                    }
                    ?>
                </div>

            </div>

            <div class="view__desription">
                <div>
                    Mô tả khách sạn
                </div>
                <div class="value border rounded-2 p-2" style="min-height: 10em;">
                    <?php echo $apartmentInfo['description'] ?>
                </div>
            </div>
        </div>
    </div>
</div>