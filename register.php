<?php
include('includes/header.php');
include('includes/nav.php');
?>

<div class="row">
	<div class="col-lg-6 offset-lg-3">
		<?php validate_user_registration(); ?>
	</div>
</div>
<div class="container mt-5">
	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card">
				<div class="card-body">
					<form id="register-form" method="post" role="form">
						<div class="row mb-3">
							<div class="col-6">
								<div class="form-group">
									<label for="first_name">First Name</label>
									<input type="text" name="first_name" id="first_name" class="form-control" tabindex="1" placeholder="First Name" value="" required>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="last_name">Last Name</label>
									<input type="text" name="last_name" id="last_name" class="form-control" tabindex="1" placeholder="Last Name" value="" required>
								</div>
							</div>
						</div>
						<div class="form-group mb-3">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" class="form-control" tabindex="1" placeholder="Username" value="" required>
						</div>
						<div class="form-group mb-3">
							<label for="register_email">Email Address</label>
							<input type="email" name="email" id="register_email" class="form-control" tabindex="1" placeholder="Email Address" value="" required>
						</div>
						<div class="form-group mb-3">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" tabindex="2" placeholder="Password" required>
						</div>
						<div class="form-group mb-3">
							<label for="confirm_password">Confirm Password</label>
							<input type="password" name="confirm_password" id="confirm-password" class="form-control" tabindex="2" placeholder="Confirm Password" required>
						</div>
						<div class="form-group mb-3">
							<label for="role">Role</label>
							<select class="form-select" name="role" id="role" required>
								<option value="">Choose your role</option>
								<option value="1">Admin</option>
								<option value="0">User</option>
							</select>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-6 mx-auto">
									<button type="submit" name="register-submit" id="register-submit" class="btn btn-primary form-control" tabindex="4">Register Now</button>
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