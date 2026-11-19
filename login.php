<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/media.css">
		<title>Login - Lawyer Management System</title>
		<style>
			.has-error .help-block {
				color: var(--danger);
				font-size: 0.85rem;
				margin-top: 5px;
			}
		</style>
	</head>
	<body>
		<header class="customnav bg-success">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-expand-lg ">
							<a class="navbar-brand cus-a" href="index.php">Lawyer Management System</a>
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="navbar-nav ml-auto ">
									<li class="">
										<a class="nav-link cus-a" href="index.php">Home</a>
									</li>
									<li class="">
										<a class="nav-link cus-a" href="lawyers.php">Lawyers</a>
									</li>
									<li class="">
										<a class="nav-link cus-a" href="index.php#about-us">About Us</a>
									</li>
									<li class="active">
										<a class="nav-link cus-a" href="login.php">Login</a>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle cus-a" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Register
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
											<a class="dropdown-item" href="lawyer_register.php">Register as a lawyer</a>
											<a class="dropdown-item" href="user_register.php">Register as a user</a>
										</div>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</header>
		
		<section class="registerform d-flex align-items-center" style="min-height: calc(100vh - 180px);">
			<div class="container">
				<?php
					if(isset($_GET['error'])){
					echo "
					<div class='row justify-content-center'>
						<div class='col-md-6'>
							<div class='alert alert-danger alert-dismissible fade show'>
								<button type='button' class='close' data-dismiss='alert'>&times;</button>
								<i class='fa fa-exclamation-circle mr-2'></i> Incorrect Email or Password.
							</div>
						</div>
					</div>";
					}
					else if(isset($_GET['deactivate'])){
					echo "
					<div class='row justify-content-center'>
						<div class='col-md-6'>
							<div class='alert alert-danger alert-dismissible fade show'>
								<button type='button' class='close' data-dismiss='alert'>&times;</button>
								<i class='fa fa-exclamation-circle mr-2'></i> Please enter a valid Email & Password to log in.
							</div>
						</div>
					</div>";
				}?>
				
				<div class="row justify-content-center">
					<div class="col-md-6 col-lg-5">
						<div class="card p-5" style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 16px; box-shadow: var(--card-shadow);">
							<div class="text-center mb-4">
								<h2 class="font-serif text-warning">Welcome Back</h2>
								<p class="text-secondary small">Login to manage your bookings and profile</p>
							</div>
							
							<form action="db_con/db_login.php" method="POST" id="validateForm">
								<div class="form-group">
									<label for="email"><i class="fa fa-envelope text-warning mr-2"></i> Email Address</label>
									<input type="email" class="form-control" name="email" id="email" placeholder="Enter email address">
								</div>
								
								<div class="form-group">
									<label for="password"><i class="fa fa-lock text-warning mr-2"></i> Password</label>
									<input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
								</div>
								
								<input name="login" type="submit" class="btn btn-block btn-primary mt-4" value="Sign In" />
							</form>
							
							<div class="text-center mt-4">
								<p class="text-secondary small mb-0">Don't have an account?</p>
								<a href="lawyer_register.php" class="text-warning small mr-3">Register as Lawyer</a>
								<a href="user_register.php" class="text-warning small">Register as Client</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<footer>
			<div class="container">
				<div class="row">
					<div class="col">
						<h5>All rights reserved. &copy; <script>document.write(new Date().getFullYear());</script> Lawyer Management System</h5>
					</div>
				</div>
			</div>
		</footer>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>

		<script>
			$('#validateForm').bootstrapValidator({
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Email address is required'
							},
							emailAddress: {
								message: 'Please enter a valid email address'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Password is required'
							}
						}
					}
				}
			});
		</script>
	</body>
</html>
