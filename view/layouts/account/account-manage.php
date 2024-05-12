<?php

if (isset($_SESSION["user-id"])) {
    $user_id = $_SESSION['user-id'];
} else {
    $user_id = null;
}
//
// echo $user_id;
//

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
// Order
$order_model = new OrderModel();
$orders = $order_model->__get($user_id);

// var_dump($orders);

?>
<div class="container mt-3 w-75">
    <div class="account__information">
        <div class="account__information-title d-flex justify-content-center">
            <h2>QUẢN LÝ ĐẶT CHỖ</h2>
        </div>
        <div class="account__information-detail d-flex justify-content-between align-items-start mt-2">
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
                <div class="user__menu mt-3">
                    <li>
                        <i class="bi bi-person"></i>
                        <a href="?account">Thông tin tài khoản</a>
                    </li>
                    <li>
                        <i class="bi bi-menu-button-wide"></i>
                        <a href="?account&&action=manage">Quản lý đặt chỗ</a>
                    </li>
                    <li>
                        <i class="bi bi-box-arrow-in-right"></i>
                        <a href="?controller=user&&action=logout">Đăng xuất</a>
                    </li>
                </div>
            </div>
            <div class="user__infor flex-fill bd-highligh p-3 d-flex flex-column justify-content-center align-items-center w-75">
                <div class="user__infor-detail d-flex flex-column justify-content-center align-items-center">
                    <h3>Đơn hàng của bạn</h3>
                    <table class="table table-striped table-bordered">
                        <input type="hidden" id="userid" name="userid" value="<?= $user['id'] ?>">
                        <thead>
                            <tr>
                                <th scope="col">#Mã</th>
                                <th scope="col">Ngày</th>
                                <!-- <th scope="col">Tên</th> -->
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td><?= $order['id'] ?></td>
                                    <td><?= $order['order_date'] ?></td>
                                    <!-- <td>Nike ABCD</td> -->

                                    <?php
                                    if ($order['status'] == 0) :
                                    ?>
                                        <td class="text-warning">
                                            Đang xử lý
                                        </td>
                                    <?php elseif ($order['status'] == 2) : ?>
                                        <td class="text-success">
                                            Đã xác nhận
                                        </td>
                                    <?php endif ?>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-success w-100 detail-order" data-bs-toggle="modal" data-bs-target="#exampleModal" data-order-id="<?= $order['id'] ?>">
                                            XEM
                                        </button>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog d-flex align-items-center justify-content-center" id="modal-dialog-user">
                        <div class="modal-content" id="modal-user">
                            <!-- <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Đơn hàng <span>#123465</span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="bill-title d-flex justify-content-between align-items-center">
                                    <div class="user__infor-detail w-75">
                                        <div class="title">
                                            <p>Họ và tên:</p>
                                            <span>Nguyễn Trương Phước Thọ</span>
                                        </div>
                                        <div class="title">
                                            <p>Email:</p>
                                            <span>abc9@gmail.com</span>
                                        </div>
                                        <div class="title">
                                            <p>Địa chỉ:</p>
                                            <span>123 Trần Hưng Đạo, Hội Phú, Đà Nẵng</span>
                                        </div>
                                        <div class="title">
                                            <p>Điện thoại:</p>
                                            <span>0987 654 321</span>
                                        </div>
                                    </div>
                                    <div class="user__avatar">
                                        <img src="img/avatar9.jpg" class="bill-ava">
                                    </div>
                                </div>
                                <div class="bill__description">
                                    <div class="bill__description-date d-flex justify-content-around">
                                        <div class="title">
                                            <p>Ngày đặt: <span>15/05/2025</span> </p>
                                        </div>
                                        <div class="title">
                                            <p>Mã hóa đơn: <span>#123456</span> </p>
                                        </div>
                                        <div class="title">
                                            <p>Trạng thái <span class="text-warning">Đang xác nhận</span> </p>
                                        </div>
                                    </div>
                                    <div class="bill__description-title">
                                        <div class="title d-flex justify-content-between">
                                            <h4>THÔNG TIN SẢN PHẨM</h4>

                                        </div>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tên</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Giá</th>
                                                    <th scope="col">Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Thượng đình x9x1-456</td>
                                                    <td>1</td>
                                                    <td>123.239đ</td>
                                                    <td>123.239đ</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Thượng đình x9x1-456</td>
                                                    <td>1</td>
                                                    <td>123.239đ</td>
                                                    <td>123.239đ</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Thượng đình x9x1-456</td>
                                                    <td>1</td>
                                                    <td>123.239đ</td>
                                                    <td>123.239đ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="bill__description d-flex justify-content-between p-3">
                                            <div class="bill__payment">
                                                <div class="bill__payment-ti">
                                                    <i class="bi bi-credit-card"></i>
                                                    Hình thức thanh toán
                                                </div>
                                                <h6>Thanh toán khi nhận hàng</h6>
                                            </div>
                                            <div class="bill__total d-flex align-items-center gap-3">
                                                <h4>Cần thanh toán</h4>
                                                <h6 class="text-danger">1.123.456đ</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {

        $('.detail-order').click(function() {

            var orderid = $(this).data('order-id');
            var userid = $('#userid').val();
            // AJAX request
            $.ajax({
                url: `?logic`,
                type: 'post',
                data: {
                    userid: userid,
                    orderid: orderid,
                },
                success: function(response) {
                    // Add response in Modal body
                    console.log(response);
                    $('.modal-content').html(response);

                    // Display Modal
                    $('#exampleModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>