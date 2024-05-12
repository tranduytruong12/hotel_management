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
// $addressess = $user_model->__getAddress($user_id) ?? null;

// $address = $addressess->fetch_all(MYSQLI_ASSOC)[0] ?? null;
// $detail = $address['address_details'] ?? null;
// var_dump($addressess);

?>

<div class="container mt-3 w-75">
    <div class="account__information">
        <div class="account__information-title d-flex justify-content-center">
            <h2>THÔNG TIN TÀI KHOẢN</h2>
        </div>
        <div class="account__information-detail d-flex justify-content-between mt-2">
            <div class="user d-flex flex-column justify-content-center p-5 w-25">
                <div class="user__avatar d-flex align-items-center flex-column justify-center text-center">
                    <img src="../view/assets/img/avatar/avatar9.jpg">
                    <h3>Xin chào</h3>
                    <?php if (isset($user['username'])) : ?>
                    <p><?= $user['username'] ?></p>
                    <?php else : ?>
                    <p></p>
                    <?php endif ?>
                </div>
                <div class="user__menu mt-1">
                    <div class="user__menu mt-3">
                        <li>
                            <i class="bi bi-person"></i>
                            <a href="?account">Thông tin tài khoản</a>
                        </li>
                        <li>
                            <i class="bi bi-menu-button-wide"></i>
                            <a href="?account&&action=manage">Quản lý Đặt Chỗ</a>
                        </li>
                        <li>
                            <i class="bi bi-box-arrow-in-right"></i>
                            <a href="?controller=user&&action=logout">Đăng xuất</a>
                        </li>
                    </div>
                </div>
            </div>
            <div
                class="user__infor flex-fill bd-highligh p-5 d-flex flex-column justify-content-center align-items-center w-75">
                <div class="user__infor-detail">
                    <div class="title">
                        <p>Họ và tên:</p>
                        <?php if ($fullname) : ?>
                        <span><?= $fullname ?></span>
                        <?php else : ?>
                        <p class='text-danger'>Bạn cần cập nhật họ và tên</p>
                        <?php endif ?>
                    </div>
                    <div class="title">
                        <p>Email:</p>
                        <?php if ($email) : ?>
                        <span><?= $email ?></span>
                        <?php else : ?>
                        <p class='text-danger'>Bạn cần cập nhật họ và tên</p>
                        <?php endif ?>
                    </div>
                    <div class="title">
                        <p>Ngày sinh:</p>
                        <?php if ($birthday) : ?>
                        <span><?= $birthday ?></span>
                        <?php else : ?>
                        <p class='text-danger'>Bạn cần cập nhật ngày tháng năm sinh</p>
                        <?php endif ?>
                    </div>
                    <div class="title">
                        <p>Điện thoại</p>
                        <?php if ($phone) : ?>
                        <span><?= $phone ?></span>
                        <?php else : ?>
                        <p class='text-danger'>Bạn cần cập nhật số điện thoại</p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="user__infor-btn mt-3">
                    <a href="?account&&action=update">
                        <button type="button" class="btn btn-primary">CẬP NHẬP THÔNG TIN TÀI KHOẢN</button>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
<?php
if (isset($_SESSION['success-update'])) {
    echo '<script type="text/javascript">toastr.success("Bạn đã cập nhập thành công")</script>';
    unset($_SESSION['success-update']);
}
?>