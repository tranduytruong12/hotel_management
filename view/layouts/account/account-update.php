<?php
if (isset($_SESSION["user-id"])) {
    $user_id = $_SESSION['user-id'];
} else {
    $user_id = null;
}
// echo $user_id;
$user_model = new UserModel();
$users = $user_model->__get($user_id);
$user = $users->fetch_all(MYSQLI_ASSOC)[0];
$username = ($user['userName']);
$fullname = ($user['name']);
$email = ($user['email']);
$birthday = ($user['birthday']);
$phone = ($user['phoneNumber']);
// var_dump($fullname);
// 
// $addressess = $user_model->__getAddress($user_id) ?? null;

// $address = $addressess->fetch_all(MYSQLI_ASSOC)[0] ?? null;
// $detail = $address['address_details'] ?? null;
// $province = $address['province'] ?? null;
// $district = $address['district'] ?? null;

//var_dump($province);

?>
<div class="container mt-3 w-75">
    <div class="account__information">
        <div class="account__information-title d-flex justify-content-center">
            <h2>THÔNG TIN ĐỊA CHỈ</h2>
        </div>
        <div class="account__information-detail d-flex justify-content-between align-items-start mt-2">
            <div class="user d-flex flex-column justify-content-center p-5 w-25">
                <div class="user__avatar d-flex align-items-center flex-column justify-center text-center">
                    <img src="../view/assets/img/avatar/avatar9.jpg">
                    <h3>Xin chào</h3>
                    <?php if (isset($user['username'])) : ?>
                        <p></p><?= $user['username'] ?></p>
                    <?php else : ?>
                        <p></p>
                    <?php endif ?>
                </div>
                <div class="user__menu mt-3">
                    <li>
                        <i class="bi bi-person"></i>
                        <a href="?account">Thông tin tài khoản</a>
                    </li>
                    <li>
                        <i class="bi bi-menu-button-wide"></i>
                        <a href="?account&&action=manage">Quản lý đơn hàng</a>
                    </li>
                    <li>
                        <i class="bi bi-map"></i>
                        <a href="?account&&action=maps">Danh sách địa chỉ</a>
                    </li>
                    <li>
                        <i class="bi bi-bell"></i>
                        <a href="?account&&action=notifi">Danh sách thông báo</a>
                    </li>
                    <li>
                        <i class="bi bi-box-arrow-in-right"></i>
                        <a href="?controller=user&&action=logout">Đăng xuất</a>
                    </li>
                </div>
            </div>
            <div class="user__infor flex-fill bd-highligh p-5 d-flex flex-column justify-content-center align-items-center w-75">
                <div class="user__infor-detail">
                    <form action="#" id="update__form" method="post">
                        <div class="form-floating">
                            <input name="fullname" type="text" id="full-name" class="form-control mb-2  w-100" placeholder="Họ và tên" value="<?= $fullname ?>">
                            <label for="full-name">Họ và tên<label>
                        </div>
                        <div class="form-floating">
                            <input name="date" type="date" id="full-name" class="form-control mb-2  w-100" value="<?= $birthday ?>">
                            <label for="birthday">Ngày tháng năm sinh</label>
                        </div>



                        <!-- <div id="user-info__select-location">
                            <div class="form-floating">
                                <select name="provinceOption" class="form-control form-select mb-2" id="user-info__select-province" 
                                onchange="document.getElementById('text_province').value = this.options[this.selectedIndex].text">
                                    <option selected><?= $province ?></option>
                                    <option disabled>Chọn tỉnh/thành phố</option>

                                </select>
                                <label for="user-info__select-province">tỉnh/thành phố</label>
                            </div>
                            <div class="form-floating">
                                <select name="districtOption" class="form-control form-select mb-2" id="user-info__select-district"
                                onchange="document.getElementById('text_district').value = this.options[this.selectedIndex].text">
                                    <option selected><?= $district ?></option>
                                    <option disabled>Chọn Quận/huyện</option>
                                </select>
                                <label for="user-info__select-district">Quận/huyện</label>
                            </div>
                        </div> -->
                        <div class="form-floating">
                            <input name="phone" type="text" id="phone-number" class="form-control mb-2 w-100" placeholder="Số điện thoại" value="<?= $phone ?>">
                            <label for="phone-number">Số điện thoại</label>
                        </div>
                        <div class="user__infor-btn mt-3">

                            <button type="submit" class="btn btn-primary" name="update">CẬP NHẬP THÔNG TIN TÀI KHOẢN</button>

                        </div>
                        <input type="hidden" id="text_province" name="text_province" value="<?=$province?>">
                        <input type="hidden" id="text_district" name="text_district" value="<?=$district?>">
                        <input type="hidden" name='id'>
                    </form>
                        <?php 
                            
                        ?>
                </div>


            </div>
        </div>
    </div>
</div>