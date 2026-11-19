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
			<title>User Profile - Edit</title>
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
						<a href="user_dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
						<a href="user_profile.php" class="list-group-item list-group-item-action bg-light active">Edit Profile</a>
						<a href="user_booking.php" class="list-group-item list-group-item-action bg-light">My booking requests</a>
						<a href="update_password.php" class="list-group-item list-group-item-action bg-light">Update Password</a>
					</div>
				</div>
				<!-- /#sidebar-wrapper -->
				
				<!-- edit profile Content -->
				<section class="editprofile">
					<?php if(isset($_GET['ok'])){
						echo "<div class='alert alert-success alert-dismissible fade show'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<strong>Success!</strong> Profile updated successfully.
						</div>";
					}?>
					
					<div class="card p-5" style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 16px;">
						<h2 class="mb-4">Edit Profile Details</h2>
						<?php
							$a=$_SESSION['client_id'];
							$conn = connect();
							
							$result = mysqli_query($conn,"SELECT * FROM user,client WHERE user.u_id=client.client_id AND user.status='Active' AND user.u_id='$a'");
							
							while($row = mysqli_fetch_array($result)) {
							?>
							<form class="cusform" action="save_user_edit_profile.php" method="post">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="first_Name">First Name</label>
										<input type="text" class="form-control" name="first_Name" id="first_Name" value="<?php echo htmlspecialchars($row["first_Name"]); ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="last_Name">Last Name</label>
										<input type="text" class="form-control" name="last_Name" id="last_Name" value="<?php echo htmlspecialchars($row["last_Name"]); ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label for="contact_number">Contact Number</label>
									<input type="text" class="form-control" name="contact_number" id="contact_number" value="<?php echo htmlspecialchars($row["contact_number"]); ?>">
								</div>
								
								<div class="form-row mt-4">
									<div class="form-group col-md-6">
										<label for="full_address">Full Address</label>
										<input type="text" class="form-control" name="full_address" id="full_address" value="<?php echo htmlspecialchars($row["full_address"]); ?>">
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
										<input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php echo htmlspecialchars($row["zip_code"]); ?>">
									</div>
								</div>
								
								<button type="submit" class="btn btn-primary mt-4">Update Profile</button>
							</form>
							<?php
							}
						?>
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