<?php $user_id = "null";
if (isset($_SESSION['user-id'])) {
    $user_id = $_SESSION['user-id'];
} ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-5 py-2 bg-light fs-6">
        <li class="breadcrumb-item">
            <a class="text-black link-underline link-underline-opacity-0 breadcrumb__item" href="../app/index.php">Trang
                chủ</a>
        </li>
        <li class="breadcrumb-item">
            <a class="text-black link-underline link-underline-opacity-0 breadcrumb__item" href="../app/index.php?apartment_list&&category_id=<?php echo $category['id']; ?>">
                <?php echo $category['catagory_name'] . '-' . $location->get_name_location_by_id($category['location_id']) ?>
            </a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
            <a class="text-black link-underline link-underline-opacity-0 breadcrumb__item" href="../app/index.php?detail_room&&apartment_id=<?php echo $apartment['id']; ?>">
                <?php echo $apartment['name'] ?>
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Đặt phòng</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <br>
            <br>
            <br>
            <br>
            <img src="<?php echo $apartment['apartment_img'] ?>" alt="">
        </div>
        <div class="col-md-7">
            <div class="container p-x-3 mt-2">
                <div class="row justify-content-center">
                    <div class="col-md-12"> <!-- Thay đổi col-md-6 thành col-md-12 -->
                        <div class="custom-form bg-light rounded p-4"> <!-- Sử dụng class bg-light để đặt màu nền và class rounded để bo góc -->
                            <h2 class="text-center mb-4">Đặt Phòng <?php echo $apartment['name']; ?></h2>
                            <form method="post" name="form" id="form">
                    <div class="form-group py-2">
                        <label for="type" class="font-weight-bold">Loại phòng:</label>
                        <input type="text" class="form-control" id="type" name="type" min="1" value="<?php echo $room[0]['name']; ?>" readonly>
                    </div>
                    <div class="form-group py-2">
                        <label for="checkin_date" class="font-weight-bold">Ngày Đặt:</label>
                        <input type="date" class="form-control" id="checkin_date" name="checkin_date" value="<?php echo date('Y-m-d'); ?>" >
                    </div>
                    <div class="form-group py-2">
                        <label for="checkin_date" class="font-weight-bold">Số ngày:</label>
                        <input type="text" class="form-control" id="checkin_date" name="days" value="<?php echo 1; ?>" required>
                    </div>
                    <div class="form-group py-2">
                        <label for="username" class="font-weight-bold">Tên Người Đặt:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? $username : ''; ?>" required>
                    </div>
                    <div class="form-group py-2">
                        <label for="phone" class="font-weight-bold">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                    </div>
                    <div class="form-group py-2">
                        <label for="total_price" class="font-weight-bold">Giá Phòng:</label>
                        <input type="text" class="form-control" id="total_price" value="<?php 
                                                                    $formatted_price = number_format($price, 0, ',', '.');
                                                                    echo $formatted_price; ?>" name="total_price" readonly>
                    </div>
                    <div class="text-center py-2">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Đặt Ngay</button>
                    </div>
                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
