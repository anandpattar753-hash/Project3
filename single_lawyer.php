<?php
	session_start();
	include("db_con/dbCon.php");
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
		<title>Lawyer Profile - Detailed View</title>
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
									<li class="active">
										<a class="nav-link cus-a" href="lawyers.php">Lawyers</a>
									</li>
									<li class="">
										<a class="nav-link cus-a" href="index.php#about-us">About Us</a>
									</li>
									<?php if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE){ ?>
										<li class="">
											<a class="nav-link cus-a" href="user_dashboard.php">Dashboard</a>
										</li>
										<li class="">
											<a class="nav-link cus-a" href="logout.php">Logout</a>
										</li>
										<?php }else{ ?>
										<li class="">
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
									<?php }?>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</header>
		
		<section style="padding: 60px 0;">
			<div class="container">
				<div class="row">
					<?php
						$conn = connect();
						$result = mysqli_query($conn,"SELECT * FROM user,lawyer WHERE user.u_id=lawyer.lawyer_id AND user.status='Active' AND user.u_id='" . mysqli_real_escape_string($conn, $_GET['u_id']) . "'");
						
						while($row = mysqli_fetch_array($result)) {
						?>
						<div class="col-md-4 mb-4 mb-md-0">
							<div class="sideprofile">
								<img src="images/upload/<?php echo $row["image"]; ?>" class="img-fluid profile_img" alt="profile picture">
								<h2 class="mt-3"><?php echo htmlspecialchars($row["first_Name"] . ' ' . $row["last_Name"]); ?></h2>
								<span class="badge badge-warning p-2 mt-1 mb-3" style="font-size: 0.9rem; background-color: rgba(197, 168, 128, 0.1); border: 1px solid var(--accent); color: var(--accent);">
									<?php echo htmlspecialchars($row["speciality"]); ?>
								</span>
								<p class="text-secondary mb-0"><i class="fa fa-map-marker-alt text-warning mr-2"></i> <?php echo htmlspecialchars($row["city"]); ?></p>
							</div>
						</div>
						
						<div class="col-md-8">
							<div class="mainprofile">
								<h3 class="mb-4 font-serif text-warning">Professional Credentials & Info</h3>
								
								<div class="infogroup row">
									<div class="col-sm-4">
										<label><i class="fa fa-phone text-warning mr-2"></i> Contact Number</label>
									</div>
									<div class="col-sm-8">
										<p><?php echo htmlspecialchars($row["contact_Number"]); ?></p>
									</div>
								</div>
								
								<div class="infogroup row">
									<div class="col-sm-4">
										<label><i class="fa fa-envelope text-warning mr-2"></i> Email Address</label>
									</div>
									<div class="col-sm-8">
										<p><?php echo htmlspecialchars($row["email"]); ?></p>
									</div>
								</div>
								
								<div class="infogroup row">
									<div class="col-sm-4">
										<label><i class="fa fa-graduation-cap text-warning mr-2"></i> Education</label>
									</div>
									<div class="col-sm-8">
										<p><strong><?php echo htmlspecialchars($row["university_College"]); ?></strong></p>
										<p><?php echo htmlspecialchars($row["degree"]); ?> (Passed: <?php echo htmlspecialchars($row["passing_year"]); ?>)</p>
									</div>
								</div>
								
								<div class="infogroup row">
									<div class="col-sm-4">
										<label><i class="fa fa-building text-warning mr-2"></i> Chamber Location</label>
									</div>
									<div class="col-sm-8">
										<p><?php echo htmlspecialchars($row["full_address"]); ?></p>
										<p><?php echo htmlspecialchars($row["city"]); ?>, Pin Code: <?php echo htmlspecialchars($row["zip_code"]); ?></p>
									</div>
								</div>
								
								<div class="infogroup row">
									<div class="col-sm-4">
										<label><i class="fa fa-briefcase text-warning mr-2"></i> Practice Length</label>
									</div>
									<div class="col-sm-8">
										<p><?php echo htmlspecialchars($row["practise_Length"]); ?></p>
									</div>
								</div>
								
								<div class="infogroup row">
									<div class="col-sm-4">
										<label><i class="fa fa-gavel text-warning mr-2"></i> Cases Handled</label>
									</div>
									<div class="col-sm-8">
										<p><?php echo htmlspecialchars(rtrim($row["case_handle"], ',')); ?></p>
									</div>
								</div>  
								
								<form action="save_booking.php" method="post" class="mt-5">
									<h4 class="mb-4 text-warning"><i class="fa fa-calendar-alt mr-2"></i> Book an Appointment</h4>
									
									<input type="hidden" name="lawyer_id" value="<?php echo $row['u_id']; ?>">
									<?php if(isset($_SESSION['client_id'])) { ?>
										<input type="hidden" name="client_id" value="<?php echo $_SESSION['client_id']; ?>">
									<?php } ?>
                                    
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="date">Select Appointment Date</label>
												<input type="date" name="date" required class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="description">Case Description (Optional)</label>
												<textarea name="description" class="form-control" rows="3" placeholder="Briefly describe your case/consultation need..."></textarea>
											</div>
										</div>
									</div>
									
									<div class="row mt-3">
										<div class="col-12 text-right">
											<?php if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE && isset($_SESSION['client_id'])){ ?>
												<input name="post" type="submit" class="btn btn-primary px-5" value="Request Booking" />
											<?php } else { ?>
												<div class="alert alert-danger d-inline-block text-left mb-0">
													<i class="fa fa-exclamation-circle mr-2"></i> To request booking, please <a href="login.php" class="alert-link">Login as a Client</a> first.
												</div>
											<?php } ?> 
										</div>
									</div>
								</form>
							</div>
						</div>
						<?php
						}
					?>
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
	</body>
</html>