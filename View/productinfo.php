<?php
$product = new product();
$review = new review();
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 1;
$relateProduct = $product->getrRelateProduct($category_id);
$result = $product->getProductDetail($id);
$images = $product->getImageProduct($id);
$reviewQty = $review->countReviews($result['product_id']);
?>

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Default</li>
            </ol>

            <nav class="product-pager ml-auto" aria-label="Product">
                <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-left"></i>
                    <span>Prev</span>
                </a>

                <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
            </nav>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <form action="index.php?action=cart&act=cart_action" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="row">
                                    <figure class="product-main-image">
                                        <img id="product-zoom" src="./content/images/products/<?php echo $result['default_image_path']; ?>" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    </figure><!-- End .product-main-image -->

                                    <div id="product-zoom-gallery" class="product-image-gallery">
                                        <a class="product-gallery-item active" href="#" data-image="./content/images/products/<?php echo $result['default_image_path']; ?>">
                                            <img src="./content/images/products/<?php echo $result['default_image_path']; ?>" alt="product side">
                                        </a>

                                        <?php
                                        while ($image = $images->fetch()) :
                                        ?>
                                            <a class="product-gallery-item" href="#" data-image="./content/images/products/<?php echo $image['image_path']; ?>">
                                                <img src="./content/images/products/<?php echo $image['image_path']; ?>" alt="product cross">
                                            </a>

                                        <?php endwhile; ?>
                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .row -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">

                            <div class="product-details">
                                <h1 class="product-title"><?php echo $result['name']; ?></h1><!-- End .product-title -->

                                <div class="ratings-container">
                                    <!-- <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div>
                                </div> -->
                                    <!-- End .ratings -->
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( <?php echo $result['view_count']; ?> Views)</a>
                                </div><!-- End .rating-container -->

                                <div class="product-price">
                                    $<?php echo number_format($result['price']); ?>
                                </div><!-- End .product-price -->

                                <div class="product-content">
                                    <p><?php echo $result['description']; ?> </p>
                                </div><!-- End .product-content -->


                                <div class="details-filter-row details-row-size">
                                    <input type="hidden" name="id" value="<?php echo $result['product_id']; ?>" />
                                    <label for="quantity">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                    </div>
                                </div><!-- End .details-filter-row -->

                                <div class="product-details-action">
                                    <button type="submit" href="#" class="btn-product btn-cart"><span>add to cart</span></button>
                                </div><!-- End .product-details-action -->

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <a href="#"><?php echo $result['category_name']; ?></a>,
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (<?php echo $reviewQty['total_reviews'] ?>)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Product Information</h3>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. </p>
                            <ul>
                                <li>Nunc nec porttitor turpis. In eu risus enim. In vitae mollis elit. </li>
                                <li>Vivamus finibus vel mauris ut vehicula.</li>
                                <li>Nullam a magna porttitor, dictum risus nec, faucibus sapien.</li>
                            </ul>

                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. </p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <h3>Information</h3>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

                            <h3>Fabric & care</h3>
                            <ul>
                                <li>Faux suede fabric</li>
                                <li>Gold tone metal hoop handles.</li>
                                <li>RI branding</li>
                                <li>Snake print trim interior </li>
                                <li>Adjustable cross body strap</li>
                                <li>Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                            </ul>

                            <h3>Size</h3>
                            <p>one size</p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Delivery & returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3>Reviews (<?php echo $reviewQty['total_reviews'] ?>)</h3>
                            <?php
                            $content = $review->selectReview($result['product_id']);
                            while ($set = $content->fetch()) :
                            ?>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#"><?php echo $set['customer_name'] ?> </a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date"><?php echo $set['review_date'] ?></span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4><?php echo $set['review_title'] ?></h4>

                                            <div class="review-content">
                                                <p><?php echo $set['review_content'] ?></p>
                                            </div><!-- End .review-content -->

                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->
                            <?php endwhile ?>
                            <div class="review">
                                <?php if (!isset($_SESSION['user'])) { ?>
                                    <form action="index.php?action=signup" method="get">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <input type="hidden" name="review">
                                            <input type="submit" class="btn btn-primary  me-md-2" value="Login to add review" name="submit">
                                        </div>
                                    </form>
                            </div>

                        <?php } else { ?>
                            <form action="index.php?action=review" method="post">
                                <div class="row no-gutters">
                                    <input type="hidden" value="<?php echo $result['product_id'] ?>" name="txtProductId">
                                    <div class="col-auto">
                                        <h4><a href="#">John Doe</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="review title" name="txtReviewTitle">
                                        <div class="review-content">
                                            <textarea id="" class="form-control" cols="30" rows="2" placeholder="review content" name="content">

                                                    </textarea>
                                        </div><!-- End .review-content -->
                                    </div><!-- End .col-auto -->

                                </div><!-- End .row -->

                            </form>
                        <?php } ?>

                        </div><!-- End .review -->
                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div>
        <!-- End .product-details-tab -->

        <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
            <?php
            while ($set = $relateProduct->fetch()) :
            ?>
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-new">New</span>
                        <a href="index.php?action=productinfo&id=<?php echo $set['product_id']; ?>&category_id=<?php echo $set['category_id']; ?>">
                            <img src="./content/images/products/<?php echo $set['default_image_path']; ?>" alt="Product image" class="product-image">
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
                            <a href="#"><?php echo $set['category_name']; ?></a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="index.php?action=productinfo&id=<?php echo $set['product_id']; ?>&category_id=<?php echo $set['category_id']; ?>"><?php echo $set['name']; ?></a></h3><!-- End .product-title -->
                        <div class="product-price">
                            Price: $<?php echo $set['price']; ?>
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <span class="ratings-text">( <?php echo $set['view_count']; ?> Views )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-nav product-nav-thumbs">

                            <a href="#" class="active">
                                <img src="./content/images/products/<?php echo $set['default_image_path']; ?>" alt="product desc">
                            </a>
                            <?php
                            $imageRelate = $product->getImageProduct($set['product_id']);
                            while ($set1 = $imageRelate->fetch()) :
                            ?>
                                <a href="#">
                                    <img src="./content/images/products/<?php echo $set1['image_path']; ?>" alt="product desc">
                                </a>
                            <?php endwhile; ?>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
            <?php endwhile ?>
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->