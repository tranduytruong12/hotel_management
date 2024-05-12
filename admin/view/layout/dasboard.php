<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- main wrapper -->
<div class="main_wrapper d-flex flex-row">

    <!-- side navigate wrapper -->
    <div class="sidenav text-wrap p-0 m-0">
    <nav class="nav nav-pills flex-column text-center p-0 m-0">
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 active" aria-current="page" href="../app/index.php?">Dashboard</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=category">Danh mục khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=apartment-list">Danh sách
                khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4" href="../app/index.php?page=add-apartment">Thêm khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=add-room">Thêm phòng khách sạn</a>
            <a class="nav-link px-3 py-3 px-0 my-2 rounded-4 " href="../app/index.php?page=manage">Quản lý phòng đặt</a>
        </nav>
    </div>

    <!-- ### -->
    <!-- main content wrapper -->
    <!-- to do -->
    <div class="maincontent container-fluid">
        <div class="">
            <div class="sumary p-3 my-1 d-flex flex-row flex-wrap justify-content-xxl-between justify-content-md-around">
                <div class="summary__element border-3 m-1 py-2 px-5 rounded-4">
                    <div class="sumary__header fs-5">
                        <p>Doanh thu</p>
                    </div>
                    <hr>
                    <div class="summary__content fs-3">
                        <p><?php echo $sale; ?> VND</p>
                    </div>
                </div>

                <div class="summary__element border-3 m-1 py-2 px-5 rounded-4">
                    <div class="sumary__header fs-5">
                        <p>Số khách sạn liên kết</p>
                    </div>
                    <hr>
                    <div class="summary__content fs-3">
                        <p><?php echo count($apartment); ?></p>
                    </div>
                </div>
            </div>

            <div class="chart p-3 my-1 d-flex flex-column">
                <div class="chart__header fs-4 ms-3 mb-0 p-0">
                    Biểu đồ doanh thu
                </div>
                <canvas id="myChart" width="1000" height="250"></canvas>
            </div>

            <div class="topsales p-3 m-3 rounded-4">
                <table class="topsales-table table table-hover table-bordered table-responsive">
                    <caption class="caption-top fs-5 ms-2 mt-2">Top 3 khách sạn có doanh thu cao nhất</caption>
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">STT</th>
                            <th scope="col" class="text-center">Tên khách sạn</th>
                            <th scope="col" class="text-center">Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $num_hotels = count($hotel_sales);
                        $num_rows = min(3, $num_hotels);
                        for ($i = 0; $i < $num_rows; $i++) {
                            echo "<tr>";
                            echo "<th scope='row' class='text-center'>" . ($i + 1) . "</th>";
                            echo "<td class='text-center'>" . $hotel_sales[$i]['name'] . "</td>";
                            echo "<td class='text-center'>" . $hotel_sales[$i]['hotel_sales'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            
        </div>
    </div>

    <!-- end main wrapper -->
    <!-- <div class="main_wrapper d-flex flex-row"> -->
    <!-- include head.php -->
</div>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var data = {
        labels: <?php echo json_encode($dates);?>,
        datasets: [{
            label: 'Doanh thu',
            backgroundColor: 'rgb(1, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($sales);?>
        }]
    };
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data
    });
</script>