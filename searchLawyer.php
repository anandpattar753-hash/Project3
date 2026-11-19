<?php
	session_start();
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
		<link rel="stylesheet" href="css/simple-sidebar.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/media.css">
		<title>Search Lawyers</title>
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
										<a class="nav-link cus-a" href="#">About Us</a>
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
		
		<section class="lawyerscard">
			<div class="container">
				<div class="card p-4 mb-5" style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 16px;">
					<h3 class="mb-4"><i class="fa fa-filter text-warning"></i> Filter Lawyers</h3>
					<form method="post" novalidate="novalidate">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="experience">Experience</label>
									<select name="experience" class="form-control">
										<option value="" selected>Choose...</option>
										<option value="1-5 years">1-3 years</option>
										<option value="6-10 years">6-10 years</option>
										<option value="11-15 years">11-15 years</option>
										<option value="16-20 years">16-20 years</option>
										<option value="Most Senior">Most Senior</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="speciality">Speciality</label>
									<select name="speciality" class="form-control">
										<option value="" selected>Choose...</option>
										<option value="Criminal Law">Criminal Law</option>
										<option value="Civil Law">Civil Law</option>
										<option value="Writ Jurisdiction">Writ Jurisdiction</option>
										<option value="Company Law">Company Law</option>
										<option value="Contract Law">Contract Law</option>
										<option value="Commercial Law">Commercial Law</option>
										<option value="Construction Law">Construction Law</option>
										<option value="IT Law">IT Law</option>
										<option value="Family Law">Family Law</option>
										<option value="Religious Law">Religious Law</option>
										<option value="Investment Law">Investment Law</option>
										<option value="Labour Law">Labour Law</option>
										<option value="Property Law">Property Law</option>
										<option value="Taxation Law">Taxation Law</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="location">Location</label>
									<select name="location" class="form-control"> 
										<option value="" selected>Choose...</option>
										<?php echo render_city_options(); ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12 text-right">
								<button id="button" type="submit" class="btn btn-primary" name="submit" value="submit">
									<i class="fa fa-search"></i>&nbsp; Search Directory
								</button>
							</div>	
						</div>
					</form>
				</div>
				
				<div class="row">
					<?php
						include_once 'db_con/dbCon.php';
						$conn = connect();
						
						// Default query or search query
						$query = "SELECT * FROM user, lawyer WHERE user.u_id = lawyer.lawyer_id AND user.status = 'Active'";
						
						if (isset($_POST['submit'])){
							$experience = $_POST['experience'];
							$speciality = $_POST['speciality'];
							$location = $_POST['location'];
							
							if (!empty($experience)) {
								$query .= " AND lawyer.practise_Length = '" . mysqli_real_escape_string($conn, $experience) . "'";
							}
							if (!empty($speciality)) {
								$query .= " AND (lawyer.speciality = '" . mysqli_real_escape_string($conn, $speciality) . "' OR lawyer.case_handle LIKE '%" . mysqli_real_escape_string($conn, $speciality) . "%')";
							}
							if (!empty($location)) {
								$query .= " AND lawyer.city = '" . mysqli_real_escape_string($conn, $location) . "'";
							}
						}
						
						$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
						$count = mysqli_num_rows($result);
						
						if ($count == 0) {
							echo '<div class="col-12 text-center my-5"><h4 class="text-muted">No lawyers found matching the selected criteria.</h4></div>';
						} else {
							while($row = mysqli_fetch_array($result)) {
							?>
							<div class="col-md-4">
								<div class="card">
									<img src="images/upload/<?php echo $row["image"]; ?>" class="card-img-top cusimg img-fluid" alt="lawyer image">
									<div class="card-body">
										<h5 class="card-title"><?php echo htmlspecialchars($row["first_Name"] . ' ' . $row["last_Name"]); ?></h5>
										<h6 class="card-title"><?php echo htmlspecialchars($row["speciality"]); ?></h6>
										<h6 class="card-title"><span><i class="fa fa-briefcase"></i> <?php echo htmlspecialchars($row["practise_Length"]); ?></span></h6>
										<p class="text-secondary small mt-2"><i class="fa fa-map-marker-alt text-warning"></i> <?php echo htmlspecialchars($row["city"]); ?></p>
										
										<a class="btn btn-sm btn-info btn-block mt-3" href="single_lawyer.php?u_id=<?php echo $row["u_id"]; ?>">
											<i class="fa fa-street-view"></i>&nbsp; View Full Profile
										</a>
									</div>
								</div>
							</div>
							<?php
							}
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
