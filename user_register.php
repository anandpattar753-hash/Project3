<?php
	include_once("db_con/cities.php");
?>
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
		<title>Register as User</title>
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
										<a class="nav-link cus-a" href="#">About Us</a>
									</li>
									<li class="">
										<a class="nav-link cus-a" href="login.php">Login</a>
									</li>
									<li class="nav-item dropdown active">
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
		
		<section class="registerform">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 mb-5 mb-md-0">
						<h1>Hello! <i class="fas fa-hand-paper"></i></h1>
						<h3 class="mt-3">Register here to find suitable lawyers and book appointments.</h3>
					</div>
					<div class="col-md-6">
						<div class="card p-4" style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 16px;">
							<form action="user_registation.php" method="POST" enctype="multipart/form-data" id="validateForm">
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="first_Name">First Name</label>
										<input type="text" class="form-control" name="first_Name" id="first_Name" placeholder="First name">
									</div>
									<div class="form-group col-md-6">
										<label for="last_Name">Last Name</label>
										<input type="text" class="form-control" name="last_Name" id="last_Name" placeholder="Last name">
									</div>
								</div>
								
								<div class="form-group">
									<label for="email">Email address</label>
									<input type="email" class="form-control" name="email" id="email" placeholder="Email address">
								</div>
								
								<div class="form-group">
									<label for="contact_number">Contact Number</label>
									<input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="10-digit mobile number">
								</div>
								
								<div class="form-group">
									<label for="image">Profile Image</label>
									<input type="file" class="form-control" name="fileToUpload" id="image">
								</div>
								
								<div class="form-row mt-4">
									<div class="form-group col-md-6">
										<label for="full_address">Full Address</label>
										<input type="text" class="form-control" name="full_address" id="full_address" placeholder="Chamber/Home Address">
									</div>
									<div class="form-group col-md-3">
										<label for="city">City</label>
										<select id="city" name="city" class="form-control">
											<option value="" selected>Choose...</option>
											<?php echo render_city_options(); ?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label for="zip_code">Pin Code</label>
										<input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="6-digit pin code">
									</div>
								</div>
								
								<div class="form-group mt-3">
									<div class="form-check">
										<input id="accept" name="agree" type="checkbox" value="y" class="form-check-input" />
										<label class="form-check-label" for="accept">
											<strong>I agree with the terms & conditions</strong>
										</label>
									</div>
								</div>
								
								<input name="post" type="submit" class="btn btn-block btn-success mt-4" value="Register As User" />
							</form>
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
					first_Name: {
						validators: {
							stringLength: {
								min: 3,
								message: 'Please enter first name with minimum 3 characters',
							},
							notEmpty: {
								message: 'First name is required'
							}
						}
					},
					last_Name: {
						validators: {
							stringLength: {
								min: 3,
								message: 'Please enter last name with minimum 3 characters',
							},
							notEmpty: {
								message: 'Last name is required'
							}
						}
					},
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
					contact_number: {
						validators: {
							stringLength: {
								min: 10,
								max: 10,
								message: 'Contact number must be exactly 10 digits',
							},
							numeric: {
								message: 'Contact number must contain only numbers'
							},
							notEmpty: {
								message: 'Contact number is required'
							}
						}
					},
					fileToUpload: {
						validators: {
							notEmpty: {
								message: 'Please upload a profile image'
							}
						}
					},
					full_address: {
						validators: {
							notEmpty: {
								message: 'Address is required'
							}
						}
					},
					zip_code: {
						validators: {
							stringLength: {
								min: 6,
								max: 6,
								message: 'Pin code must be exactly 6 digits',
							},
							numeric: {
								message: 'Pin code must contain only numbers'
							},
							notEmpty: {
								message: 'Pin code is required'
							}
						}
					},
					city: {
						validators: {
							notEmpty: {
								message: 'Please choose your city'
							}
						}
					},
					agree: {
						validators: {
							notEmpty: {
								message: 'You must agree to the terms & conditions'
							}
						}
					}
				}
			});
		</script>
	</body>
</html>
