<?php
if (isset($_SESSION["user-id"])) {
    $user_id = $_SESSION["user-id"];
} else {
    $user_id = null;
}
//
//echo $user_id;
//
$user_model = new UserModel();
$users = $user_model->__get($user_id);
$user = $users->fetch_all(MYSQLI_ASSOC)[0];
$username = $user["userName"];
$fullname = $user["name"];
$email = $user["email"];
$birthday = $user["birthday"];
$phone = $user["phoneNumber"];
// $addressess = $user_model->__getAddress($user_id) ?? null;
// $address = $addressess->fetch_all(MYSQLI_ASSOC)[0] ?? null;
// $detail = $address["address_details"] ?? null;
// // var_dump($addressess);
// $addressess_ = $user_model->__getAllAddress($user_id) ?? null;
// $address_ = $addressess_->fetch_all(MYSQLI_ASSOC) ?? null;
// $detail_ = $address["address_details"] ?? null;
?>
<div class="container mt-3 w-75">
    <div class="account__information">
        <div class="account__information-title d-flex justify-content-center">
            <h2>DANH SÁCH ĐỊA CHỈ</h2>
        </div>
        <div class="account__information-detail d-flex justify-content-between align-items-start mt-2">
            <div class="user d-flex flex-column justify-content-center p-5 w-25">
                <div class="user__avatar d-flex align-items-center flex-column">
                    <img src="../view/assets/img/avatar/avatar9.jpg" />
                    <h3>Xin chào</h3>
                    <?php if (isset($user['username'])): ?>
                        <p><?=$user['username']?></p>
                    <?php else: ?>
                        <p></p>
                    <?php endif?>
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
            <div class="user__infor flex-fill bd-highligh p-3 d-flex flex-column justify-content-center align-items-center w-75">
                <div class="user__infor-detail d-flex justify-content-center align-items-start">
                    <div class="left w-50">
                        <div class="user__infor-map w-100">
                            <div class="user__infor-title d-flex justify-content-between m-1 p-2" id="map-bg">
                                <?php if (isset($address['fullname'])): ?>
                                    <span><?=$address['fullname']?> (Địa chỉ mặc định)</span>
                                <?php else: ?>
                                    <p class='text-danger'>Bạn cần cập nhật họ và tên</p>
                                <?php endif;?>

                                <a href="?account&&action=delete&&id=<?=$address['id']?>">
                                    <i class="bi bi-x text-danger"></i>
                                    <input type="hidden" value="<?=$address['id']?>">
                                </a>
                            </div>
                            <div class="user__infor-detail m-1 p-2">
                                <div class="title">
                                    <p>Họ và tên:</p>
                                    <?php if (isset($address['fullname'])): ?>
                                        <span><?=$address['fullname']?></span>
                                    <?php else: ?>
                                        <p class='text-danger'>Bạn cần cập nhật họ và tên</p>
                                    <?php endif;?>

                                </div>
                                <!-- <div class="title">
                                    <p>Email:</p>
                                    <?php if ($email): ?>
                                        <span><?=$email?></span>
                                    <?php else: ?>
                                        <p class='text-danger'>Bạn cần cập nhật họ và tên</p>
                                    <?php endif;?>

                                </div> -->
                                <div class="title">
                                    <p>Địa chỉ:</p>
                                    <?php if (isset($address['address_details'])): ?>
                                        <span><?=$address['address_details']?></span>
                                    <?php else: ?>
                                        <p class='text-danger'>Bạn cần cập nhật địa chỉ</p>
                                    <?php endif;?>

                                </div>
                                <!-- <div class="title">
                                    <p>Ngày sinh:</p>
                                    <?php if ($birthday): ?>
                                        <span><?=$birthday?></span>
                                    <?php else: ?>
                                        <p class='text-danger'>Bạn cần cập nhật ngày tháng năm sinh</p>
                                    <?php endif;?>

                                </div> -->
                                <div class="title">
                                    <p>Điện thoại</p>
                                    <?php if (isset($address['phone_number'])): ?>
                                        <span><?=$address['phone_number']?></span>
                                    <?php else: ?>
                                        <p class='text-danger'>Bạn cần cập nhật số điện thoại</p>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($address_ as $add): ?>
                            <div class="user__infor-map w-100">
                                <div class="user__infor-title d-flex justify-content-between m-1 p-2" id="map-bg">
                                    <?php if ($fullname): ?>
                                        <span><?=$add['fullname']?></span>
                                    <?php else: ?>
                                        <p class='text-danger'>Bạn cần cập nhật họ và tên</p>
                                    <?php endif;?>

                                    <div class="d-flex flex-row gap-1">
                                        <a href="?account&&action=modify&&id=<?=$add['id']?>" class="d-flex">
                                            <i class="bi bi-pencil-square"></i>
                                            <input type="hidden" value="<?=$add['id']?>">
                                        </a>
                                        <a href="?account&&action=delete&&id=<?=$add['id']?>" class="d-flex">
                                            <i class="bi bi-x text-danger"></i>
                                            <input type="hidden" value="<?=$add['id']?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="user__infor-detail m-1 p-2">
                                    <div class="title">
                                        <p>Họ và tên:</p>
                                        <?php if ($fullname): ?>
                                            <span><?=$add['fullname']?></span>
                                        <?php else: ?>
                                            <p class='text-danger'>Bạn cần cập nhật họ và tên</p>
                                        <?php endif;?>

                                    </div>

                                    <div class="title">
                                        <p>Địa chỉ:</p>
                                        <?php if ($detail): ?>
                                            <span><?=$add['address_details']?></span>
                                        <?php else: ?>
                                            <p class='text-danger'>Bạn cần cập nhật địa chỉ</p>
                                        <?php endif;?>

                                    </div>

                                    <div class="title">
                                        <p>Điện thoại</p>
                                        <?php if ($phone): ?>
                                            <span><?=$add['phone_number']?></span>
                                        <?php else: ?>
                                            <p class='text-danger'>Bạn cần cập nhật số điện thoại</p>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach?>
                    </div>
                    <div class="user__infor-btn w-50 m-1 d-flex flex-column justify-content-center">
                        <button type="button" class="btn btn-dark w-100" onclick="displayForm()">NHẬP ĐỊA CHỈ MỚI</button>
                        <form class="user__infor-form p-2" id="user__infor-form" method="post">
                            <div class="form-group mb-2">
                                <label for="">Họ và tên</label>
                                <input name="fullname" type="text" class="form-control w-100 mt-1" id="exampleInputEmail1" placeholder="Nhập vào họ">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Số điện thoại</label>
                                <input name="phone" type="text" class="form-control w-100 mt-1" id="exampleInputPassword1" placeholder="Nhập vào số điện thoại">
                            </div>
                            <div class="form-group mb-2">
                                <label for="user-info__select-province">Tỉnh/Thành phố</label>
                                <select name="provinceOption" class="form-control form-select mb-2" id="user-info__select-province" onchange="document.getElementById('text_province').value = this.options[this.selectedIndex].text">

                                    <option selected disabled>Chọn tỉnh/thành phố</option>
                                </select>

                            </div>
                            <div class="form-group mb-2">
                                <label for="user-info__select-district">Quận/huyện</label>
                                <select name="districtOption" class="form-control form-select mb-2" id="user-info__select-district" onchange="document.getElementById('text_district').value = this.options[this.selectedIndex].text">

                                    <option selected disabled>Chọn Quận/huyện</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Địa chỉ</label>
                                <input name="detail" type="text" class="form-control w-100 mt-1" id="exampleInputPassword1" placeholder="Nhập vào địa chỉ">
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="address-default">
                                <label class="form-check-label" for="exampleCheck1">Đặt làm địa chỉ mặc định</label>
                            </div>
                            <input type="hidden" id="text_province" name="text_province" value="<?=$province?>">
                            <input type="hidden" id="text_district" name="text_district" value="<?=$district?>">
                            <div class="d-flex justify-content-center m-2">
                                <button type="submit" class="btn btn-dark w-75" name="update-add">Xác nhận</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['success-update'])) {
    echo '<script type="text/javascript">toastr.success("Bạn đã thêm mới địa chỉ thành công")</script>';
    unset($_SESSION['success-update']);
}
?>
<?php
if (isset($_SESSION['success-delete'])) {
    echo '<script type="text/javascript">toastr.success("Bạn đã xóa địa chỉ thành công")</script>';
    unset($_SESSION['success-delete']);
}
?>