<?php
$act = 'signup';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'signup':
        include_once './View/signup.php';
        break;
    case 'signup_action':
        $customerName = '';
        $address = '';
        $phone = '';
        $username = '';
        $email = '';
        $password = '';
        if (isset($_POST['submit']) && $_POST['submit'] == 1) {
            $customerName = $_POST['txtCustomerName'];
            $address = $_POST['txtAddress'];
            $phone = $_POST['txtPhone'];
            $username = $_POST['txtUsername'];
            $email = $_POST['txtEmail'];
            $password = $_POST['txtPassword'];
            $saltF = 'G456#@';
            $saltL = 'Fa34%!';
            $passNew = md5($saltF . $password . $saltL);
            $kh = new user();
            $check = $kh->getCheckUser($username, $password)->rowCount();
            if ($check > 0) {
                echo '<script> alert("Username hoặc email đã tồn tại") </script>';
                include_once './View/signup.php';
            } else {
                $data = [
                    'customerName' => $customerName,
                    'username' => $username,
                    'password' => $passNew,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                ];
                $newkh = $kh->insertCustomer($data);
                if ($newkh !== false) {
                    echo '<script> alert("Đăng ký thành công");</script>';
                    include_once './View/signup.php';
                    print_r($data);
                } else {
                    echo '<script> alert("Sign Up Su);</script>';
                    include_once './View/sigunp.php';
                }
            }
        }
        break;
    case 'signin_action':
        /// thông tin qua đây, username, pass
        if (isset($_POST['sendToLogin'])){
        $user = isset($_POST['txtUsername']) ? $_POST['txtUsername']:""; 
        $pass = isset($_POST['txtPassword']) ? $_POST['txtPassword']:""; 
        $saltF = 'G456#@';
        $saltL = "Fa34%!";
        $passnew = md5($saltF . $pass . $saltL);
        $kh = new user();
        $logkh = $kh->logCustomer($user, $passnew);
        if ($logkh) {
            $_SESSION['user']['customer_id'] = $logkh['customer_id'];
            $_SESSION['user']['customer_name'] = $logkh['customer_name'];
            echo '<script> alert("Đăng nhập thành công"); </script>';
            if (!isset($_SESSION['cart'])) {  
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
            }else{
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=checkout"/>';
            }
        } else {
            $logAdmin= $kh->logAdmin($user, $pass);
            if ($logAdmin) {
                $_SESSION['admin']['adminId']=$logAdmin['id'];
                echo '<meta http-equiv="refresh" content="0;url=./Admin/index.php"/>';
            }else{
                echo '<script> alert("Đăng nhập không thành công"); </script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=signup"/>';
            }
        }
    }
        break;
        case 'logout':
            unset($_SESSION['user']);
            echo '<meta http-equiv="refresh" content="0;url=index.php?action=home"/>';
            break;
    default:
        include_once './View/signup.php';
        break;
}
