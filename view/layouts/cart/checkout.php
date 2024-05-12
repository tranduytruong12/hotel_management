    <?php
    $user_id = 'null';
    if (isset($_SESSION['user-id'])) {
        $user_id = $_SESSION['user-id'];
    }
    if ($user_id !== 'null') {
        $user_model = new UserModel();
        $users = $user_model->__get($user_id);
        $user = $users->fetch_all(MYSQLI_ASSOC)[0];
        $username = ($user['username']);
        $fullname = ($user['name']);
        $email = ($user['email']) ?? "";
        $birthday = ($user['birthday']);
        $phone = ($user['phone_number']);
        // var_dump($fullname);
        // 
        $addressess = $user_model->__getAddress($user_id) ?? null;
        $address = $addressess->fetch_all(MYSQLI_ASSOC)[0] ?? null;
        $detail = $address['address_details'] ?? null;
        $province = $address['province'] ?? null;
        $district = $address['district'] ?? null;
    } else {
        $username =  "";
        $fullname =  "Họ tên";
        $email =  "";
        $birthday =  "";
        $phone =  "Số điện thoại";


        $detail =  "Địa chỉ nhận hàng";
        $province =  "Chọn tỉnh/ thành phố";
        $district = "Quận huyện";
    }

    ?>

    <div class="main-body container mb-5">
        <div class="row">
            <h1 class="text-center my-5">Thanh toán</h1>
        </div>
        <?php if ($total_price > 0) { ?>
            <div class="container row">
                <div class="col-md-7">
                    <h4 class="text-md-start text-sm-center">Sản phẩm</h3>

                        <div class="cart d-flex flex-column border-bottom">

                            <?php foreach ($cart_items as $cart_item) { ?>
                                <?php
                                if ($cart_item['cart_quantity'] == 0) {
                                    continue;
                                }
                                ?>
                                <div class="cart-item container mb-2">
                                    <div class="row mb-1">
                                        <img src="<?php echo $cart_item['product_img'] ?>" class="col-lg-2">
                                        <div class="cart-item-info col-md-8 col-sm-10">
                                            <h5 class="cart-item-title">
                                                <?php echo $cart_item['product_name'] ?>
                                            </h5>

                                            <div class="cart-item-attr d-flex">
                                                <p class="me-2">Màu sắc: <?php echo $cart_item['color_name'] ?></p>
                                                <p class="me-2">Kích thước: <?php echo $cart_item['size_name'] ?></p>
                                                <p class="me-2">Số lượng: <?php echo $cart_item['cart_quantity'] ?></p>
                                            </div>
                                        </div>
                                        <div class="cart-item-price col-2 py-1">
                                            <h5 class="text-end"><?php echo $cart_item['price'] ?>đ</h5>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                        <div class="row">
                            <h5 class="col-8">Giá trị đơn hàng</h5>
                            <h5 class="col-4 text-end"><?php echo $total_price ?> đ</h5>
                        </div>

                        <div class="row">
                            <h5 class="col-8">Phí vận chuyển</h5>
                            <h5 class="col-4 text-end">0 đ</h5>
                        </div>

                        <div class="row">
                            <h5 class="col-8">Tổng</h5>
                            <h5 class="col-4 text-end"><?php echo $total_price ?> đ</h5>
                        </div>
                </div>
                <div class="col-md d-flex flex-column justify-content-start">
                    <div class="d-flex flex-column justify-content-start">
                        <h4 class="text-md-start text-sm-center">Thông tin giao hàng</h3>
                            <div class="form-floating">
                                <input required type="text" id="full-name" value="<?php echo $fullname ?>" class="form-control mb-2" placeholder="Họ và tên">
                                <label for="full-name">Họ và tên<label>
                            </div>
                            <div id="user-info__select-location">
                                <div class="form-floating">
                                    <select name="provinceOption" class="form-control form-select mb-2" id="user-info__select-province" onchange="document.getElementById('text_province').value = this.options[this.selectedIndex].text">
                                        <option selected><?= $province ?></option>
                                        <option disabled>Chọn tỉnh/thành phố</option>
                                    </select>
                                    <label for="user-info__select-province">tỉnh/thành phố</label>
                                </div>
                                <div class="form-floating">
                                    <select name="districtOption" class="form-control form-select mb-2" id="user-info__select-district" onchange="document.getElementById('text_district').value = this.options[this.selectedIndex].text">
                                        <option selected><?= $district ?></option>
                                        <option disabled>Chọn Quận/huyện</option>
                                    </select>
                                    <label for="user-info__select-district">Quận/huyện</label>
                                </div>
                                <div class="form-floating">
                                    <input required type="text" class="form-control mb-2" id="address" placeholder="Số nhà, đường,..." value="<?= $detail ?>">
                                    <label for="address">Địa chỉ nhận hàng</label>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input required type="text" id="phone-number" value="<?php echo $phone ?>" class="form-control mb-2" placeholder="Số điện thoại">
                                <label for="phone-number">Số điện thoại</label>
                            </div>

                            <input type="hidden" id="text_province" name="text_province" value="<?= $province ?>">
                            <input type="hidden" id="text_district" name="text_district" value="<?= $district ?>">
                            <input type="hidden" name='id'>
                    </div>
                    <div>
                        <h4 class="text-start mt-2">Thanh toán qua</h1>
                            <div class="container">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment-method" value=3 id="momo-payment">
                                    <label class="form-check-label d-flex justify-content-between" for="momo-payment">
                                        <p class="">Thanh toán bằng Momo</p>
                                        <img src="../view/assets/img/momo.jpg" class="payment-method__icon">
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment-method" value=2 id="zalopay-payment">
                                    <label class="form-check-label d-flex justify-content-between" for="zalo-payment">
                                        <p class="">Thanh toán bằng Zalopay</p>
                                        <img src="../view/assets/img/zalopay.png" class="payment-method__icon">
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" checked type="radio" name="payment-method" value=1 id="cash-payment">
                                    <label class="form-check-label d-flex justify-content-between" for="zalo-payment">
                                        <p class="">Thanh toán khi nhận hàng</p>
                                        <img src="../view/assets/img/cash.png" class="payment-method__icon">
                                    </label>
                                </div>
                            </div>
                    </div>
                    <button type="button" id="checkout-complete" onclick="checkout_complete(<?php echo $user_id ?>)" class="btn btn-primary col-4 align-self-center">Đặt hàng</button>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <h2 class="text-center my-5">Giỏ hàng trống.</h2>
            </div>
        <?php } ?>
    </div>

    <div class="modal" id="checkout-success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đặt mua thành công!</h5>
                </div>
                <div class="modal-body">
                    <p>Cảm ơn bạn vì đã chọn FiveChicken.</p>
                </div>
                <div class="modal-footer">
                    <!-- Note to back home page -->
                    <a href="." type="button" class="btn btn-primary mx-auto">Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal" id="checkout-failed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Có lỗi xảy ra.</h5>
                </div>
                <div class="modal-body">
                    <p>Vui lòng thử lại sau.</p>
                </div>
                <div class="modal-footer">
                    <a href="." type="button" class="btn btn-primary mx-auto">Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="../view/assets/js/fetch_geo_data.js"></script>
    <script src="../view/assets/js/main.js"></script>