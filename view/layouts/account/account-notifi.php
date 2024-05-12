
    <div class="container mt-3 w-75">
        <div class="account__information">
            <div class="account__information-title d-flex justify-content-center">
                <h2>DANH SÁCH THÔNG BÁO</h2>
            </div>
            <div class="account__information-detail d-flex justify-content-between align-items-start mt-2">
                <div class="user d-flex flex-column justify-content-center p-5 w-25">
                <div class="user__avatar d-flex align-items-center flex-column justify-center text-center">
                    <img src="../view/assets/img/avatar/avatar9.jpg">
                    <h3>Xin chào</h3>
                    <p>Nguyen Tho </p>
                </div>
                    <div class="user__menu mt-3">
                        <li>
                            <i class="bi bi-person"></i>
                            <a href="?account">Thông tin tài khoản</a>
                        </li>
                        <li>
                            <i class="bi bi-menu-button-wide"></i>
                            <a href="?account&&action=manage">Quản lý đơn hàng</a>
                        </li>
                        <li>
                            <i class="bi bi-map"></i>
                            <a href="?account&&action=maps">Danh sách địa chỉ</a>
                        </li>
                        <li>
                            <i class="bi bi-bell"></i>
                            <a href="?account&&action=notifi">Danh sách thông báo</a>
                        </li>
                        <li>
                            <i class="bi bi-box-arrow-in-right"></i>
                            <a href="?controller=user&&action=logout">Đăng xuất</a>
                        </li>
                    </div>
                </div>
                <div
                    class="user__infor flex-fill bd-highligh p-3 d-flex flex-column justify-content-center align-items-center w-75">
                    <div class="user__infor-detail d-flex flex-column justify-content-center align-items-center">
                        <h3>Thông báo của bạn</h3>
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Xóa</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Đơn hàng <span>#123456</span></td>
                                <td>Đơn hàng đã được giao thành công vào <span>12/2/2023</span></td>
                                <td class="d-flex justify-content-center">
                                    <a href="">
                                        <i class="bi bi-x text-danger">
                                        </i>
                                    </a>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <td>Đơn hàng <span>#123456</span></td>
                                <td>Đơn hàng đã được xác nhận</td>
                                <td class="d-flex justify-content-center">
                                    <a href="">
                                        <i class="bi bi-x text-danger">
                                        </i>
                                    </a>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td>Đơn hàng <span>#123456</span></td>
                                <td>Đơn hàng đang được giao đến chỗ bạn</td>
                                <td class="d-flex justify-content-center">
                                    <a href="">
                                        <i class="bi bi-x text-danger">
                                        </i>
                                    </a>
                                </td>
                              </tr>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
