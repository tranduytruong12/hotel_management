<?php
$order_model = new OrderModel();
$orders = $order_model->__getAll();
// var_dump($orders);
?>

<!-- main wrapper -->
<div class="main_wrapper d-flex flex-row">

    <!-- side navigate wrapper -->
    <div class="sidenav text-wrap p-0 m-0">
        <nav class="nav nav-pills flex-column text-center p-0 m-0">
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" aria-current="page" href="../app/index.php?">Dashboard</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=category">Danh mục khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=apartment-list">Danh sách
                khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=add-apartment">Thêm khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=add-room">Thêm phòng khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 active" href="../app/index.php?page=manage">Quản lý phòng đặt</a>
        </nav>
    </div>

    <!-- ### -->
    <!-- main content wrapper -->
    <!-- to do -->
    <div class="maincontent container-fluid">
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#Mã đơn hàng</th>
                        <th scope="col">Ngày</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= $order['order_date'] ?></td>
                            <?php
                                    if ($order['status'] == 0) :
                                    ?>
                                        <td class="text-warning">
                                            Đang xử lý
                                        </td>
                                    <?php elseif ($order['status'] == 1) : ?>
                                        <td class="text-primary">
                                            Đã xác nhận
                                        </td>
                                    <?php elseif ($order['status'] == 2) : ?>
                                        <td class="text-success">
                                            Thành công
                                        </td>
                                    <?php endif ?>
                            <td>
                                <button type="button" class="btn btn-success w-100 detail-order" data-bs-toggle="modal" data-bs-target="#exampleModal" data-order-id="<?= $order['id'] ?>">
                                    XEM
                                </button>
                            </td>
                            <td class="d-flex gap-1">
                                <button type="button" class="btn btn-warning w-100 process w-25" data-order-id="<?= $order['id'] ?>">
                                    CHỜ XỬ LÝ
                                </button>
                                <button type="button" class="btn btn-primary w-100 accept w-25" data-order-id="<?= $order['id'] ?>">
                                    XÁC NHẬN ĐÃ NHẬN
                                </button>
                                <button type="button" class="btn btn-success w-100 confirm detail-order w-25" data-order-id="<?= $order['id'] ?>">
                                    ĐẶT PHÒNG THÀNH CÔNG
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end main wrapper -->
    <!-- <div class="main_wrapper d-flex flex-row"> -->
    <!-- include head.php -->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center w-100" id="modal-dialog-user">
        <div class="modal-content" id="modal-user">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.detail-order').click(function() {
            var orderid = $(this).data('order-id');

            // AJAX request
            $.ajax({
                url: `?page=logic`,
                type: 'post',
                data: {
                    orderid: orderid,
                },
                
                success: function(response) {
                    // Add response in Modal body
                    // console.log(response);
                    $('.modal-content').html(response);
                    
                    // Display Modal
                    $('#exampleModal').modal('show');
                },
                
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('.process').click(function() {
            var orderid = $(this).data('order-id');
            // AJAX request
            $.ajax({
                url: `?page=logic&action=process`,
                type: 'post',
                data: {
                    orderid: orderid,
                },
                success: function(response) {
                    // Add response in Modal body
                    console.log(response);
                    // $('.modal-content').html(response);
                    location.href = '?page=manage';
                    // Display Modal
                    // $('#exampleModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('.accept').click(function() {
            var orderid = $(this).data('order-id');

            // AJAX request
            $.ajax({
                url: `?page=logic&action=accept`,
                type: 'post',
                data: {
                    orderid: orderid,
                },
                success: function(response) {
                    // Add response in Modal body
                    console.log(response);
                    location.href = '?page=manage';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('.confirm').click(function() {
            var orderid = $(this).data('order-id');
            // AJAX request
            $.ajax({
                url: `?page=logic&action=confirm`,
                type: 'post',
                data: {
                    orderid: orderid,
                },
                success: function(response) {
                    // Add response in Modal body
                    console.log(response);
                    location.href = '?page=manage';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>