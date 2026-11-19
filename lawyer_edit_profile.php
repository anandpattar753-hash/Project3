<?php
	session_start();
	if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){
		include("db_con/dbCon.php");
		include_once("db_con/cities.php");
	?>
	<!doctype html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
			<link rel="stylesheet" href="css/all.css">
			<link rel="stylesheet" href="css/simple-sidebar.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/media.css">
			<title>Edit Lawyer Profile</title>
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
											<a class="nav-link cus-a" href="#">Full Name: <?php echo $_SESSION['first_Name'];?> <?php echo $_SESSION['last_Name'];?></a>
										</li>
										<li class="">
											<a class="nav-link cus-a" href="logout.php">Log Out</a>
										</li>
									</ul>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</header>
			
			<div class="d-flex" id="wrapper">
				<!-- Sidebar -->
				<div class="bg-light border-right" id="sidebar-wrapper">
					<div class="sidebar-heading">My Profile</div>
					<div class="list-group list-group-flush">
						<a href="lawyer_dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
						<a href="lawyer_edit_profile.php" class="list-group-item list-group-item-action bg-light active">Edit Profile</a>
						<a href="lawyer_booking.php" class="list-group-item list-group-item-action bg-light">Booking requests</a>
						<a href="update_password_admin.php" class="list-group-item list-group-item-action bg-light">Update Password</a>
					</div>
				</div>
				<!-- /#sidebar-wrapper -->
				
				<section class="bookingrqst">
					<div class="container">
						<div class="span7">   
							<div class="widget-header">
								<?php if(isset($_GET['ok'])){
									echo "<div class='alert alert-success alert-dismissible fade show'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
									<strong>Success!</strong> Profile updated successfully.
									</div>";
								}?>
							</div> 
							
							<div class="card p-5" style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 16px;">
								<h2 class="mb-4 text-center">Edit Lawyer Details</h2>
								<div class="row">
									<div class="col-md-12">
										<?php
											$a=$_SESSION['lawyer_id'];
											$conn = connect();
											
											$result = mysqli_query($conn,"SELECT * FROM user,lawyer WHERE user.u_id=lawyer.lawyer_id AND user.status='Active' AND user.u_id='$a'");
											
											while($row = mysqli_fetch_array($result)) {
											?>
											<form action="save_lawyer_edit_Profile.php" method="post" enctype="multipart/form-data" id="validateForm">
												<div class="form-row">
													<div class="form-group col-md-6">
														<label for="first_Name">First Name</label>
														<input type="text" class="form-control" id="first_Name" name="first_Name" value="<?php echo htmlspecialchars($row["first_Name"]); ?>">
													</div>
													<div class="form-group col-md-6">
														<label for="last_Name">Last Name</label>
														<input type="text" class="form-control" id="last_Name" name="last_Name" value="<?php echo htmlspecialchars($row["last_Name"]); ?>">
													</div>
												</div>
												
												<div class="form-group">
													<label for="contact_number">Contact Number</label>
													<input type="text" class="form-control" name="contact_number" id="contact_number" value="<?php echo htmlspecialchars($row["contact_Number"]); ?>">
												</div>
												
												<div class="form-row mt-4">
													<div class="col-md-12">
														<label><small class="text-uppercase text-warning font-weight-bold">Education Details</small></label>
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<label for="university_College">University / College Name</label>
														<input type="text" class="form-control" id="university_College" name="university_College" value="<?php echo htmlspecialchars($row["university_College"]); ?>">
													</div>
													<div class="form-group col-md-3">
														<label for="degree">Degree</label>
														<select id="degree" name="degree" class="form-control">
															<option value="">Choose...</option>
															<option value="LLB" <?php if ($row['degree']=='LLB'){echo "selected";}?>>LLB</option>
															<option value="LLM" <?php if ($row['degree']=='LLM'){echo "selected";}?>>LLM</option>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label for="passing_year">Passing Year</label>
														<select id="passing_year" name="passing_year" class="form-control">
															<option value="">Choose...</option>
															<?php 
																for ($yr = 2000; $yr <= 2026; $yr++) {
																	$selected = ($row['passing_year'] == $yr) ? 'selected' : '';
																	echo "<option value='$yr' $selected>$yr</option>";
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
														<input type="text" class="form-control" id="full_address" name="full_address" value="<?php echo htmlspecialchars($row["full_address"]); ?>">
													</div>
													<div class="form-group col-md-3">
														<label for="city">City</label>
														<select id="city" name="city" class="form-control">
															<option value="">Choose...</option>
															<?php echo render_city_options($row['city']); ?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label for="zip_code">Pin code</label>
														<input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo htmlspecialchars($row["zip_code"]); ?>">
													</div>
												</div>

												<div class="form-group mt-3">
													<label for="practise_Length">Length of Practice</label>
													<select id="practise_Length" name="practise_Length" class="form-control">
														<option value="">Choose...</option>
														<option value="1-5 years" <?php if ($row['practise_Length']=='1-5 years'){echo "selected";}?>>1-5 years</option>
														<option value="6-10 years" <?php if ($row['practise_Length']=='6-10 years'){echo "selected";}?>>6-10 years</option>
														<option value="11-15 years" <?php if ($row['practise_Length']=='11-15 years'){echo "selected";}?>>11-15 years</option>
														<option value="16-20 years" <?php if ($row['practise_Length']=='16-20 years'){echo "selected";}?>>16-20 years</option>
														<option value="Most Senior" <?php if ($row['practise_Length']=='Most Senior'){echo "selected";}?>>Most Senior</option>
													</select>
												</div>

												<div class="form-group">
													<label for="speciality">My Speciality</label>
													<select id="speciality" name="speciality" class="form-control">
														<option value="">Choose...</option>
														<option value="Criminal Law" <?php if ($row['speciality']=='Criminal Law' || $row['speciality']=='Criminal law'){echo "selected";}?>>Criminal law</option>
														<option value="Civil Law" <?php if ($row['speciality']=='Civil Law' || $row['speciality']=='Civil law'){echo "selected";}?>>Civil law</option>
														<option value="Writ Jurisdiction" <?php if ($row['speciality']=='Writ Jurisdiction'){echo "selected";}?>>Writ Jurisdiction</option>
														<option value="Company Law" <?php if ($row['speciality']=='Company Law' || $row['speciality']=='Company law'){echo "selected";}?>>Company law</option>
														<option value="Contract Law" <?php if ($row['speciality']=='Contract Law' || $row['speciality']=='Contract law'){echo "selected";}?>>Contract law</option>
														<option value="Commercial Law" <?php if ($row['speciality']=='Commercial Law' || $row['speciality']=='Commercial law'){echo "selected";}?>>Commercial law</option>
														<option value="Construction Law" <?php if ($row['speciality']=='Construction Law' || $row['speciality']=='Construction law'){echo "selected";}?>>Construction law</option>
														<option value="IT Law" <?php if ($row['speciality']=='IT Law' || $row['speciality']=='IT law'){echo "selected";}?>>IT law</option>
														<option value="Family Law" <?php if ($row['speciality']=='Family Law' || $row['speciality']=='Family law'){echo "selected";}?>>Family law</option>
														<option value="Religious Law" <?php if ($row['speciality']=='Religious Law' || $row['speciality']=='Religious law'){echo "selected";}?>>Religious law</option>
														<option value="Investment Law" <?php if ($row['speciality']=='Investment Law' || $row['speciality']=='Investment law'){echo "selected";}?>>Investment law</option>
														<option value="Labour Law" <?php if ($row['speciality']=='Labour Law' || $row['speciality']=='Labour law'){echo "selected";}?>>Labour law</option>
														<option value="Property Law" <?php if ($row['speciality']=='Property Law' || $row['speciality']=='Property law'){echo "selected";}?>>Property law</option>
														<option value="Taxation Law"  <?php if ($row['speciality']=='Taxation Law' || $row['speciality']=='Taxation law'){echo "selected";}?>>Taxation law</option>
													</select>
												</div>

												<input name="update" type="submit" class="btn btn-block btn-primary mt-4" value="Update Profile" />
											</form>
											<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			
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
		</body>
	</html>
	<?php
		
	}else 
	header('location:login.php?deactivate');
?>	