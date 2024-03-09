<?php
function changeCurrentPage($current)
{
    global $currentPage;
    $currentPage = $current;
    return $currentPage;
}

require_once '../Model/connect.php';
require_once '../Model/product.php';
if (isset($_POST['action'])) {
    // Default action
    $query = "SELECT * FROM products JOIN categories ON categories.category_id=products.category_id WHERE stock_quantity > 0 ";

    // category filter
    if (isset($_POST['category'])) {
        $category_filter = implode("','", $_POST['category']);
        $query .= " AND category_name IN('" . $category_filter . "')";
    }

    // price filter
    if (isset($_POST['minimum_price'], $_POST['maximum_price']) && !empty($_POST['minimum_price']) && !empty($_POST['maximum_price'])) {
        $query .= " AND price BETWEEN " . $_POST['minimum_price'] . " AND " . $_POST['maximum_price'];
    }

    // search filter
    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        $query .= " AND name LIKE '%" . $search . "%'";
    }

    // order by
    if (isset($_POST['condition'])) {
        switch ($_POST['condition']) {
            case 'id':
                $query .= " ORDER BY product_id DESC";
                break;
            case 'ascendingPrice':
                $query .= " ORDER BY price ASC";
                break;
            case 'descendingPrice':
                $query .= " ORDER BY price DESC";
                break;
            case 'Popularity':
                $query .= " ORDER BY sold_quantity DESC";
                break;
        }
    }

    $db = new connect();
    $product = new product();

    $stmt = $db->execP($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $count = $stmt->rowCount();
    $output = '';

    // Pagination
    $itemPerPage = 8;
    $totalPages = ceil($count / $itemPerPage);
    echo $totalPages;

    $currentPage = 1;
    changeCurrentPage($currentPage);
    $offset = ($currentPage - 1) * $itemPerPage;
    $queryAfterPagination = $query . " LIMIT " . $itemPerPage . " OFFSET " . $offset;
    $stmtAfterPagination = $db->execP($queryAfterPagination);
    $stmtAfterPagination->execute();
    $resultAfterPagination = $stmtAfterPagination->fetchAll();

    echo $queryAfterPagination;

    if ($count > 0) {
        foreach ($resultAfterPagination as $value) {
            $output .= '
            <div class="col-6 col-md-4 col-lg-4 col-xl-3 ">
                <div class="product product-7 text-center border border-1">
                    <figure class="product-media">
                        <span class="product-label label-new">New</span>
                        <a href="index.php?action=productinfo&id=' . $value['product_id'] . '&category_id=' . $value['category_id'] . '">
                            <img src="./content/images/products/' . $value['default_image_path'] . '" alt="Product image" class="product-image imageChange">
                        </a>
                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="index.php?action=productinfo&id=' . $value['product_id'] . '&category_id=' . $value['category_id'] . '"></a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="index.php?action=productinfo&id=' . $value['product_id'] . '&category_id=' . $value['category_id'] . '">' . $value['name'] . '</a></h3><!-- End .product-title -->
                        <div class="product-price">';
                        
            // Check if the sale price is set
            if ($value['sale'] > 0) {
                $output .= 'Price: $<strike>' . $value['price'] . '</strike> Current Price: $' . ceil($value['sale']*$value['price'])/100;
            } else {
                $output .= 'Price: $' . $value['price'];
            }

            $output .= '</div><!-- End .product-price -->
                        <div class="ratings-container">
                            <span class="ratings-text">Stock ' . $value['stock_quantity'] . '</span>
                        </div><!-- End .rating-container -->
                        <div class="product-nav product-nav-thumbs">';

            $imageRelate = $product->getImageProduct($value['product_id']);
            while ($set1 = $imageRelate->fetch()) {
                $output .= '
                            <a href="#">
                                <img src="./content/images/products/' . $set1['image_path'] . '" alt="product desc">
                            </a>';
            }

            $output .= '</div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
            </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->';
        }
    } else {
        $output = '<h3>No matching products found.</h3>';
    }

    $result_data = '
    <div class="products mb-3">
        <div class="row justify-content-center" >' . $output . '</div>
    </div> 
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                </a>
            </li>';

    for ($num = 1; $num <= $totalPages; $num++) {
        $result_data .= '<li class="page-item"><a class="page-link" onclick="changeCurrentPage(' . $num . ')" >' . $num . '</a></li>';
    }

    $result_data .= '
            <li class="page-item-total">of ' . $totalPages . '</li>
            <li class="page-item">
                <a class="page-link page-link-next" href="#" aria-label="Next">
                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                </a>
            </li>
        </ul>
    </nav>';

    echo $result_data;
}
?>
