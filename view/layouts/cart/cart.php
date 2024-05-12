<?php
$user_id = "null";
if (isset($_SESSION["user-id"])) {
    $user_id = $_SESSION["user-id"];
}

$count = 0;
?>

<div class="my-4">
    <h1 class="text-center my-3">Đặt phòng của bạn</h1>

    <div class="container mb-2 col-6 align-self-center">
        <?php while ($cart_items and $cart_item = $cart_items->fetch_assoc()) { ?>
            <?php  ?>
            <?php $count += 1; ?>
            <div class="row my-3">
                <img src="<?php echo $cart_item['image'] ?>" class="col-lg-2">
                <div class="cart-item-info col-md-8 col-sm-10">
                    <h4 class="cart-item-title">
                        <?php echo $cart_item["apartment_name"] ?>
                    </h4>
                    <h5 class="cart-item-title">
                        <?php echo $cart_item["category_name"] ?>
                    </h5>
                    <div id="" class="d-flex justify-content-start">
                        <div class="me-3">
                            <div>
                                Loại Phòng: <p><?php echo $cart_item["room_name"] ?></p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="cart-item-price col-2 py-1">
                    <h5 class="text-end">
                        <?php
                        $price = $cart_item["price"];
                        $formatted_price = number_format($price, 0, ',', '.');
                        echo $formatted_price;
                        ?>
                        đ
                    </h5>
                </div>
            </div>
        <?php }  ?>
    </div>
    <div class="row">
        <div class="col">
            <img src="' . $order_detail['image'] . '" class="col-lg-2">
        </div>
        <div class="col-3">
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
        <div class="col">
            <h5 class="text-end">' . number_format($order_detail["price"], 0, ',', '.') . ' đ</h5>
        </div>
    </div>

</div>
</div>