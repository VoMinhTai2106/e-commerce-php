<?php
$act = $_GET['act'] ?? '';
switch ($act) {
    case "edit":
        
        break;
    default:
        include_once "./View/ProductManage/EditProduct.php";
        break;
}
