<!-- main wrapper -->
<div class="main_wrapper d-flex flex-row">
    <!-- side navigate wrapper -->
    <div class="sidenav text-wrap p-0 m-0">

        <nav class="nav nav-pills flex-column text-center p-0 m-0">
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " aria-current="page" href="../app/index.php?">Dashboard</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 active" href="../app/index.php?page=category">Danh mục khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=apartment-list">Danh sách
                khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=add-apartment">Thêm khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=add-room">Thêm phòng khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=manage">Quản lý phòng đặt</a>
        </nav>
    </div>

    <!-- main content wrapper -->
    <div class="maincontent container container-fluid">
        <!-- to do -->
        <div class="container container-fluid">
            <div class="list_catalog">
                <div class="col-12 mb-1">
                    DANH MỤC KHÁCH SẠN
                </div>
                <table class="table_catalog table border table-hover mb-2">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">SST</th>
                            <th class="text-center" style="width: 10%;">Mã số</th>
                            <th class="text-center" style="width: 20%;">Địa điểm</th>
                            <th>Loại khách sạn</th>
                            <th class="text-center">Số lượng khách sạn</th>
                            <th style="width: 15%;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- php $objectList -->
                        <?php
$count = 0;
if (!empty($objectList)) {
    foreach ($objectList as $object) {
        $categoryListByObj = $categoryObj->get_category_by_object($object['location_id']);
        $numOfHotel = '';
        foreach ($categoryListByObj as $category) {
            $count++;
            $numOfHotel = $categoryObj->get_number_of_apartment_has_categoryId($category['id']);
            $location_name = $categoryObj->get_location_with_id($category['location_id']);
            ?>
                                    <tr>
                                        <td class="text-center"><?=$count?></td>
                                        <td class="text-center"><?=$category['id']?></td>
                                        <td class="text-center"><?= $location_name?></td>
                                        <td><?=$category['catagory_name']?></td>
                                        <td class="text-center"><?=$numOfHotel?></td>
                                        <td class="catalog_operator" class="btn-group btn-group-sm p-0 m-0" role="button group" aria-label="operator button group">
                                            <button type="button" onclick="infoModalEditCategory('<?=$category['id']?>', '<?= $location_name?>', '<?=$category['catagory_name']?>')" class="edit_apartmenttpye btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#edit_staticBackdrop">
                                                SỬA
                                            </button>
                                            <button class="btn btn-sm btn-danger" form="formForDeleteCategory" formaction="index.php?page=category&delete" role="submit" <?php if ($numOfHotel > 0) {
                echo "disabled";
            }?> onclick="infoFormDeleteCategory('<?=$category['id']?>')">XOÁ</button>
                                        </td>
                                    </tr>
                        <?php
}
    }
} else {
    echo "<p>Hiện tại không có danh mục sản phẩm! Hãy thêm danh mục sản phẩm.</p>";
}
?>
                    </tbody>
                </table>
            </div>
            <div>
                <h6>Note: Chỉ có những danh mục không có khách sạn nào mới có thể xoá.</h6>
            </div>

            <div hidden class="hidden">
                <form hidden id="formForDeleteCategory" method="post">
                    <input id="deleteCategoryId" name="deleteCategoryId" type="hidden" value="">
                </form>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="edit_staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">SỬA DANH MỤC KHÁCH SẠN</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formForEditCategory" class="form_edit_catalog_class" action="index.php?page=category&edit=" method="post">
                                <!-- doi tuong/customer -->
                                <div class="form_edit_catalog__cus">
                                    <label for="editedObject" class="form-label">Địa điểm</label>
                                    <input type="text" name="editedObject" class="form-control" id="editedObject" value="" disabled>
                                </div>

                                <!-- type -->
                                <div class="form_edit_catalog__type">
                                    <label for="editCategory" class="form-label">Loại khách sạn</label>
                                    <input type="text" name="editCategory" class="form-control" id="editCategory" value="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">HUỶ</button>
                            <button type="submit" form="formForEditCategory" class="btn btn-primary">LƯU THAY ĐỔI</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="add_catalog p-1 row g-1">
                <div class="col-12">
                    THÊM DANH MỤC KHÁCH SẠN
                </div>
                <form class="form_add_catalog col-12 row g-2 border p-2" action="index.php?page=category&addCategory=TRUE" method="post">
                    <!-- doi tuong/customer -->
                    <div class="form-group">
                        <div class="form_add_catalog__cus col-md-5">
                            <label for="customertype" class="form-label">Địa điểm</label>
                            <select id="customertype" class="form-select" name="categoryLocation">
                                <option value="1" selected>Hồ Chí Minh</option>
                                <option value="2">Hà Nội</option>
                                <option value="3">Đà Lạt</option>
                                <option value="4">Đà Nẵng</option>
                            </select>
                        </div>
                    </div>

                    <!-- type -->
                    <div class="form-group">
                        <div class="form_add_catalog__type col-md-6">
                            <label for="type" class="form-label">Loại khách sạn</label>
                            <input type="text" class="form-control" id="type" name="newCategoryName" required>
                        </div>
                    </div>
                    <!-- submit -->
                    <div class="form-group">
                        <div class="form__submit col-md-1 align-self-end">
                            <button type="submit" class="btn btn-primary">THÊM</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>