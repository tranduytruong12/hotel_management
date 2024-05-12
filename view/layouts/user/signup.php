<?php
session_start();
/*
$username = isset($_SESSION['signup-data']['username']) ? $_SESSION['signup-data']['username'] : null;
$email = isset($_SESSION['signup-data']['email']) ? $_SESSION['signup-data']['email'] : null;
$password = isset($_SESSION['signup-data']['password']) ? $_SESSION['signup-data']['password'] : null;

*/
// $confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
unset($_SESSION['signup-data']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Icon -->
    <link rel="stylesheet" href="../view/assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../view/assets/css/authen.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>FiveChickens</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,900;1,100;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main d-flex justify-content-center">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content d-flex align-items-center">
                    <div class="signup-form">
                        <h2 class="form-title">Đăng ký</h2>
                        <!-- <h2>Lỗi</h2> -->
                        <!-- <?php if (isset($_SESSION['signup'])) : ?>
                            <div class="alert alert-danger p-3">

                                <?=
                                $_SESSION['signup'];
                                unset($_SESSION['signup']);
                                ?>
                            </div>
                        <?php endif ?> -->
                        <!-- <div class="alert alert-danger px-4">
                            Mật khẩu đã sai
                        </div> -->
                        <form method="POST" class="register-form" id="register-form" action="">
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="Username"  />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email"  />
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" placeholder="Mật khẩu"  />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="confirmpassword" placeholder="Nhập lại mật khẩu" />
                            </div>
                            <div class="form-group form-button d-flex flex-column align-items-center">
                                <input type="submit" name="signup" id="signup" class="form-submit mb-lg-3" value="Đăng ký" />
                                <a href="?controller=user&&action=signin" class="signup-image-link">Đã có tài khoản ?</a>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../view/assets/img/Fashion-Instagram-Story-11.jpg" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>



    </div>

    <!-- JS -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script src="../view/assets/js/main.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>