<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Grid 4 Columns<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav --> 
<input type="hidden" id="search" value="<?php echo (isset($_POST['search']))?$_POST['search']:'';?>">
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>9 of 56</span> Products
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->
                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option value="id" id="date" selected="selected">Date</option>
                                        <option value="popularity" id="popularity">Most Popular</option>
                                        <option value="ascendingPrice" id="ascendingPrice">Ascending Price</option>
                                        <option value="descendingPrice" id="descendingPrice">Descending Price</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->
                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <!--data-->
                    <section id="filter_data">
                    </section>

                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="#" class="sidebar-filter-clear">Clean All</a>
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible category">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Category
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                        <?php
                                        $category = new Productfilter();
                                        $result = $category->getAllCategories();
                                        while ($set = $result->fetch()) :
                                        ?>
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input common_select category select_clear_all" id="cat-<?php echo $set['category_id']; ?>" value="<?php echo $set['category_name']; ?>">
                                                    <label class="custom-control-label" for="cat-<?php echo $set['category_id']; ?>"><?php echo $set['category_name']; ?></label>
                                                </div><!-- End .custom-checkbox -->
                                                <span class="item-count"><?php echo $set['productqty_of_category']; ?></span>
                                            </div><!-- End .filter-item -->
                                        <?php endwhile ?>
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                    Price
                                </a>
                            </h3><!-- End .widget-title -->
                            <div class="collapse show" id="widget-5">
                                <div class="widget-body">
                                    <div class="filter-price">
                                        <div class="list-group">
                                            <input type="hidden" id="hidden_minimum_price" value="100">
                                            <input type="hidden" id="hidden_maximum_price" value="10000">
                                            <div class="filter-price-text">
                                                <p id="price_show">Price Range: From 0$ - 10000$</p>
                                            </div><!-- End .filter-price-text -->
                                            <div id="price_range"></div>
                                        </div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->