<?php $user_id = "null";
if (isset($_SESSION['user-id'])) {
    $user_id = $_SESSION['user-id'];
}
?>

<div class="container border-box" style="
                background-color: #ffdee9;
                background-image: linear-gradient(
                    141deg,
                    #ffdee9 0%,
                    #b5fffc 19%,
                    #ffffff 39%,
                    #ffffff 60%,
                    #ffffff 80%,
                    #ffffff 100%
                );
            ">
    <div class="header-item-list">
        <h1><?php echo $apartment['name'] ?></h1>
        <div class="d-flex justify-content-between align-items-center">
            <div class="rate">
                <small><?php echo $apartment['name'] ?></small>
                <div class="sub-title d-flex align-items-center">
                    <span>Khách sạn</span>
                    <?php

                    for ($x = 0; $x < $star; $x++) {
                        echo '<span class="material-symbols-outlined" style="color: yellow">star</span>';
                    }
                    if ($star == 0) {
                        echo '<span>: Chưa có đánh giá</span>';
                    }

                    ?>
                    <!-- <span class="material-symbols-outlined" inline-block style="color: yellow">
                        star
                    </span> -->
                </div>
            </div>
        </div>
    </div>
    <!-- address -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <span class="material-symbols-outlined"> location_on </span>
            <?php echo'<span>' .$apartment['address'].'<span>' ?>
            <!-- <span>
                56 - 66 Nguyễn Huệ, Bến Nghé, Quận 1, Thành phố Hồ Chí
                Minh, Việt Nam, 700000
            </span> -->
        </div>
        <div class="ml-auto">
            <?php
                if(isset($_SESSION['user-id']) && $_SESSION['user-id'] !== null) {
                        if ($ordered){
                            echo '<button type="button" class="btn btn-primary" onclick="rate_handler()">Đánh giá</button>';
                        }
                }?>
            <button class="btn btn-primary">
                <a href="#btn-room" style="color: white; text-decoration: none">Chọn phòng</a>
            </button>
        </div>
    </div>
    <!-- img-layout -->
    <div class="img-layout d-flex justify-content-center mt-3 gap-2">
        <div class="">
            <img src="<?php echo $apartment['apartment_img'] ?>" alt="" class="border-box "
                style="min-width: 350px;max-width:500px; max-height:350px;" />
        </div>
        <div class="img-room d-flex gap-3 flex-wrap rounded-3">
            <?php
            foreach ($apartment_room as $room) {
                echo '<img src=" ' . $room['image'] . ' "
                alt="" style="height: 150px" class="border-box" /> ';
            }
            ?>
        </div>
    </div>
    <!-- introduce$feature-->
    <div class="d-flex mt-3 gap-2 border-box" style="
                    background-color: #ffdee9;
                    background-image: linear-gradient(
                        315deg,
                        #ffdee9 0%,
                        #b5fffc 24%,
                        #ffffff 49%,
                        #ffffff 75%,
                        #ffffff 100%
                    );
                ">
        <!-- introduce -->
        <div class="introduce border border-1 p-3 border-box" style="width: 800px">
            <h3>Giới thiệu</h3>
            <p>
                <?php echo $apartment['description'] ?>
            </p>
        </div>
        <!-- feature -->
        <div class="features border border-1 p-3 border-box" style="width: 500px">
            <h3>Tiện ích chính</h3>
            <div class="item-icon row row-cols-2 align-items-center">
                <div class="col">
                    <span class="material-symbols-outlined">
                        wifi
                    </span>
                    <span>Wifi miễn phí</span>
                </div>
                <div class="col">
                    <span class="material-symbols-outlined">
                        ac_unit
                    </span>
                    <span>Điều hòa</span>
                </div>
                <div class="col mt-3">
                    <span class="material-symbols-outlined">
                        restaurant
                    </span>
                    <span>Nhà hàng</span>
                </div>
                <div class="col mt-3">
                    <span class="material-symbols-outlined">
                        pool
                    </span>
                    <span>Hồ bơi</span>
                </div>
            </div>
        </div>
    </div>
    <!-- room -->
    <?php 
            if (count($apartment_room) != 0){
       ?>
    <div class="border border-1 mt-5 p-3 gap-5 border-box" id="btn-room" style="
                    background-color: #ffdee9;
                    background-image: linear-gradient(
                        124deg,
                        #ffdee9 0%,
                        #b5fffc 24%,
                        #ffffff 49%,
                        #ffffff 75%,
                        #ffffff 100%
                    );
                ">
        <h3 class="text-center p-2" style="font-weight: 700">
        </h3>
        <div class="box d-flex gap-5 border-box">
            <!-- left-box -->
            <div class="left-box d-flex flex-column gap-2 border-box">
                <!-- roomimg -->
                <div class="slider" style="width:400px;">
                    <div class="list">
                        <?php
                        foreach ($apartment_room as $room) {
                        ?>
                        <div class="item">
                            <img src="<?php echo  $room['image'] ?>" alt="" style="width:400px;" class="border-box" />
                        </div>
                        <?php
                        } ?>
                    </div>
                    <?php 
                        if(isset($room['image'])) {
                        echo '<div class="buttons">
                            <button id="prev">
                                < </button>
                                    <button id="next">></button>
                        </div>';
                        }
                    ?>
                    <?php 
                     if (count($apartment_room) == 1){
                        echo '<ul class="dots">
                        <li class="active"></li>';
                     }
                     else if (count($apartment_room) == 2){
                        echo '<ul class="dots">
                        <li class="active">
                        <li></li>';}
                        else if (count($apartment_room) == 2){
                            echo '<ul class="dots">
                            <li class="active">
                            <li></li>
                            <li></li>';
                        }
                        else{}
                     ?>
                    <!-- <ul class="dots">
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                    </ul> -->
                </div>
                <div class="item-icon d-flex gap-4">
                    <div class="icon">
                        <span class="material-symbols-outlined">
                            bathtub
                        </span>
                        <span>Bồn tắm</span>
                    </div>
                    <div class="icon">
                        <span class="material-symbols-outlined">
                            ac_unit
                        </span>
                        <span>Điều hòa</span>
                    </div>
                </div>
                <div class="d-flex">
                    <span class="material-symbols-outlined">
                        qr_code
                    </span>
                    <span><a href="#!">Xem chi tiết phòng</a></span>
                </div>
            </div>
            <!-- right-box -->
            <div class="right-box">
                <table class="table table-bordered" style="width: 800px; height: 300px">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">Lựa chọn phòng</th>
                            <th scope="col">Khách</th>
                            <th scope="col">Giá/phòng/Đêm</th>
                            <th scope="col">
                                <?php if (!isset($_SESSION['user-id'])) {
                                    echo 'Bạn cần Đăng Nhập';
                                } ?>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($apartment_room as $room) {
                            $room_id = $room['room_id'];
                            $roomtyp = $roomtyp_model->get_roomtyp_by_id($room_id);
                            if (!empty($roomtyp)) {
                                foreach ($roomtyp as $value) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?php echo $value['name'] ?>
                            </th>
                            <td>
                                <span class="material-symbols-outlined">
                                    person
                                </span>
                            </td>
                            <td><?php $price = $room['price'];
                                            $formatted_price = number_format($price, 0, ',', '.');
                                            echo $formatted_price; ?>VNĐ</td>
                            <td>
                                <?php if (!isset($_SESSION['user-id'])) { ?>
                                <button class="btn btn-primary round-3" href="#" disabled>Chọn</button>
                                <?php } else { ?>
                                <a class="btn btn-primary round-3"
                                    href="../app/index.php?booking&&apartment_id=<?php echo $apartment['id']; ?>&room_id=<?php echo $room['room_id']; ?>">Chọn</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php }
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php      
        }
     ?>
</div>

<script>
let slider = document.querySelector(".slider .list");
let items = document.querySelectorAll(".slider .list .item");
let next = document.getElementById("next");
let prev = document.getElementById("prev");
let dots = document.querySelectorAll(".slider .dots li");

let lengthItems = items.length - 1;
let active = 0;
next.onclick = function() {
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadSlider();
};
prev.onclick = function() {
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadSlider();
};
let refreshInterval = setInterval(() => {
    next.click();
}, 5000);

function reloadSlider() {
    slider.style.left = -items[active].offsetLeft + "px";
    //
    let last_active_dot = document.querySelector(
        ".slider .dots li.active"
    );
    last_active_dot.classList.remove("active");
    dots[active].classList.add("active");

    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => {
        next.click();
    }, 5000);
}

dots.forEach((li, key) => {
    li.addEventListener("click", () => {
        active = key;
        reloadSlider();
    });
});
window.onresize = function(event) {
    reloadSlider();
};
function rate_handler(){
            var modal = document.getElementById("rate-form");
            modal.style.display = "block";
        }
    function form_close() {
        var modal = document.getElementById("rate-form");
        modal.style.display = 'none';
    }   
</script>

<div class="modal" id="rate-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Đánh giá</h5>
            </div>
            <form method="post" name="form" id="form">
            <div class="modal-body">
                <div class="form-group">
                    <label for="rate_star">Số sao:</label>
                    <select class="form-control" id="rate_star" name="rate_star">
                        <option value="1">1</option>
                        <option value="2">2 </option>
                        <option value="3">3 </option>
                        <option value="4">4 </option>
                        <option value="5">5 </option>
                    </select>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="form_close()">Đóng</button>
                    <button type="submit" id="rating_form" name="rating_form" class="btn btn-primary" >Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>