<?php 
// unset($_SESSION['cart']);
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$act = 'cart';
if(isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'cart':
        include_once './View/cart.php';
        break;
    
    case 'cart_action':
        $id = 0;
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];
            $gh = new cart();
            $add = $gh->addCart($id,$quantity);
            echo '<meta http-equiv="refresh" content="0;url=index.php?action=cart"/>';
        }
        break;
    case "cart_delete": 
        if (isset($_GET['id'])) {
            unset($_SESSION['cart'][$_GET['id']]);
            echo '<meta http-equiv="refresh" content="0;url=index.php?action=cart"/>';
        }
        break;
    default:
        include_once './View/cart.php';
        break;
}