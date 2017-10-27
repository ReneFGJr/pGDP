<!-- BEGIN # BOOTSNIP INFO -->
<h3 class="text-left">DMP-Login</h3>
<p class="text-left">
	<a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#login-modal">Open Login Modal</a>
</p>
<!-- END # BOOTSNIP INFO -->

<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" align="center">
				<img class="img-responsive" width="30%" id="img_logo" src="<?php echo base_url('img/logos_brasil_blue.png');?>" heigth="30">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</div>

			<!-- Begin # DIV Form -->
			<div id="div-forms">

				<!-- Begin # Login Form -->
				<form id="login-form" method="post">
					<div class="modal-body">
						<div id="div-login-msg">
							<span id="text-login-msg">Enter your e-mail</span>
							<br>
							<input name="login_username" id="login_username" class="form-control" type="text" placeholder="Username" required>
							<br>
							<span id="text-login-msg">Enter your password</span>
							<br>
							<input name="login_password"  id="login_password" class="form-control" type="password" placeholder="Password" required>
							<input name="action"  type="hidden" value="signin">
						</div>
					</div>
					<div class="modal-footer">
						<div>
							<button type="submit" class="btn btn-primary btn-lg btn-block">
								Login
							</button>
						</div>
						<div>
							<button id="login_lost_btn" type="button" class="btn btn-link">
								Lost Password?
							</button>
							<button id="login_register_btn" type="button" class="btn btn-link">
								Register
							</button>
						</div>
					</div>
				</form>
				<!-- End # Login Form -->

				<!-- Begin | Lost Password Form -->
				<form id="lost-form" style="display:none;"  method="post">
					<div class="modal-body">
						<div id="div-lost-msg">
							<span id="text-lost-msg">Type your e-mail.</span>
						</div>
						<input name="lost_email id="lost_email" class="form-control" type="text" placeholder="Enter your E-Mail" required>
						<input name="action"  type="hidden" value="lost">
						</div>
						<div class="modal-footer">
						<div>
						<button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
						</div>
						<div>
						<button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
						<button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
						</div>
						</div>
						</form>
						<!-- End | Lost Password Form -->

						<!-- Begin | Register Form -->
						<form id="register-form" style="display:none;"  method="post">
						<div class="modal-body">
						<div id="div-register-msg">
						<h3 id="text-register-msg">Register an account.</h3>
						</div>
						<div id="div-lost-msg">
						<span id="text-lost-msg">Enter an user name.</span>
						</div>
						<input name="register_username" id="register_username" class="form-control" type="text" placeholder="Enter an Username" required>
						<br>

						<div id="div-lost-msg">
						<span id="text-lost-msg">Enter your e-mail.</span>
						</div>
						<input name="register_email" id="register_email" class="form-control" type="text" placeholder="E-Mail" required>
						<br>
						<div id="div-lost-msg">
						<span id="text-lost-msg">Enter a password.</span>
						</div>
						<input name="register_password" id="register_password" class="form-control" type="password" placeholder="Password" required>
						<input name="action" type="hidden" value="register">
						<br>
						</div>
						<div class="modal-footer">
						<div>
						<button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
						</div>
						<div>
						<button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
						<button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
						</div>
						</div>
						</form>
						<!-- End | Register Form -->

						</div>
						<!-- End # DIV Form -->

						</div>
						</div>
						</div>
						<script>

						jQuery("#login_register_btn").click(function() {
						jQuery("#register-form").show();
						jQuery("#login-form").hide();
						jQuery("#lost-form").hide();
						});
						jQuery("#lost_register_btn").click(function() {
						jQuery("#register-form").show();
						jQuery("#login-form").hide();
						jQuery("#lost-form").hide();
						});

						jQuery("#register_login_btn").click(function() {
						jQuery("#register-form").hide();
						jQuery("#login-form").show();
						jQuery("#lost-form").hide();
						});
						jQuery("#lost_login_btn").click(function() {
						jQuery("#register-form").hide();
						jQuery("#login-form").show();
						jQuery("#lost-form").hide();
						});

						jQuery("#register_lost_btn").click(function() {
						jQuery("#register-form").hide();
						jQuery("#login-form").hide();
						jQuery("#lost-form").show();
						});
						jQuery("#login_lost_btn").click(function() {
						jQuery("#register-form").hide();
						jQuery("#login-form").hide();
						jQuery("#lost-form").show();
						});

						</script>
						<!-- END # MODAL LOGIN -->
