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
		
		<!-- Google Fonts - Modern Premium Typography -->
		<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
		
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/media.css">
		<title>Lawyer Management System - Premium Legal Representation</title>
	</head>
	<body>
		<!-- Decorative Ambient Blurs -->
		<div class="floating-orb orb-accent" style="top: 15%; left: 10%;"></div>
		<div class="floating-orb orb-blue" style="top: 60%; right: 5%;"></div>

		<header class="customnav">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-expand-lg px-0">
							<a class="navbar-brand cus-a d-flex align-items-center" href="index.php" style="font-family: 'Playfair Display', serif; font-weight: 700; letter-spacing: -0.5px;">
								<i class="fas fa-balance-scale mr-2 text-warning" style="font-size: 1.4rem;"></i>
								<span>ADVOCATE<span style="color: var(--text-primary);">PORTAL</span></span>
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"><i class="fas fa-bars text-white"></i></span>
							</button>
							
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="navbar-nav ml-auto align-items-center">
									<li class="active">
										<a class="nav-link cus-a" href="index.php">Home</a>
									</li>
									<li class="">
										<a class="nav-link cus-a" href="lawyers.php">Lawyers</a>
									</li>
									<li class="">
										<a class="nav-link cus-a" href="#about-us">About Us</a>
									</li>
									<?php if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE){ ?>
										<li class="">
											<a class="nav-link cus-a" href="user_dashboard.php">Dashboard</a>
										</li>
										<li class="">
											<a class="btn btn-sm btn-outline-light ml-2 px-3" href="logout.php" style="border-radius: 20px;">Logout</a>
										</li>
									<?php }else{ ?>
										<li class="">
											<a class="nav-link cus-a" href="login.php">Login</a>
										</li>
										<li class="nav-item dropdown">
											<a class="btn btn-sm btn-primary ml-2 px-4 py-2 text-dark font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 30px; box-shadow: 0 4px 15px rgba(197,168,128,0.25);">
												Register <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
												<a class="dropdown-item py-2" href="lawyer_register.php"><i class="fas fa-user-tie mr-2 text-warning"></i> Register as a lawyer</a>
												<a class="dropdown-item py-2" href="user_register.php"><i class="fas fa-user mr-2 text-warning"></i> Register as a user</a>
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

		<!-- Hero Section -->
		<section>
			<div class="banner">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md text-center py-5">
							<div class="banner_content">
								<div class="d-inline-flex align-items-center px-3 py-1 mb-4" style="background: rgba(197, 168, 128, 0.08); border: 1px solid rgba(197, 168, 128, 0.25); border-radius: 50px;">
									<span style="font-family: var(--font-sans); font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: var(--accent);">
										✨ Premium Legal Matchmaker
									</span>
								</div>
								<h1>Find Your Suitable Lawyer Here !</h1>
								<p class="subtitle mb-5 mx-auto" style="max-width: 600px; font-size: 1.1rem; line-height: 1.7; color: var(--text-secondary);">
									Instantly connect with top-tier verified legal advocates across India. Seamlessly book consultations, manage case document reviews, and resolve complex litigations.
								</p>
								<div class="d-flex flex-wrap justify-content-center gap-3">
									<a href="searchLawyer.php"><button class="btn-lg cusbutton px-5">Find Lawyers <i class="fas fa-search ml-2"></i></button></a>
									<a href="#features" class="btn btn-lg btn-outline-light ml-3 px-5 d-flex align-items-center" style="border-radius: 30px; font-family: var(--font-sans); font-size: 1rem; font-weight: 600; border-color: rgba(255,255,255,0.15);">
										Explore Features
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- System Performance Stats Section -->
		<section class="stats-section">
			<div class="container">
				<div class="row">
					<div class="col-md-4 mb-4 mb-md-0">
						<div class="stat-card">
							<div class="stat-number">500+</div>
							<div class="stat-label">Verified Attorneys</div>
						</div>
					</div>
					<div class="col-md-4 mb-4 mb-md-0">
						<div class="stat-card">
							<div class="stat-number">10k+</div>
							<div class="stat-label">Successful Bookings</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat-card">
							<div class="stat-number">99%</div>
							<div class="stat-label">Case Success Rate</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Features Showcase Section -->
		<section class="features-section" id="features">
			<div class="container">
				<div class="row justify-content-center mb-5">
					<div class="col-md-8 text-center">
						<h2 class="section-title mb-3 font-serif" style="font-size: 2.5rem;">Engineered For Legal Excellence</h2>
						<p style="color: var(--text-secondary); max-width: 600px; margin: 0 auto;">Our ecosystem simplifies access to legal professionals with highly robust match criteria and security integrations.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 mb-4">
						<div class="feature-card">
							<div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
							<h3>Strict Verification</h3>
							<p>Every legal advocate undergoes strict authentication of credentials, licenses, and bar association enrollments before listing.</p>
						</div>
					</div>
					<div class="col-md-4 mb-4">
						<div class="feature-card">
							<div class="feature-icon"><i class="fas fa-bolt"></i></div>
							<h3>Instant Booking</h3>
							<p>Secure virtual legal consultation slots in real-time. Transparent scheduling without complex mediator calls.</p>
						</div>
					</div>
					<div class="col-md-4 mb-4">
						<div class="feature-card">
							<div class="feature-icon"><i class="fas fa-gavel"></i></div>
							<h3>Multi-Specialty Expert</h3>
							<p>Filter legal advisors based on corporate legislation, construction litigation, civil matters, criminal lawsuits, and IT laws.</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Grid of Lawyers Section -->
		<section class="lawyerscard">
			<div class="container">
				<div class="row justify-content-center mb-5">
					<div class="col-md-8 text-center">
						<h2 class="section-title mb-3 font-serif" style="font-size: 2.5rem;">Featured Legal Professionals</h2>
						<p style="color: var(--text-secondary); max-width: 600px; margin: 0 auto;">Meet our top-rated legal attorneys with specialized litigation backgrounds and established industry reputations.</p>
					</div>
				</div>
				<div class="row">
					<?php
						$conn = connect();
						$result = mysqli_query($conn,"SELECT * FROM user,lawyer WHERE user.u_id=lawyer.lawyer_id AND user.status='Active' LIMIT 6");
						
						while($row = mysqli_fetch_array($result)) {
						?>
						<div class="col-md-4 d-flex">
							<div class="card d-flex flex-column justify-content-between">
								<div>
									<span class="badge-premium"><i class="fas fa-star mr-1"></i> Verified</span>
									<img src="images/upload/<?php echo $row["image"]; ?>" class="card-img-top cusimg img-fluid" alt="lawyer profile image">
									<div class="card-body">
										<h5 class="card-title" style="font-family: var(--font-sans); font-weight: 700; margin-bottom: 5px;">
											<?php echo htmlspecialchars($row["first_Name"] . ' ' . $row["last_Name"]); ?>
										</h5>
										<h6 class="card-title text-warning" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
											<?php echo htmlspecialchars($row["speciality"]); ?>
										</h6>
										
										<div class="d-flex align-items-center mb-3">
											<span style="font-size: 0.8rem; padding: 4px 10px; background-color: rgba(197, 168, 128, 0.08); border: 1px solid rgba(197,168,128,0.15); border-radius: 20px; color: var(--accent);">
												<i class="fa fa-briefcase mr-1"></i> <?php echo htmlspecialchars($row["practise_Length"]); ?> Exp
											</span>
											<span class="ml-2" style="font-size: 0.8rem; padding: 4px 10px; background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59,130,246,0.15); border-radius: 20px; color: #60a5fa;">
												<i class="fas fa-university mr-1"></i> <?php echo htmlspecialchars($row["degree"]); ?>
											</span>
										</div>

										<p class="text-secondary small mb-0"><i class="fa fa-map-marker-alt text-warning mr-1"></i> <?php echo htmlspecialchars($row["city"]); ?></p>
									</div>
								</div>
								
								<div class="card-body pt-0">
									<a class="btn btn-sm btn-info btn-block mt-3 d-flex align-items-center justify-content-center py-2" href="single_lawyer.php?u_id=<?php echo $row["u_id"]; ?>" style="border-radius: 30px;">
										<i class="fa fa-street-view mr-2"></i> View Full Profile
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

		<!-- About Us Section -->
		<section class="aboutus" id="about-us">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 ml-auto pr-md-5">
						<div class="d-inline-flex align-items-center px-3 py-1 mb-3" style="background: rgba(197, 168, 128, 0.08); border-radius: 50px;">
							<span style="font-size: 0.75rem; font-weight: 700; color: var(--accent); text-transform: uppercase; letter-spacing: 1px;">Who We Are</span>
						</div>
						<h1 class="mb-4">About Us</h1>
						<p style="font-size: 1.05rem; line-height: 1.8; color: var(--text-secondary);">We connect clients with the most experienced and certified lawyers across India. Whether you need assistance with criminal matters, corporate/tax advice, or family litigation, our directory helps you choose the perfect advocate based on specialty, location, and length of practice.</p>
						
						<div class="mt-4 pt-2">
							<div class="d-flex align-items-center mb-3">
								<div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(197,168,128,0.1); border: 1px solid rgba(197,168,128,0.2); display:flex; align-items:center; justify-content:center; color: var(--accent);" class="mr-3">
									<i class="fa fa-map-marker-alt"></i>
								</div>
								<h5 class="mb-0 text-secondary" style="font-family: var(--font-sans); font-size: 0.95rem;">12, MG Road, Bangalore, India - 560001</h5>
							</div>
							<div class="d-flex align-items-center mb-3">
								<div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(197,168,128,0.1); border: 1px solid rgba(197,168,128,0.2); display:flex; align-items:center; justify-content:center; color: var(--accent);" class="mr-3">
									<i class="fa fa-phone"></i>
								</div>
								<h5 class="mb-0 text-secondary" style="font-family: var(--font-sans); font-size: 0.95rem;">+91 62630 56779</h5>
							</div>
							<div class="d-flex align-items-center">
								<div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(197,168,128,0.1); border: 1px solid rgba(197,168,128,0.2); display:flex; align-items:center; justify-content:center; color: var(--accent);" class="mr-3">
									<i class="fa fa-envelope"></i>
								</div>
								<h5 class="mb-0 text-secondary" style="font-family: var(--font-sans); font-size: 0.95rem;">contact@lawyer-mgmt.in</h5>
							</div>
						</div>
					</div>
					<div class="col-md-6 mt-5 mt-md-0">
						<div class="embed-responsive embed-responsive-16by9" style="border-radius: 20px; overflow: hidden; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
							<iframe class="embed-responsive-item" src="https://maps.google.com/maps?q=bangalore&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Footer Section -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<h5 style="color: var(--text-muted); font-size: 0.9rem;">All rights reserved. &copy; <script>document.write(new Date().getFullYear());</script> AdvocatePortal &bull; Crafted for legal excellence</h5>
					</div>
				</div>
			</div>
		</footer>

		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	</body>
</html>
