<?php if (!isset($_SESSION['user'])) :
	echo "<script>alert(User, you need to log in to checkout) </script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?action=signup"/>';
elseif (!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) :
	echo "<script>alert(Your cart is empty) </script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?action=category"/>';
else : ?>
	<main class="main">
		<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
			<div class="container">
				<h1 class="page-title">Checkout<span>Shop</span></h1>
			</div><!-- End .container -->
		</div><!-- End .page-header -->
		<nav aria-label="breadcrumb" class="breadcrumb-nav">
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Shop</a></li>
					<li class="breadcrumb-item active" aria-current="page">Checkout</li>
				</ol>
			</div><!-- End .container -->
		</nav><!-- End .breadcrumb-nav -->
		<div class="page-content">
			<div class="checkout">
				<div class="container">
					<div class="checkout-discount">
						<form action="#">
							<input type="text" class="form-control" required id="checkout-discount-input">
							<label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
						</form>
					</div><!-- End .checkout-discount -->
					<form  action="index.php?action=checkout&act=checkout_successful" method="post">
						<div class="row">

							<div class="col-lg-9">
								<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
								<label>Receiver *</label>
								<input type="text" class="form-control" name="receiver" placeholder="Name" required>

								<label>Receive Address *</label>
								<input type="text" class="form-control" name="receive_address" placeholder="Address" required>

								<label>Receiver Phone *</label>
								<input type="text" class="form-control" name="receiver_phone" placeholder="+0123456789"  required>

								<label>Order notes (optional)</label>
								<textarea class="form-control" name="invoice_note" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
							</div><!-- End .col-lg-9 -->
							<aside class="col-lg-3">
								<div class="summary">
									<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

									<table class="table table-summary">
										<thead>
											<tr>
												<th>Product</th>
												<th>Total</th>
											</tr>
										</thead>

										<tbody>
										<?php
                                        $j = 0;
                                        foreach ($_SESSION['cart'] as $key => $cart) {
                                            $j++;
                                        ?>
											<tr>
												<td><a href="#"><?php echo $cart['name']?><b><?php echo ' x'.$cart['quantity'] ?></b> </a></td>
												<td>$<?php echo $cart['last_price']; ?></td>
											</tr>

											</tr>
                                        <?php } ?>
											<tr class="summary-subtotal">
												<td>Subtotal:</td>
												<td>$<?php $gh = new cart();
                                                    echo $gh->subTotal(); ?></td>
											</tr><!-- End .summary-subtotal -->
											<tr>
												<td>Shipping:</td>
												<td>Free shipping</td>
											</tr>
											<tr class="summary-total">
												<td>Total:</td>
												<td>$<?php $gh = new cart();
                                                    echo $gh->subTotal(); ?></td>
											</tr><!-- End .summary-total -->
										</tbody>
									</table><!-- End .table table-summary -->

									<button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
										<span class="btn-text">Place Order</span>
										<span class="btn-hover-text">Proceed to Checkout</span>
									</button>
								</div><!-- End .summary -->
							</aside><!-- End .col-lg-3 -->
					</form>
				</div><!-- End .row -->
			</div><!-- End .container -->
		</div><!-- End .checkout -->
		</div><!-- End .page-content -->

	</main><!-- End .main -->
<?php endif ?>
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>