<div class="container-fluid p-0">
        <div class="mx-5">
            <h2 class="text-center my-4"> <?php if ($search != '') {
                                                echo 'Kết quả tìm kiếm cho "' . $search . '"';
                                            } else {
                                                echo $category['catagory_name'] . '-' . $location->get_name_location_by_id($category['location_id']);
                                            } ?> </h2>
            <div class="<?php if ($search != '') {
                            echo 'hide';
                        }
                        ?>">
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-4 mt-5 border-box">
                <?php $i = 0;
                if ($apartment_list) {
                    foreach ($apartment_list as $apartment) {
                        $apartment_id = $apartment["id"];
                        $avatar = $location_model->get_avatar_apartment($apartment_id);
                        $i++;
                ?>
                <a class="item-list__card-link px-3 link-underline link-underline-opacity-0"
                    href="../app/index.php?detail_room&&apartment_id=<?php echo $apartment['id']; ?>">
                    <div class="item-list__card card col p-0 h-100" style="border-radius:20px;">
                        <img src="<?php echo $avatar; ?>" class="card-img-top"
                            style="border-top-left-radius: 20px; border-top-right-radius: 20px;" alt="...">
                        <div class="card-body"
                            style="background:#E1F7F5; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                            <h5 class=" card-title fs-6 text-center"><?php echo $apartment['name']; ?></h5>
                        </div>
                    </div>
                </a>
                <?php }
                }
                if ($i == 0) { ?>
                <div class="pb-5">Không tìm thấy kết quả phù hợp</div>
                <?php } ?>
            </div>
            <div class="<?php if (!$apartment_list || $limited) {
                            echo 'hide';
                        }
                        ?>">
                <div class="d-flex justify-content-center my-5">
                    <a href="<?php if ($viewmore) {
                                    echo str_replace('&&viewmore', '', $_SERVER['REQUEST_URI']);
                                } else {
                                    echo $_SERVER['REQUEST_URI'] . '&&viewmore';
                                } ?>" type="button" class="item-list__view-more-btn btn btn-primary"><?php if ($viewmore) {
                                                                        echo 'Thu gọn';
                                                                    } else {
                                                                        echo 'Xem thêm';
                                                                    } ?>
                    </a>
                </div>
            </div>


        </div>

    </div>