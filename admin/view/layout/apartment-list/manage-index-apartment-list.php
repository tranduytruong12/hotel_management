<!-- main wrapper -->
<div class="main_wrapper d-flex flex-row">
    <!-- side navigate wrapper -->
    <div class="sidenav text-wrap p-0 m-0">
        <nav class="nav nav-pills flex-column text-center p-0 m-0">
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " aria-current="page" href="../app/index.php?">Dashboard</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=category">Danh mục khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 active" href="../app/index.php?page=apartment-list">Danh sách
                khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=add-apartment">Thêm khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=add-room">Thêm phòng khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=manage">Quản lý phòng đặt</a>
        </nav>
    </div>

    <!-- list apartment main content wrapper -->
    <div class="apartmentlist_main  container-fluid bg-light">

        <div class="apartmentlist_content_header">
            <!-- mot phan cua apartment main content header gom: tieu de va nut them san pham -->
            <div class="filter_header_one p-2 mx-0 d-flex flex-row flex-wrap justify-content-between align-content-center">
                <div class="mx-4 mt-2 mb-1">
                    <h6 class="m-0">DANH SÁCH KHÁCH SẠN</h6>
                </div>
                <a href="index.php?page=add-apartment" type="button" class="btn btn-sm btn-primary mx-4 rounded-4">Thêm khách sạn</a>
            </div>

            <!-- phan con lai cua apartment main content header gom: tim  kiem va select   -->
            <div id="filter_header_two" class="p-2 mx-0 d-flex flex-row flex-wrap justify-content-between align-content-center">
                <div class="apartmentlist_filter__search mx-4">
                    <form action="index.php?" method="get">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="page" value="apartment-list">
                            <input type="search" id="inputForSearchapartment" name="Searchapartment" class="form-control" placeholder="Nhập tên khách sạn" aria-label="search apartment name">
                            <button type="submit" class="btn btn-secondary">FIND</button>
                        </div>
                    </form>
                </div>

                <div class="apartmentlist_filter__sort mx-4">
                    <form id="sortForm" action="index.php?page=apartment-list" method="post">
                    <select id="sortSelect" class="form-select form-select-sm" aria-label="Sort by" name="sort">
                        <option unselected>Xắp xếp theo</option>
                        <option value="1">Mã tăng dần</option>
                        <option value="2">Mã giảm dần</option>
                        <option value="3">Tên A -> Z</option>
                        <option value="4"> Tên: Z -> A</option>
                    </select>
                    </form> 
                </div>
            </div>
        </div>
        <script>
        document.getElementById("sortSelect").addEventListener("change", function() {
        document.getElementById("sortForm").submit();
            });
        </script>
        <!-- danh sach san pham -->
        <div class="apartmentlist">
            <div class="table-responsive text-center mb-1">
                <table class="apartmenttable table
                        table-hover	
                        align-middle
                        table-sm mb-1">
                    <thead class="table-secondary table-sm">
                        <tr>
                            <th class="text-center" style="width: 50px;">Mã</th>
                            <th>Tên khách sạn</th>
                            <th class="text-center">Địa điểm</th>
                            <th class="text-center">Loại</th>
                            <th class="text-center">Đánh giá (sao)</th>
                            <th style="width: 150px;" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="apartmenttable__body">
                        <?php foreach ($apartmentList as $apartment) {
                            $category = $categoryObj->get_category_by_id($apartment['category_id']);
                            $location_name = $categoryObj->get_location_with_id($category['location_id']);
                            $rating = $apartmentObj->get_rate_by_id($apartment['id']);
                        ?>
                            <tr class="table__row">
                                <td class="text-center">
                                    <?php echo $apartment['id'] ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $apartment['name'] ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $location_name ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $category['catagory_name'] ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $rating ?>
                                </td>

                                <td style="width: 300px;" class="text-center">
                                    <a href="index.php?page=apartment-list&view=<?php echo $apartment['id'] ?>" type="button" class="checkapartment btn btn-sm btn-primary ms-0 m-1">
                                        XEM
                                    </a>
                                    <a href="index.php?page=apartment-list&edit=<?php echo $apartment['id'] ?>" type="button" class="update_info_apartment btn btn-sm btn-warning me-0 m-1">
                                        SỬA
                                    </a>
                                    <a href="index.php?page=apartment-list&dele=<?php echo $apartment['id'] ?>" type="button"
                                        class="update_info_apartment btn btn-sm btn-danger me-0 m-1">
                                        XÓA
                                    </a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                <?php if (empty($apartmentList)) {
                    echo "<div><h6>Không có khách sạn nào được tìm thấy</h6></div>";
                } ?>
                <div hidden class="mt-1">
                    <div>Pagination</div>
                </div>
            </div>
        </div>
    </div>
</div>