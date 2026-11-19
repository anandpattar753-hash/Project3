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
		<link rel="stylesheet" href="css/simple-sidebar.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/media.css">
		<title>Lawyers Directory</title>
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
		
		<section class="lawyerscard">
			<div class="container">
				<div class="row mb-4 align-items-center">
					<div class="col-sm-6">
						<h2 class="font-serif">Active Legal Advocates</h2>
					</div>
					<div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
						<a href="searchLawyer.php" class="btn btn-primary">
							<i class="fa fa-search"></i>&nbsp; Find/Filter Lawyers
						</a>
					</div>
				</div>
				<hr style="border-top: 1px solid var(--border-color);" />
				
				<div class="row">
					<?php
						$conn = connect();
						$result = mysqli_query($conn,"SELECT * FROM user,lawyer WHERE user.u_id=lawyer.lawyer_id AND user.status='Active'");
						
						while($row = mysqli_fetch_array($result)) {
						?>
						<div class="col-md-4 col-sm-6">
							<div class="card">
								<img src="images/upload/<?php echo $row["image"]; ?>" class="card-img-top cusimg img-fluid" alt="lawyer profile picture">
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
