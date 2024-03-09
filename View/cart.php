<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các hàng giỏ hàng
        var cartRows = document.querySelectorAll('.cart-row');

        // Lặp qua từng hàng giỏ hàng
        cartRows.forEach(function(cartRow) {
            // Lấy phần tử input số lượng trong hàng giỏ hàng
            var quantityInput = cartRow.querySelector('.quantity-input');

            // Lắng nghe sự kiện thay đổi số lượng
            quantityInput.addEventListener('change', function() {
                // Lấy giá trị số lượng và giá từ hàng giỏ hàng
                var quantity = parseFloat(quantityInput.value);
                var price = parseFloat(cartRow.querySelector('.price-col').innerText.replace('$', ''));

                // Lấy giá trị last_price từ hàng giỏ hàng và loại bỏ ký tự '$'
                var lastPriceString = cartRow.querySelector('.last-price-col').innerText;
                var lastPrice = parseFloat(lastPriceString.replace('$', ''));

                // Tính toán giá mới
                var newLastPrice = quantity * price;

                // Cập nhật giá trị last_price trong hàng giỏ hàng với ký tự '$'
                cartRow.querySelector('.last-price-col').innerText = '$' + newLastPrice.toFixed(2);
                updateSubtotal();
            });

        });

        function updateSubtotal() {
            // Chọn tất cả các phần tử last-price-col
            var lastPriceCols = document.querySelectorAll('.last-price-col');

            var subtotal = 0;

            // Lặp qua từng last-price-col và thêm giá trị dạng float vào tổng cộng
            lastPriceCols.forEach(function(lastPriceCol) {
                var lastPrice = parseFloat(lastPriceCol.innerText.replace('$', ''));
                subtotal += lastPrice;
            });

            // Hiển thị tổng cộng đã cập nhật
            document.querySelector('.summary-subtotal td:last-child').innerText = '$' + subtotal.toFixed(2);
        }
    });
    // update handle
    function updateCartItem(id, newQuantity) {
        console.log('Updating item with ID:', id, 'New Quantity:', newQuantity);
        // Gửi yêu cầu AJAX đến server để cập nhật số lượng và tổng giá trị
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../view/handle_ajax_cart.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Chuẩn bị dữ liệu để gửi lên server
        var data = "id=" + id + "&quantity=" + newQuantity;

        // Xử lý kết quả nhận về từ server
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Cập nhật lại giao diện hoặc làm mới trang nếu cần
                console.log(xhr.responseText); // Hiển thị thông tin từ server (debug)
            }
        };

        // Gửi yêu cầu
        xhr.send(data);
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Lắng nghe sự kiện thay đổi giá trị số lượng
        document.querySelectorAll('.quantity-input').forEach(function(quantityInput) {
            quantityInput.addEventListener('change', function() {
                var id = this.getAttribute('data-id');
                var newQuantity = this.value;

                // Gọi hàm để gửi yêu cầu AJAX
                updateCartItem(id, newQuantity);
            });
        });
    });
</script>



<main class="main">
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <form action="index.php?action=cart&act=cart_update" method="post">
                        <div class="row">
                            <div class="col-lg-9">
                                <table class="table table-cart table-mobile">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $j = 0;
                                        foreach ($_SESSION['cart'] as $key => $cart) {
                                            $j++;
                                        ?>
                                            <tr class=" cart-row">
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="#">
                                                                <img src="./content/images/products/<?php echo $cart['img']; ?>" alt="Product image">
                                                            </a>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a href="#"><?php echo $cart['name'];?></a>
                                                        </h3><!-- End .product-title -->
                                                    </div><!-- End .product -->
                                                </td>
                                                <td class="price-col">$<?php echo $cart['price']; ?></td>
                                                <td class="quantity-col">
                                                    <div class="cart-product-quantity">

                                                        <input type="number" class="form-control quantity-input" value="<?php echo $cart['quantity'] ?>" name="newqty[<?php echo $key; ?>]" min="1" max="<?php echo $cart['stock_qty'] ?>" step="1" data-decimals="0" data-id="<?php echo $key; ?>" required>
                                                    </div><!-- End .cart-product-quantity -->
                                                </td>
                                                <td class="total-col last-price-col">$<?php echo $cart['last_price']; ?></td>
                                                <td class="remove-col"><a href="index.php?action=cart&act=cart_delete&id=<?php echo $key; ?>"><button type="button" class="btn-remove"><i class="icon-close"></i></button></a></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table><!-- End .table table-wishlist -->
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td><?php $gh = new cart();
                                                    echo $gh->subTotal(); ?></td>
                                            </tr><!-- End .summary-subtotal -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->

                                    <a href="index.php?action=checkout" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                </div><!-- End .summary -->

                                <a href="index.php?action=category" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                            </aside><!-- End .col-lg-3 -->

                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    <?php } else {
        echo '<script>alert("Your cart is empty.")</script>';
        echo '<meta http-equiv="refresh" content="0;url=index.php?action=category"/>';
    } ?>
</main><!-- End .main -->