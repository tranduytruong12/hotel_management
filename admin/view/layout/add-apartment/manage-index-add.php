<!-- main wrapper -->
<div class="main_wrapper d-flex flex-row">
    <!-- side navigate wrapper -->
    <div class="sidenav text-wrap p-0 m-0">

        <nav class="nav nav-pills flex-column text-center p-0 m-0">
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " aria-current="page" href="../app/index.php?">Dashboard</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=category">Danh mục khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=apartment-list">Danh sách
                khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 active" href="../app/index.php?page=add-apartment">Thêm khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=add-room">Thêm phòng khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=manage">Quản lý phòng đặt</a>
        </nav>
    </div>

    <!-- main content wrapper -->
    <div class="maincontent container-fluid">
        <?php
        $objList = $categoryObj->get_object_list();
        ?>
        <!-- to do -->
        <div class="mb-2">
            <h6>THÊM KHÁCH SẠN</h6>
            <?php
            if (empty($objList)) {
                echo "<h6>Không có danh mục sản phẩm! Hãy thêm danh mục sản phẩm trước.</h6>";
            }
            ?>
        </div>
        <!-- Form -->
        <form class="row g-3" name="addapartmentform" method="post" action="../app/index.php?page=add-apartment&action=submit" <?php
                                                                                                                            if (empty($objList)) {
                                                                                                                                echo "hidden";
                                                                                                                            }
                                                                                                                            ?>>

            <!-- name -->
            <div class="form__name col-12">
                <label for="name" class="form-label">Tên khách sạn</label>
                <input type="text" name="apartmentname" class="form-control" id="name" required>
            </div>

            <div class="form__name col-12">
                <label for="addr" class="form-label">Địa chỉ</label>
                <input type="text" name="apartmentaddr" class="form-control" id="name" required>
            </div>                                                                                     
            <!-- doi tuong/customer -->
            <div class="formm__cus col-md-6 col-lg-4">

                <label for="location" class="form-label">Địa điểm</label>
                <select id="location" name="location" class="form-select" required>
                    <option selected value="unselected">Chọn địa điểm</option>
                    <?php
                    foreach ($objList as $obj) {
                    ?>
                        <option value="<?php echo $obj['location_id'] ?>"><?php echo $categoryObj->get_location_with_id($obj['location_id']); ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

              
            <div class="form__type col-md-6 col-lg-4">
                <label for="categoryname" class="form-label">Loại khách sạn </label>
                <select id="categoryname" name="categoryname" class="form-select" required>
                            <option  unselected>Chọn loại khách sạn</option>
                            <option value="Deluxe" >Deluxe</option>
                            <option value="Luxury">Luxury</option>
                            <option value="Premium">Premium</option>
                </select>
            </div>



            <!-- avatar -->
            <div class="form__avatar col-lg-4">
                <div class="mb-4 d-flex flex-column align-items-start">
                    <label class="form-label m-0 mb-2" for="avatar" style="width: 200px;">Chọn hình ảnh (nhập link)</label>
                    <input type="text" name="apartmentimage" class="form-control mb-1" style="width: 350px;" id="avatar" onchange="displayAvatarFromInputLink(this.value, 'selectedAvatar')" required />
                    <div>
                        <img class="selectedAvatarClass" id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="Choose avatar" style="width: 220px;" />
                    </div>
                </div>
            </div>

            <!-- description -->
            <div class="col-12">
                <label for="description" class="form-label">Mô tả sản phẩm</label>
                <textarea name="apartmentdesc" class="form-control" id="description" rows="5" required></textarea>
            </div>

            <!-- submit -->
            <div class="form__submit col-12">
                <div class="d-flex justify-content-center">
                    <button type="submit" name="addSubmitBTN" value="TRUE" class="btn btn-primary px-3 py-2" <?php
                                                                                                                if (empty($objList)){
                                                                                                                    echo "disabled";
                                                                                                                }
                                                                                                                ?>>THÊM</button>
                </div>
            </div>

            <!-- cancel -->
            <div class="form__cancel col-12">
                <div class="d-flex justify-content-center">
                    <button type="reset" class="btn btn-danger" onclick="resetDisplayAvatar('selectedAvatarClass')">RESET</button>
                </div>
            </div>
        </form>
    </div>

</div>