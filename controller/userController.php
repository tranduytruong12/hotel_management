<?php
class User
{

    public function __construct()
    {

        // require('../model/userModel.php');

        // self::signup();

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            switch ($action) {
                case "signup": {
                        $this->signup();
                        break;
                    }
                case "signin": {
                        //  include('../view/user/header.php');
                        if (!isset($_COOKIE['Cookieid'])) {
                            $this->signin();
                            break;
                        } else {
                            header("location:" . '.');
                        }
                    }
                case 'logout': {
                        echo "123";
                        $this->logout();
                        break;
                    }
                default : {
                    header("location:" . '.');
                    break;
                }
            }
        }

        /*
        if (isset($_POST['signup'])) {
            self::signup();
        }

        if (isset($_POST['signin'])) {
            self::signin();
        }*/
    }

    public function signup()
    {
        include_once "../view/layouts/authentication/signup.php";
        if (isset($_POST['signup'])) {
            $userModel = new UserModel();
            $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $passwordConfirm = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $error = "";
            if (!($username)) {
                $error = "Yêu cầu nhập tên tài khoản cần đăng ký";
            } else if (!($email)) {
                $error = "Yêu cầu nhập email cần đăng ký";
            } else if (!($password)) {
                $error = "Yêu cầu nhập mật khẩu cần đăng ký";
            } else if (!($passwordConfirm)) {
                $error = "Yêu cầu nhập lại mật khẩu cần đăng ký";
            } else {
                // Everything is okay

                if ($password !== $passwordConfirm) {
                    $error = "Mật khẩu không trùng khớp";
                }
                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                $res = $userModel->checkExists($username, $email);
                if (mysqli_num_rows($res) > 0) {
                    // echo "Da ton tai tai khoan";
                    $error = "Tài khoản hoặc email đã tồn tại";
                }
            }
            if ($error) { // Có lỗi xảy ra
                // $_SESSION['signup-data'] = $_POST;
                echo '<script type="text/javascript">toastr.error("' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '")</script>';
            } else {
                $userModel->signup($username, $hash_password, $email);
                echo '<script type="text/javascript">toastr.success("Bạn đã đăng ký thành công")</script>';
                die();
            }
        }
    }
    public function signin()
    {

        include_once "../view/layouts/authentication/login.php";

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
                    if (password_verify($password, $db_password)) {
                        /*
                    $_SESSION['user-id'] = $user_record['id'];
                    // set session
                    if($user_record['is_admin'] == 1) {
                        $_SESSION['user_is_admin'] = true;
                    }   
                               
                    header('Location: '. ROOT_URL . '/admin'); 
                    */
                        if ($user_record['role'] == '1') {
                            $_SESSION['user_is_admin'] = true;
                            header('Location: ' . '../admin/app');
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

    public function logout()
    {
        if (isset($_SESSION['user-id'])) {
            var_dump($_SESSION['user-id']);
            unset($_SESSION['user-id']);
        } else {
            echo "WTF";
        }
        setcookie('Cookieid', '-1', time() - 86400 * 30, '/');
        setcookie('PHPSESSID', '-1', time() - 86400 * 30, '/'); // hơi dơ =))
        include_once "../view/homepage.php";
        header("location:" . './index.php');
    }
}