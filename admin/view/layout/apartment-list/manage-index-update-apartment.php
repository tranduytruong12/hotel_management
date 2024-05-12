<?php
include __DIR__ . "/inc/head.php";
?>

<!-- main wrapper -->
<div class="main_wrapper d-flex flex-row">
    <!-- side navigate wrapper -->
    <div class="sidenav text-wrap p-0 m-0">
        <nav class="nav nav-pills flex-column text-center p-0 m-0">
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?">Dashboard</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=category">Danh mục sản
                phẩm</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 active" aria-current="page" href="#">Danh sách
                sản phẩm</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=add-apartment">Thêm sản phẩm</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=inventory">Nhà kho</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=manage">Quản lý đơn hàng</a>
        </nav>
    </div>

    <!-- main content wrapper -->
    <div class="maincontent container container-fluid">
        <!-- to do -->
        <div class="mb-2">
            CẬP NHẬT THÔNG TIN SẢN PHẨM
        </div>
        <form class="row g-3">
            <!-- ten san pham, ma san pham, loai san pham, ngay ra mat, 
                        doi tuong, size, mau sac mo ta, gia san pham, so luong trong kho, 
                        hinh dai dien, anh mo ta, huy bo, xac nhan -->

            <!-- name -->
            <div class="update_form__name col-12">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" value="Giày Thể Thao Nam Biti's Hunter Street">
            </div>

            <!-- code -->
            <div class="update_form__code col-lg-4">
                <label for="code" class="form-label">Mã sản phẩm</label>
                <input type="text" class="form-control" id="code" value="HSM004700">
            </div>

            <!-- doi tuong/customer -->
            <div class="undate_formm__cus col-md-6 col-lg-4">
                <label for="customertype" class="form-label">Đối tượng</label>
                <select id="customertype" class="form-select">
                    <option selected>Nam</option>
                    <option>Nữ</option>
                    <option>Bé trai</option>
                    <option>Bé gái</option>
                </select>
            </div>

            <!-- type -->
            <div class="update_form__type col-md-6 col-lg-4">
                <label for="producttype" class="form-label">Loại sản phẩm</label>
                <select id="producttype" class="form-select">
                    <option>Hunter</option>
                    <option>Sandal</option>
                    <option selected>Giày thể thao</option>
                    <option>Giày chạy bộ</option>
                    <option>Giày đá banh</option>
                    <option>Giày tây</option>
                    <option>Dép</option>
                </select>
            </div>

            <!-- doi tuong, size, mau sac, mo ta, gia san pham, so luong trong kho, 
                        hinh dai dien, anh mo ta, huy bo, xac nhan -->

            <!-- color -->
            <div class="update_form__color col-md-4">
                <label for="productcolor" class="form-label">Màu sản phẩm</label>
                <select id="productcolor" class="form-select">
                    <option>Trắng</option>
                    <option>Đen</option>
                    <option>Xanh dương</option>
                    <option>Xanh lục</option>
                    <option selected>Nâu</option>
                    <option>Vàng</option>
                    <option>Đỏ</option>
                </select>
            </div>

            <!-- avatar -->
            <div class="update_form__avatar mb-3 col-12">
                <div class="mb-4 d-flex flex-column align-items-start">
                    <div class="btn btn-secondary btn-rounded py-0 px-1 mt-1 mb-2">
                        <label class="form-label m-0" for="avatar">Chọn hình ảnh</label>
                        <input type="file" class="form-control d-none" id="avatar" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                    </div>
                    <div>
                        <img id="selectedAvatar" src="/assets/img/shoe/shoename4/avatar.png" alt="example placeholder" style="width: 150px;" />
                    </div>
                </div>
            </div>

            <!-- size -->
            <div class="update_form__size col-12">
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#size" aria-expanded="false" aria-controls="collapse-size">
                    <span>Các kích thước của sản phẩm:</span>
                    <span class="update_form__numofsize">6 kích thước</span>
                </button>
                <div class="collapse" id="size">
                    <div class="border border-1 rounded-2 px-1 py-2">
                        <div class="d-flex flex-row flex-wrap">
                            <div class="update_form__size24 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size24" id="size24">
                                <label class="form-check-label" for="size24">
                                    size24
                                </label>
                            </div>
                            <div class="update_form__size25 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size25" id="size25">
                                <label class="form-check-label" for="size25">
                                    size25
                                </label>
                            </div>
                            <div class="update_form__size26 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size26" id="size26">
                                <label class="form-check-label" for="size26">
                                    size26
                                </label>
                            </div>
                            <div class="update_form__size27 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size27" id="size27">
                                <label class="form-check-label" for="size27">
                                    size27
                                </label>
                            </div>
                            <div class="update_form__size28 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size28" id="size28">
                                <label class="form-check-label" for="size28">
                                    size28
                                </label>
                            </div>
                            <div class="update_form__size29 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size29" id="size29">
                                <label class="form-check-label" for="size29">
                                    size29
                                </label>
                            </div>
                            <div class="update_form__size30 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size30" id="size30">
                                <label class="form-check-label" for="size30">
                                    size30
                                </label>
                            </div>
                            <div class="update_form__size31 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size31" id="size31">
                                <label class="form-check-label" for="size31">
                                    size31
                                </label>
                            </div>
                            <div class="update_form__size32 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size32" id="size32">
                                <label class="form-check-label" for="size32">
                                    size32
                                </label>
                            </div>
                            <div class="update_form__size33 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size33" id="size33">
                                <label class="form-check-label" for="size33">
                                    size33
                                </label>
                            </div>
                            <div class="update_form__size34 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size34" id="size34">
                                <label class="form-check-label" for="size34">
                                    size34
                                </label>
                            </div>
                            <div class="update_form__size35 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size35" id="size35">
                                <label class="form-check-label" for="size35">
                                    size35
                                </label>
                            </div>
                            <div class="update_form__size36 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size36" id="size36">
                                <label class="form-check-label" for="size36">
                                    size36
                                </label>
                            </div>
                            <div class="update_form__size37 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size37" id="size37">
                                <label class="form-check-label" for="size37">
                                    size37
                                </label>
                            </div>
                            <div class="update_form__size38 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size38" id="size38">
                                <label class="form-check-label" for="size38">
                                    size38
                                </label>
                            </div>
                            <div class="update_form__size39 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size39" id="size39" checked>
                                <label class="form-check-label" for="size39">
                                    size39
                                </label>
                            </div>
                            <div class="update_form__size40 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size40" id="siz40" checked>
                                <label class="form-check-label" for="size40">
                                    size40
                                </label>
                            </div>
                            <div class="update_form__size41 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size41" id="size41" checked>
                                <label class="form-check-label" for="size41">
                                    size41
                                </label>
                            </div>
                            <div class="update_form__size42 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size42" id="size42" checked>
                                <label class="form-check-label" for="size42">
                                    size42
                                </label>
                            </div>
                            <div class="update_form__size43 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size43" id="size43" checked>
                                <label class="form-check-label" for="size43">
                                    size43
                                </label>
                            </div>
                            <div class="update_form__size44 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size44" id="size44" checked>
                                <label class="form-check-label" for="size44">
                                    size44
                                </label>
                            </div>
                            <div class="update_form__size45 form-check-inline m-3">
                                <input class="form-check-input" type="checkbox" value="size45" id="size45" checked>
                                <label class="form-check-label" for="size45">
                                    size45
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- description -->
            <div class="update_form__description col-12">
                <label for="description" class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" id="description" rows="5">Sản phẩm chưa có mô tả.</textarea>
            </div>

            <!-- submit -->
            <div class="update_form__submit col-12">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-3 py-2" onclick="confirm('Xác nhận cập nhật thông tin sản phẩm')">CẬP NHẬT</button>
                </div>
            </div>

            <!-- cancel -->
            <div class="update_form__cancel col-12">
                <div class="d-flex justify-content-center">
                    <button type="cancel" class="btn btn-danger" onclick="confirm('Xác nhận huỷ thao tác')">HUỶ</button>
                </div>
            </div>
        </form>
    </div>

</div>

<?php
include __DIR__ . "/inc/foot.php";
?>