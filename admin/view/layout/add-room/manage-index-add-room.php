<!-- main wrapper -->
<div class="main_wrapper d-flex flex-row">
    <!-- side navigate wrapper -->
    <div class="sidenav text-wrap p-0 m-0">

        <nav class="nav nav-pills flex-column text-center p-0 m-0">
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " aria-current="page" href="../app/index.php?">Dashboard</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=category">Danh mục khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=apartment-list">Danh sách
                khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=add-apartment">Thêm khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 active" href="../app/index.php?page=add-room">Thêm phòng khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=manage">Quản lý phòng đặt</a>
        </nav>
    </div>

    <!-- main content wrapper -->
    <div class="maincontent container-fluid">
        <?php
        $objList = $categoryObj->get_object_list();
        $apartmentList = $apartmentObj->get_all_apartment_not_desc();
        ?>
        <!-- to do -->
        <div class="mb-2">
            <h6>THÊM PHÒNG</h6>
            <?php
            if (empty($objList)) {
                echo "<h6>Không có danh mục khách sạn!</h6>";
            }
            ?>
        </div>
        <!-- Form -->
        <form class="row g-3" name="addapartmentform" method="post"
            action="../app/index.php?page=add-room&action=submit" <?php
            if (empty($objList)) {
                echo "hidden";
            }
            ?>>

            <!-- name -->
            <div class="formm__cus col-md-6 col-lg-4">

                <label for="location" class="form-label">Khách sạn</label>
                <select id="location" name="location" class="form-select" required>
                    <option selected value="unselected">Chọn khách sạn</option>
                    <?php
                    foreach ($apartmentList as $apartment) {
                    ?>
                        <option value="<?php echo $apartment['name'] ?>"><?php echo $apartment['name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <!-- doi tuong/customer -->
            <div class="d-flex">
                <div class="form__avatar col-md-3">
                <div class="mb-4 d-flex flex-column align-items-start">
                    <label class="form-label m-0 mb-2" for="avatar" style="width:200px;">Chọn hình ảnh (nhập link)</label>
                    <input type="url" name="image" class="form-control mb-1" style="width: 300px;" id="avatar" onchange="displayAvatarFromInputLink(this.value, 'selectedAvatar')" required />
                    <div>
                        <img class="selectedAvatarClass" id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="Choose avatar" style="width: 300px;" />
                    </div>
                </div>
            </div>
            <div class="form__code col-md-6 col-lg-4">
                <label for="price" class="form-label">Giá phòng</label>
                <input type="number" max="1000000000" name="price" class="form-control" id="price" required>
            </div>
                
                <!-- type -->
                <!-- php -->
                
                <!-- php -->
                
                
                <!-- doi tuong, size, mau sac, mo ta, gia san pham, so luong trong kho, 
                                        hinh dai dien, anh mo ta, huy bo, xac nhan -->
                
                
                <!-- color -->
                <!-- php -->
                <div class="form__color col-md-6 col-lg-4 ml-3 ms-3">
                    <label for="roomtype" class="form-label">Loại phòng</label>
                    <select id="roomtype" name="roomid" class="form-select">
                        <option value="1" unselected>Chọn phòng</option>
                        <option value="1">Phòng 2 người - 1 giường đôi</option>
                        <option value="2">Phòng 4 người - 2 giường đôi</option>
                        <option value="3">Phòng 2 người - 2 giường đơn</option>
                    </select>
                </div>
            </div>
            <!-- php -->

            <!-- gia -->
            

            <!-- avatar -->
            

            <!-- description -->
            <!-- submit -->
            <div class="form__submit col-12">
                <div class="d-flex justify-content-center">
                    <button type="submit" name="addSubmitBTN" value="TRUE" class="btn btn-primary px-3 py-2" <?php
                    if (empty($objList)) {
                        echo "disabled";
                    }
                    ?>>THÊM</button>
                </div>
            </div>

            <!-- cancel -->
            <div class="form__cancel col-12">
                <div class="d-flex justify-content-center">
                    <button type="reset" class="btn btn-danger"
                        onclick="resetDisplayAvatar('selectedAvatarClass')">RESET</button>
                </div>
            </div>
        </form>
    </div>

</div>