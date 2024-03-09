<?php
session_start();
require_once '../Model/cart.php'; // Thay đổi đường dẫn và tên file nếu cần

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $newQuantity = $_POST['quantity'];
    
    // Gọi hàm cập nhật sản phẩm từ class cart
    $cart = new cart();
    $cart->updateProduct($id, $newQuantity);

    // Trả về thông báo hoặc dữ liệu cần thiết cho client
    echo "Update successful"; // Thay đổi nếu cần
    echo $cart->subTotal();
    echo $_POST['id'];
    echo $_POST['quantity'];
    print_r($_POST);
    print_r($_SESSION['cart']);
}
?>
