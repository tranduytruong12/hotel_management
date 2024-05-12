<?php
if (isset($_POST['orderid'])) {
    $orderid = $_POST['orderid'];
}



$order_model = new OrderModel();
$order = $order_model->__getOrder($orderid);
//$order = $order->fetch_array();
// var_dump($order);
$order_detail = $order_model->__getOrderDetail($orderid);
/*

var_dump($orderid);
var_dump($order_detail);
 */
// $orderpayments = $order_model->__getOrderInformation($orderid);
// var_dump($orderpayments);
function orderStatus($status)
{
    if ($status == 0) {
        return "<p><span class='text-warning'>Đang xử lý</span></p>";
    }
    if ($status == 1) {
        return "<p>Trạng thái <span class='text-primary'>Đã xác nhận</span></p>";
    }
    if ($status == 2) {
        return "<p><span class='text-success'>Đặt thành công</span></p>";
    }
}
$response = "
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>
                                    Đơn đặt phòng <span>#{$order['id']}</span>
                                </h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <div class='bill-title d-flex justify-content-between align-items-center'>
                                    <div class='user__infor-detail w-75'>
                                        <div class='title'>
                                            <p>Họ và tên:</p>
                                            <span>{$order['fullname']}</span>
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
                           ";
$response .= orderStatus($order['status']);

$response .=
    "
                                    </div>
                                    </div>
                                    <div class='bill__description-title'>
                                        <div class='title d-flex justify-content-between'>
                                            <h4>THÔNG TIN ĐẶT PHÒNG</h4>
                                        </div>
                                        <table class='table table-striped table-bordered'>
                                            <thead>
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col'>Khách sạn</th>
                                                    <th scope='col'>Loại phòng</th>
                                                    <th scope='col'>Ngày nhận phòng</th>     
                                                    <th scope='col'>Ngày trả phòng</th>
                                                    <th scope='col'>Số lượng phòng</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
// $i = 1;
// while ($row = mysqli_fetch_array($orderpayments)) {

//     $response .= "<tr>
//                                                     <th scope='row'>{$i}</th>
//                                                     <td>{$row['product_name']}</td>
//                                                     <td>{$row['color_name']}</td>
//                                                     <td>{$row['product_count']}</td>
//                                                     <td>{$row['price']}</td>
//                                                     <td>{$row['total']}</td>
//                                                 </tr>";
//     $i++;
// }

$response .= "
    </tbody>
</table>
<div class='bill__description d-flex justify-content-between p-3'>
    <div class='bill__payment'>
        <div class='bill__payment-ti'>
            <i class='bi bi-credit-card'></i>
            Hình thức thanh toán
        </div>
        <h6>Thanh toán trực tiếp </h6>";

// if ($order['payment'] == 1) {
//     $response .= "<h6>Thanh toán bằng MoMo </h6>";
// } elseif ($order['payment'] == 2) {
//     $response .= "<h6>Thanh toán bằng ZaloPay</h6>";
// } elseif ($order['payment'] == 3) {
//     $response .= "<h6>Thanh toán khi nhận hàng </h6>";
// }

$response .= "
    </div>
    <div class='bill__total d-flex align-items-center gap-3'>
        <h4>Cần thanh toán</h4>
        <h6 class='text-danger'>100000000 VNĐ</h6>
    </div>
</div>
</div>
</div>
</div>
";

echo $response;
exit;
