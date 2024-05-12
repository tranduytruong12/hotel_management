<?php
$user_model = new UserModel();
$order_model = new OrderModel();

if (isset($_POST['userid'])) {
    $userid = $_POST['userid'];
}
if (isset($_POST['orderid'])) {
    $orderid = $_POST['orderid'];
}

$user = $user_model->__get($userid);
$user = $user->fetch_array();
// $address = $user_model->__getAddress($userid);
$order = $order_model->__getOrder($orderid);
$order = $order->fetch_array();
// var_dump($order);
$order_detail = $order_model->__getOrderInformation($orderid);
$order_detail = $order_detail->fetch_assoc();
/*

var_dump($orderid);
var_dump($order_detail);
*/
$orderpayments = $order_model->__getOrderInformation($orderid);
// var_dump($orderpayments);    
function orderStatus($status)
{
    if ($status == 0) {
        return "<p><span class='text-warning'>Đang xử lý</span></p>";
    }
    if ($status == 2) {
        return "<p><span class='text-success'>Đã xác nhận</span></p>";
    }
}
$response = "
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>
                                    Đơn hàng <span>#{$order['id']}</span>
                                </h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <div class='bill-title d-flex justify-content-between align-items-center'>
                                    <div class='user__infor-detail w-75'>
                                        <div class='title'>
                                            <p>Họ và tên:</p>
                                            <span>{$user['name']}</span>
                                        </div>
                                        <div class='title'>
                                            <p>Email:</p>
                                            <span>{$user['email']}</span>
                                        </div>
                                        <div class='title'>
                                            <p>Điện thoại:</p>
                                            <span>{$order['phone_number']}</span>
                                        </div>
                                    </div>
                                        
                                </div>
                                <div class='bill__description'>
                                    <div class='bill__description-date d-flex justify-content-around'>
                                        <div class='title'>
                                            <p>Ngày đặt: <span>{$order['order_date']}</span> </p>
                                        </div>
                                        <div class='title'>
                                            <p>Mã hóa đơn: <span>{$order['id']}</span> </p>
                                        </div>
                                        <div class='title'>
                                        </div>
                                        </div>
                                        
                           ";
$response .=       orderStatus($order['status']);

$response .=
'<div class="row align-items-center">
<div class="col-lg-3">
    <img src="' . $order_detail['image'] . '" class="img-fluid"> <!-- img-fluid để hình ảnh điều chỉnh kích thước -->
</div>
<div class="col-lg-6"> <!-- Thay đổi col-3 thành col-lg-6 để giữ lại không gian -->
    <h4 class="cart-item-title">' . $order_detail["apartment_name"] . '</h4>
    <h5 class="cart-item-title">' . $order_detail["category_name"] . '</h5>
    <div id="" class="d-flex justify-content-start">
        <div class="me-3">
            <div>
                Loại Phòng: <p>' . $order_detail["room_name"] . '</p>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3"> <!-- Thêm một cột mới để giữ lại không gian -->
    <div class="text-end">
        <h5>' . number_format($order_detail["total_price"], 0, ',', '.') . ' đ</h5>
    </div>
</div>
</div>';

// $response .=
//     "                                   
//                                     </div>
//                                     </div>
//                                     <div class='bill__description-title'>
//                                         <div class='title d-flex justify-content-between'>
//                                             <h4>THÔNG TIN SẢN PHẨM</h4>
//                                         </div>
//                                         <table class='table table-striped table-bordered'>
//                                             <thead>
//                                                 <tr>
//                                                     <th scope='col'>#</th>
//                                                     <th scope='col'>Tên</th>
//                                                     <th scope='col'>Màu</th>
//                                                     <th scope='col'>Số lượng</th>
//                                                     <th scope='col'>Giá</th>
//                                                     <th scope='col'>Tổng tiền</th>
//                                                 </tr>
//                                             </thead>
//                                             <tbody>";
$i = 1;
// while ($row = mysqli_fetch_array($orderpayments)) {

//     $response .=                                    "<tr>
//                                                     <th scope='row'>{$i}</th>
//                                                     <td>{$row['product_name']}</td>
//                                                     <td>{$row['color_name']}</td>
//                                                     <td>{$row['product_count']}</td>
//                                                     <td>{$row['price']}</td>
//                                                     <td>{$row['total']}</td>
//                                                 </tr>";
//     $i++;
// }


// $response .= "
//     </tbody>
// </table>
// <div class='bill__description d-flex justify-content-between p-3'>
//     <div class='bill__payment'>
//         <div class='bill__payment-ti'>
//             <i class='bi bi-credit-card'></i>
//             Hình thức thanh toán
//         </div>";

// if ($order['payment'] == 1) {
//     $response .= "<h6>Thanh toán bằng MoMo </h6>";
// } elseif ($order['payment'] == 2) {
//     $response .= "<h6>Thanh toán bằng ZaloPay</h6>";
// } elseif ($order['payment'] == 3) {
//     $response .= "<h6>Thanh toán khi nhận hàng </h6>";
// }

// $response .= "
//     </div>
//     <div class='bill__total d-flex align-items-center gap-3'>
//         <h4>Cần thanh toán</h4>
//         <h6 class='text-danger'>$ {$order['total_money']}</h6>
//     </div>
// </div>
// </div>
// </div>
// </div>
// ";


echo $response;
exit;
