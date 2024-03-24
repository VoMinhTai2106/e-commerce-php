<script>
    $(document).ready(function () {
        // Register tab click event
        $('#register-tab-2').on('click', function () {
            // Change breadcrumb text to "Register"
            $('.breadcrumb-item.active').text('Register');
        });

        // Sign In tab click event
        $('#signin-tab-2').on('click', function () {
            // Change breadcrumb text to "Login"
            $('.breadcrumb-item.active').text('Login');
        });
    });
</script>
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Pages</a></li>
				<li class="breadcrumb-item active" aria-current="page">Login</li>
			</ol>
		</div><!-- End .container -->
	</nav><!-- End .breadcrumb-nav -->

	<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
		<div class="container">
			<div class="form-box">
				<div class="form-tab">
					<ul class="nav nav-pills nav-fill" role="tablist">
						<li class="nav-item">
							<a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
							<form action="index.php?action=signup&act=signin_action" method="post">
								<div class="form-group">
									<label for="singin-email-2">Username *</label>
									<input type="text" class="form-control" id="singin-email-2" name="txtUsername" required>
								</div>
								<div class="form-group">
									<label for="singin-password-2">Password *</label>
									<input type="password" class="form-control" id="singin-password-2" name="txtPassword" required>
								</div><!-- End .form-group -->

								<div class="form-footer">
									<button type="submit" class="btn btn-outline-primary-2" name="sendToLogin">
										<span>LOG IN</span>
										<i class="icon-long-arrow-right"></i>
									</button>

									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="remember-my" class="custom-control-input" id="signin-remember-2">
										<label class="custom-control-label" for="signin-remember-2">Remember Me</label>
									</div><!-- End .custom-checkbox -->

									<a href="#" class="forgot-link">Forgot Your Password?</a>
								</div><!-- End .form-footer -->
							</form>
							<!-- End .form-choice -->
						</div><!-- .End .tab-pane -->
						<div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
							<form action="index.php?action=signup&act=signup_action" method="post">
								<div class="form-group">
									<label for="name">Your name:</label>
									<input type="text" class="form-control" id="name" name="txtCustomerName" required>
								</div><!-- End .form-group -->
								<div class="form-group">
									<label for="register-email-2">Your email address :</label>
									<input type="email" class="form-control" id="register-email-2" name="txtEmail" required>
								</div><!-- End .form-group -->
								<div class="form-group">
									<label for="address">Address:</label>
									<input type="text" class="form-control" id="address" name="txtAddress" required>
								</div><!-- End .form-group -->
								<div class="form-group">
									<label for="address">Phone:</label>
									<input type="text"class="form-control" id="address" name="txtPhone" required>
								</div>
								<div class="form-group">
									<label for="username">Username:</label>
									<input type="text" class="form-control" id="username" name="txtUsername" required>
								</div><!-- End .form-group -->
								<div class="form-group">
									<label for="register-password-2">Password :</label>
									<input type="password" class="form-control" id="register-password-2" name="txtPassword" required>
								</div><!-- End .form-group -->
								<div class="form-group">
									<label for="repassword">Re Password :</label>
									<input type="password" class="form-control" id="repassword"  required>
								</div>
								<input type="hidden" name="submit" value="1">
								<div class="form-footer">
									<button type="submit" class="btn btn-outline-primary-2">
										<span>SIGN UP</span>
										<i class="icon-long-arrow-right"></i>
									</button>

									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="register-policy-2" required>
										<label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
									</div><!-- End .custom-checkbox -->
								</div><!-- End .form-footer -->
							</form>
							<!-- <div class="form-choice">
								<p class="text-center">or sign in with</p>
								<div class="row">
									<div class="col-sm-6">
										<a href="#" class="btn btn-login btn-g">
											<i class="icon-google"></i>
											Login With Google
										</a>
									</div>
									<div class="col-sm-6">
										<a href="#" class="btn btn-login  btn-f">
											<i class="icon-facebook-f"></i>
											Login With Facebook
										</a>
									</div>
								</div>
							</div> -->
						</div><!-- .End .tab-pane -->
					</div><!-- End .tab-content -->
				</div><!-- End .form-tab -->
			</div><!-- End .form-box -->
		</div><!-- End .container -->
	</div><!-- End .login-page section-bg -->
</main><!-- End .main -->