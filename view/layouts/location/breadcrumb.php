<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-5 py-2 bg-light fs-6">
        <li class="breadcrumb-item">
            <a class="text-black link-underline link-underline-opacity-0 breadcrumb__item" href="../app/index.php">Trang
                chủ</a>
        </li>
        <li class="breadcrumb-item">
            <a class="text-black link-underline link-underline-opacity-0 breadcrumb__item"
                href="../app/index.php?apartment_list&&category_id=<?php echo $category['id']; ?>">
                <?php echo $category['catagory_name']. '-' . $location->get_name_location_by_id($category['location_id']) ?>
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $apartment['name'] ?></li>
    </ol>
</nav>