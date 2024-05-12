<?php

if (isset($_SESSION["user-id"])) {
    $user_id = $_SESSION['user-id'];
} else {
    $user_id = null;
}

if ($user_id) {
    $user_model = new UserModel();
    $users = $user_model->__get($user_id);
    $user = $users->fetch_all(MYSQLI_ASSOC)[0];
    $username = ($user['name']);
}

/*

if($user_id){
    echo 'a'.$user_id.'a';
}
else {
    echo 'null'.$user_id.'null';
}
*/

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FiveChickens</title>
    <link rel="stylesheet" href="../view/assets/css/style.css">
    <link rel="stylesheet" href="../view/assets/css/base.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />




</head>

<body>
    <div class="header border border-1">
        <nav class="navbar navbar-expand-lg mx-3">
            <div class="container-fluid p-0">
                <a class="me-5 p-0 navbar-brand" href="#">
                    <img src="../view/assets/img/vivu.png" alt="Bootstrap" width="30" height="33.2">
                    BKVIVU </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav w-50 ms-5 mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="p-0 me-5 nav-link active" aria-current="page" href="../app/index.php">TRANG
                                CHỦ</a>
                        </li>
                        <li class="header__dropdown-menu-item nav-item dropdown">
                            <a class="p-0 me-5 nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"> Hồ Chí Minh </a>
                            <ul class="dropdown-menu border-0 pb-0">
                                <?php
                                $categories = $category_model->get_category_by_object("1");
                                foreach ($categories as $category) { ?>
                                <li class="border"><a class="dropdown-item"
                                        href="../app/index.php?apartment_list&&&category_id=<?php echo $category['id'] ?>"><?php echo $category['catagory_name']; ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="header__dropdown-menu-item nav-item dropdown">
                            <a class="p-0 me-5 nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"> Hà Nội </a>
                            <ul class="dropdown-menu border-0 pb-0">
                                <?php
                                $categories = $category_model->get_category_by_object("2");
                                foreach ($categories as $category) { ?>
                                <li class="border"><a class="dropdown-item"
                                        href="../app/index.php?apartment_list&&category_id=<?php echo $category['id'] ?>"><?php echo $category['catagory_name']; ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="header__dropdown-menu-item nav-item dropdown">
                            <a class="p-0 me-5 nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"> Đà Lạt </a>
                            <ul class="dropdown-menu border-0 pb-0">
                                <?php
                                $categories = $category_model->get_category_by_object("3");
                                foreach ($categories as $category) { ?>
                                <li class="border"><a class="dropdown-item"
                                        href="../app/index.php?apartment_list&&category_id=<?php echo $category['id'] ?>"><?php echo $category['catagory_name']; ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="header__dropdown-menu-item nav-item dropdown">
                            <a class="p-0 me-5 nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"> Đà Nẵng </a>
                            <ul class="dropdown-menu border-0 pb-0">
                                <?php
                                $categories = $category_model->get_category_by_object("4");
                                foreach ($categories as $category) { ?>
                                <li class="border"><a class="dropdown-item"
                                        href="../app/index.php?apartment_list&&category_id=<?php echo $category['id'] ?>"><?php echo $category['catagory_name']; ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <!-- <li class="header__dropdown-menu-item nav-item dropdown">
                            <a class="p-0 me-5 nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"> Nha Trang </a>
                            <ul class="dropdown-menu border-0 pb-0">
                                <?php
                                $categories = $category_model->get_category_by_object("5");
                                foreach ($categories as $category) { ?>
                                <li class="border"><a class="dropdown-item"
                                        href="../app/index.php?apartment_list&&category_id=<?php echo $category['id'] ?>"><?php echo $category['catagory_name']; ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li> -->
                    </ul>
                    <form class="d-flex mx-5 w-25" role="search" method="post" action="../app/index.php?apartment_list">
                        <input class="p-0 form-control me-2" type="search" placeholder="Bạn cần tìm gì ..."
                            aria-label="Search" name='search' required>
                        <button class="p-0 btn w-50 btn-outline-success" type="submit">Tìm kiếm</button>
                    </form>
                    <ul class="ms-5 navbar-nav d-flex flex-row me-1">
                        <li class="nav-item me-lg-0 dropdown">
                            <a class="nav-link p-0 ms-3" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="bi bi-person fs-3"></i></a>
                            <!-- <div class="header__user-dropdown dropdown-menu dropdown-menu-end">
                                                <p class="text-center mb-0">THÔNG TIN TÀI KHOẢN</p>
                                                <hr class="hr hr-blurry w-75 my-2 mx-auto" />
                                                <p class="ms-2 mb-1">Tên User</p>
                                                <ul class="header__user-list">
                                                    <li><a href="./account.html">Thông tin tài khoản</a></li>
                                                    <li><a href="./account-manage.html">Quản lý đơn hàng</a></li>
                                                    <li><a href="./account-maps.html">Danh sách địa chỉ</a></li>
                                                    <li><a href="">Đăng xuất</a>
                                                    </li>
                                                </ul>
                                            </div> -->
                            <?php
                            // Login
                            if (isset($user_id)) {

                            ?>

                            <div class="header__user-dropdown dropdown-menu dropdown-menu-end">
                                <p class="text-center mb-0">THÔNG TIN TÀI KHOẢN</p>
                                <hr class="hr hr-blurry w-75 my-2 mx-auto" />
                                <p class="ms-4 m-1 px-2"> Xin chào <?= $username ?></p>
                                <ul class="header__user-list">
                                    <li><a href="?account">Thông tin tài khoản</a></li>
                                    <li><a href="?account&&action=manage">Quản lý Đặt Chỗ</a></li>
                                    <li><a href="?controller=user&&action=logout">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                            <?php } else {  ?>
                            <!-- Not login -->
                            <div class="header__login-dropdown dropdown-menu dropdown-menu-end">
                                <p class="text-center mb-0">THÔNG TIN TÀI KHOẢN</p>
                                <hr class="hr hr-blurry w-75 my-2 mx-auto" />
                                <div class="d-grid gap-2 col-10 mx-auto">
                                    <button onclick="location.href='?controller=user&&action=signin'"
                                        class="btn btn-primary" type="button">Đăng nhập</button>
                                    <button onclick="location.href='?controller=user&&action=signup'"
                                        class="btn btn-success" type="button">Đăng ký</button>
                                </div>
                            </div>
                            <?php } ?>
                        </li>
                        <li class="nav-item me-lg-0 dropdown">
                            <a class="nav-link p-0 ms-3" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="bi bi-cart3 fs-3"></i></a>
                            <div class="header__cart-dropdown dropdown-menu dropdown-menu-end">
                                <p class="text-center mb-0">GIỎ HÀNG</p>
                                <hr class="hr hr-blurry w-75 my-2 mx-auto" />
                                <div>
                                    <!-- <?php if ($cart_items) {
                                        foreach ($cart_items as $cart_item) {
                                            if ($cart_item["room_count"] == 0) {
                                                continue;
                                            }
                                        ?>
                                    <a class="row g-0 border link-underline link-underline-opacity-0 text-black header__cart-item"
                                        href="./detail-item.html">
                                        <div class="col-md-4">
                                            <img src="<?php echo $cart_item["product_img"] ?>"
                                                class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8 card-body">
                                            <div class="row mx-0 mb-3">
                                                <p class="card-text col-md-12 header__cart-title">
                                                    <?php echo $cart_item["product_name"] ?></p>
                                            </div>
                                            <div class="row mb-3 mx-0">
                                                <div class="col-md-8">
                                                    <p class="card-text"><small class="text-body-secondary">Màu:
                                                            <?php echo $cart_item["color_name"] ?></small>
                                                    </p>
                                                </div>
                                                <div class="col-md-2 header__cart-quantity">
                                                    <?php echo $cart_item["room_count"] ?> </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php } }  ?> -->
                                </div>
                                <!-- <?php if ($total_price) { ?>
                                <div class="row justify-content-end mx-0 my-2">
                                    <p class="card-text text-danger col-md-4"><?php echo $total_price ?> đ</p>
                                </div>
                                <?php } ?> -->
                                <div class="d-grid col-10 mx-auto">
                                    <button onclick="location.href='.?cart'" class="btn btn-dark" type="button">Xem đơn hàng đã đặt</button>
                                </div>
                            </div>
                        </li>
                        <!-- <li class="nav-item me-lg-0 dropdown">
                            <a class="nav-link p-0 ms-3" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="bi bi-bell fs-3"></i></a>
                            <div class="header__notification-dropdown dropdown-menu dropdown-menu-end">
                                <p class="text-center mb-0">THÔNG BÁO</p>
                                <hr class="hr hr-blurry w-75 my-2 mx-auto" />
                                <div class="mb-2">
                                    <div class="g-0 border">
                                        <p class="fw-bold mx-2">Tiêu đề</p>
                                        <p class="mx-2">Mô tả</p>
                                    </div>
                                    <div class="g-0 border">
                                        <p class="fw-bold mx-2">Tiêu đề</p>
                                        <p class="mx-2">Mô tả</p>
                                    </div>
                                </div>
                                <div class="d-grid col-10 mx-auto">
                                    <button onclick="url.href='./account-notifi.html'" class="btn btn-dark"
                                        type="button">Xem tất cả</button>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>