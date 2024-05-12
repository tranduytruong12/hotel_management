<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../view/assets/css/authen.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Login or Signup</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,900;1,100;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>


<body>
    <div class="main d-flex justify-content-center">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content align-items-center">
                    <div class="signin-image">
                        <figure><img src="../view/assets/img/login.png" alt="sign up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Đăng nhập</h2>
                        <!-- <div class="alert alert-danger px-4">
                            Mật khẩu đã sai
                        </div> -->
                        <!-- <h3>lỗi</h3> -->
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username_email" placeholder="Username hoặc Email" />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" placeholder="Mật khẩu" />
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Ghi nhớ đăng nhập
                                    </label>
                            </div> -->
                            <div class="form-group form-button d-flex flex-column align-items-center">
                                <input type="submit" name="signin" id="signin" class="form-submit mb-lg-3" value="Đăng nhập" />
                                <a href="?controller=user&&action=signup" class="signup-image-link" id="link__authen">Chưa có tài khoản ?</a>
                            </div>
                        </form>
                        <!-- <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <?php
        if (!isset($_COOKIE['Cookieid'])) {
            if (isset($_POST['signin'])) {
                $userModel = new UserModel();
                $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $error = "";

                if (strlen($username_email) === 0) {
                    $error = 'Chưa nhập Email hoặc Username';
                } elseif (strlen($password) < 1) {
                    $error = 'Chưa nhập mật khẩu';
                } else {
                    $res = $userModel->checkExists($username_email, $username_email);
                    if (mysqli_num_rows($res) == 1) {
                        // echo "Da có tai tai khoan";
                        $user_record = mysqli_fetch_assoc($res);
                        $db_password = $user_record['password'];
                        setcookie('Cookieid', $user_record['id'], time() + (864000 * 30), "/");
                        if (password_verify($password, $db_password)) {

                            $_SESSION['user-id'] = $user_record['id'];
                            /**/
                            // set session
                            if ($user_record['role'] == '1') {
                                $_SESSION['user_is_admin'] = true;
                                header('Location: ' . '.');
                                return;
                            }
                        } else {
                            $error = "Mật khẩu không chính xác";
                        }
                    } else {
                        $error = "Tài khoản hoặc email không tồn tại";
                    }
                }

                if ($error) { // Có lỗi xảy ra
                    // $_SESSION['signup-data'] = $_POST;
                    echo '<script type="text/javascript">toastr.error("' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '")</script>';
                } else {

                    // echo '<script type="text/javascript">toastr.success("Bạn đã đăng nhập thành công")</script>';
                    header('Location: ' . '.');
                    die();
                }
            }
        }
        ?>
    </div>

    <script src="../view/assets/js/main.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <!-- JS -->
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>