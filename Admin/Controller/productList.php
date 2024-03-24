<?php
$act = $_GET['act'] ?? '';
switch ($act) {
    case 'unactive':
        $changeActive=new productModel();
        $changeActive->ChangeActive($_GET['productId']);
        echo '<meta http-equiv="refresh" content="0;url=index.php?action=productList"/>';
        break;
    default:
        include_once "./View/ProductManage/ProductList.php";
        break;
}
