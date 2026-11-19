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
		<title>Register as Lawyer</title>
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
					<div class="col-md-5 mb-5 mb-md-0">
						<h1>Hello Lawyer <i class="fas fa-user-tie"></i></h1>
						<h2 class="mt-3">Please register yourself here to join our legal network.</h2>
					</div>
					<div class="col-md-7">
						<div class="card p-4" style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 16px;">
							<form action="lawyer_registation.php" method="post" enctype="multipart/form-data" id="validateForm">
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="first_Name">First Name</label>
										<input type="text" class="form-control" id="first_Name" name="first_Name" placeholder="First name">
									</div>
									<div class="form-group col-md-6">
										<label for="last_Name">Last Name</label>
										<input type="text" class="form-control" id="last_Name" name="last_Name" placeholder="Last name">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="contact_number">Contact Number</label>
										<input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="10-digit number">
									</div>
									<div class="form-group col-md-6">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Email address">
									</div>
								</div>
								
								<div class="form-group">
									<label for="image">Profile Image</label>
									<input type="file" class="form-control" name="fileToUpload" id="image">
								</div>

								<div class="form-row mt-4">
									<div class="col-md-12">
										<label><small class="text-uppercase text-warning font-weight-bold">Education Details</small></label>
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="university_College">University / College Name</label>
										<input type="text" class="form-control" id="university_College" name="university_College" placeholder="Institute name">
									</div>
									<div class="form-group col-md-3">
										<label for="degree">Degree</label>
										<select id="degree" name="degree" class="form-control">
											<option value="" selected>Choose...</option>
											<option value="LLB">LLB</option>
											<option value="LLM">LLM</option>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label for="passing_year">Passing Year</label>
										<select id="passing_year" name="passing_year" class="form-control">
											<option value="" selected>Choose...</option>
											<?php 
												for ($yr = 2000; $yr <= 2026; $yr++) {
													echo "<option value='$yr'>$yr</option>";
												}
											?>
										</select>
									</div>
								</div>

								<div class="form-row mt-3">
									<div class="col-md-12">
										<label><small class="text-uppercase text-warning font-weight-bold">Chamber / Office Location</small></label>
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="full_address">Full Address</label>
										<input type="text" class="form-control" id="full_address" name="full_address" placeholder="Full address">
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
										<input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="6-digit pin code">
									</div>
								</div>
								
								<div class="form-group mt-3">
									<label for="practise_Length">Length of Practice</label>
									<select id="practise_Length" name="practise_Length" class="form-control">
										<option value="" selected>Choose...</option>
										<option value="1-5 years">1-5 years</option>
										<option value="6-10 years">6-10 years</option>
										<option value="11-15 years">11-15 years</option>
										<option value="16-20 years">16-20 years</option>
										<option value="Most Senior">Most Senior</option>
									</select>
								</div>
								
								<div class="form-group mt-4">
									<label class="d-block mb-2">Types of Cases Handled</label>
									<div class="row px-3">
										<?php 
											$cases = [
												"Criminal matter", "Civil matter", "Writ Jurisdiction", 
												"Company law", "Contract law", "Commercial matter", 
												"Construction law", "Information Technology", "Family Law", 
												"Religious Matter", "Investment Matter", "Labour Law", 
												"Property Law", "Taxation Matter", "Others"
											];
											foreach ($cases as $c) {
												$cid = strtolower(substr($c, 0, 4));
												echo '
												<div class="form-check col-md-6">
													<input class="form-check-input" type="checkbox" name="case_handle[]" value="'.$c.'" id="'.$cid.'">
													<label class="form-check-label" for="'.$cid.'">'.$c.'</label>
												</div>';
											}
										?>
									</div>
								</div>
								
								<div class="form-group mt-3">
									<label for="speciality">My Primary Speciality</label>
									<select id="speciality" name="speciality" class="form-control">
										<option value="" selected>Choose...</option>
										<option value="Criminal Law">Criminal law</option>
										<option value="Civil Law">Civil law</option>
										<option value="Writ Jurisdiction">Writ Jurisdiction</option>
										<option value="Company Law">Company law</option>
										<option value="Contract Law">Contract law</option>
										<option value="Commercial Law">Commercial law</option>
										<option value="Construction Law">Construction law</option>
										<option value="IT Law">IT law</option>
										<option value="Family Law">Family law</option>
										<option value="Religious Law">Religious law</option>
										<option value="Investment Law">Investment law</option>
										<option value="Labour Law">Labour law</option>
										<option value="Property Law">Property law</option>
										<option value="Taxation Law">Taxation law</option>
									</select>
								</div>
								
								<div class="form-group mt-4">
									<div class="form-check">
										<input id="accept" name="agree" type="checkbox" value="y" class="form-check-input" />
										<label class="form-check-label" for="accept">
											<strong>I agree with the terms & conditions</strong>
										</label>
									</div>
								</div>
								
								<input name="post" type="submit" class="btn btn-block btn-success mt-4" value="Register As Lawyer" />
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
								message: 'First name must contain at least 3 characters',
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
								message: 'Last name must contain at least 3 characters',
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
								message: 'Please upload your profile image'
							}
						}
					},
					university_College: {
						validators: {
							notEmpty: {
								message: 'University/College name is required'
							}
						}
					},
					degree: {
						validators: {
							notEmpty: {
								message: 'Degree is required'
							}
						}
					},
					passing_year: {
						validators: {
							notEmpty: {
								message: 'Passing year is required'
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
								message: 'City is required'
							}
						}
					},
					agree: {
						validators: {
							notEmpty: {
								message: 'You must accept the terms & conditions'
							}
						}
					},
					practise_Length: {
						validators: {
							notEmpty: {
								message: 'Please select your practice length'
							}
						}
					},
					'case_handle[]': {
						validators: {
							notEmpty: {
								message: 'Select at least one type of case you handle'
							}
						}
					},
					speciality: {
						validators: {
							notEmpty: {
								message: 'Please select your primary specialty'
							}
						}
					}
				}
			});
		</script>
	</body>
</html>
