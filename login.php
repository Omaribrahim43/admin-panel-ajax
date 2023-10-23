<?php
include('includes/header.php');
include('includes/nav.php');
?>
<div class="row">
	<div class="col-lg-6 offset-lg-3">
		<?php
		display_message();
		validate_user_login();
		?>
	</div>
</div>
<div class="container">
	<div class="row mt-5">
		<div class="col-md-6 mx-auto">
			<div class="card">
				<div class="card-body">
					<form id="login-form" method="post" role="form" style="display: block;">
						<div class="mb-3">
							<label for="register_email">Email Address</label>
							<input type="text" name="email" id="email" class="form-control" tabindex="1" placeholder="Email" required>
						</div>
						<div class="mb-3">
							<label for="password">Password</label>
							<input type="password" name="password" id="login-password" class="form-control" tabindex="2" placeholder="Password" required>
						</div>
						<div class="mb-3">
							<div class="row">
								<div class="col-6 mx-auto">
									<button type="submit" name="login-submit" id="login-submit" class="btn btn-primary form-control" tabindex="4">Log In</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('includes/footer.php'); ?>