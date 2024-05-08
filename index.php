<?php
// Check if the "remember_token" cookie is present
if (isset($_COOKIE['remember_me'])) {
	$userType = $_COOKIE['remember_me'];
	$userId = $_COOKIE['user_id'];
	$email = $_COOKIE['email'];

	$mysqli = new mysqli("localhost", "root", "", "student_event_manage");
	$query = @mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$email' AND user_id = '$userId'") or die(mysqli_error($mysqli));
	$count = mysqli_num_rows($query);
	if($count > 0 ){
		// Redirect to the appropriate dashboard based on the user type
		if ($userType === 'admin') {
			header("Location: admin/dashboard.php");
			exit();
		} else if ($userType === 'student') {
			header("Location: student/dashboard.php");
			exit();
		}
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Student Event Management</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="assets1/css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="assets1/css/animate.css">

	<link rel="stylesheet" href="assets1/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets1/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="assets1/css/magnific-popup.css">

	<link rel="stylesheet" href="assets1/css/aos.css">

	<link rel="stylesheet" href="assets1/css/ionicons.min.css">

	<link rel="stylesheet" href="assets1/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="assets1/css/jquery.timepicker.css">


	<link rel="stylesheet" href="assets1/css/flaticon.css">
	<link rel="stylesheet" href="assets1/css/icomoon.css">
	<link rel="stylesheet" href="assets1/css/style.css">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php">Student Event Management</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="login.php" class="nav-link">Sign In</a></li>
					<li class="nav-item cta mr-md-2"><a href="registration.php" class="nav-link">Sign Up</a></li>

				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->

	<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
				<div class="col-lg-6 col-md-6 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
					<h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"> Student Events <br><span>Upcoming Event</span></h1>
					<p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="icon-calendar mr-2"></span>20-23 November 2019 - Marwadi University</p>
				</div>
				<div class="col-lg-2 col"></div>
				<div class="col-lg-4 col-md-6 mt-0 mt-md-5">
					<form action="index.php" method="post">
						<h2>Log In</h2>

						<div class="form-group mb-3">
							<label class="form-label">Email <span style="color: red;">*</span></label>
							<input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp">
						</div>
						<div class="form-group mb-4">
							<label class="form-label">Password <span style="color: red;">*</span></label>
							<input name="password" type="password" class="form-control" id="password">
						</div>
						<label for="remember">
							<input type="checkbox" id="remember" name="remember"> Remember Me
						</label>
						<div class="form-group">
							<button type="submit" name="save" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" id="save" title="Click to Save">Sign In</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<footer class="ftco-footer ftco-bg-dark ftco-section">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Student Event Management</h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
							<li class="ftco-animate"><a href="https://www.youtube.com/user/marwadieducation?reload=9"><span class="icon-youtube"></span></a></li>
							<li class="ftco-animate"><a href="https://www.facebook.com/Marwadiuniversity"><span class="icon-facebook"></span></a></li>
							<li class="ftco-animate"><a href="https://www.instagram.com/marwadi.university/"><span class="icon-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-5">
						<h2 class="ftco-heading-2">Join In</h2>
						<ul class="list-unstyled">
							<li><a href="https://www.marwadiuniversity.ac.in/blog-main-page/" class="py-2 d-block">Blogs</a></li>
							<li><a href="https://www.marwadiuniversity.ac.in/faq/" class="py-2 d-block">FAQs</a></li>
							<li><a href="https://www.marwadiuniversity.ac.in/news/" class="py-2 d-block">News</a></li>
							<li><a href="https://www.marwadiuniversity.ac.in/360-virtual-tour/" class="py-2 d-block">360 Virtual Tour</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">Marwadi University, Gujarat, India</span></li>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">Office: +912817123456</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@marwadiuniversity.ac.in</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">

					<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				</div>
			</div>
		</div>
	</footer>

	<script src="assets1/js/jquery.min.js"></script>
	<script src="assets1/js/jquery-migrate-3.0.1.min.js"></script>
	<script src="assets1/js/popper.min.js"></script>
	<script src="assets1/js/bootstrap.min.js"></script>
	<script src="assets1/js/jquery.easing.1.3.js"></script>
	<script src="assets1/js/jquery.waypoints.min.js"></script>
	<script src="assets1/js/jquery.stellar.min.js"></script>
	<script src="assets1/js/owl.carousel.min.js"></script>
	<script src="assets1/js/jquery.magnific-popup.min.js"></script>
	<script src="assets1/js/aos.js"></script>
	<script src="assets1/js/jquery.animateNumber.min.js"></script>
	<script src="assets1/js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="assets1/js/google-map.js"></script>
	<script src="assets1/js/main.js"></script>

</body>

</html>


<?php
if (isset($_POST['save'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $mysqli = new mysqli("localhost", "root", "", "student_event_manage");
  $query = @mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$email'") or die(mysqli_error($mysqli));
  $count = mysqli_num_rows($query);
  $row = mysqli_fetch_array($query);

  if ($count > 0 && password_verify($password, $row['password'])) {
    if ($row['role'] == 1) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['is_student'] = 1;
      $_SESSION['is_admin'] = 0;
      setcookie("email", $row['email'], time() + (86400 * 30), "/"); // Cookie expires in 30 days
      setcookie("user_id", $row['user_id'], time() + (86400 * 30), "/"); // Cookie expires in 30 days

      if (isset($_POST['remember'])) {
        // Determine the user type (admin or student)
        $userType = 'student';

        // Set a cookie with the token and user type
        setcookie('remember_me', $userType, time() + (86400 * 30), "/"); // Cookie expires in 30 days
        print_r($_COOKIE['remember_me']);
      }
?>
      <script>
        window.location = "student/dashboard.php";
      </script>
    <?php
    } else if ($row['role'] == 2) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['is_student'] = 0;
      $_SESSION['is_admin'] = 1;
      setcookie("email", $row['email'], time() + (86400 * 30), "/"); // Cookie expires in 30 days
      setcookie("user_id", $row['user_id'], time() + (86400 * 30), "/"); // Cookie expires in 30 days

      if (isset($_POST['remember'])) {
        // Determine the user type (admin or student)
        $userType = 'admin';

        // Set a cookie with the token and user type
        setcookie('remember_me', $userType, time() + (86400 * 30), "/"); // Cookie expires in 30 days
        print_r($_COOKIE['remember_me']);
      }
    ?>
      <script>
        window.location = "admin/dashboard.php";
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Wrong Data Entered");
      window.location = "index.php";
    </script>
<?php
  }
}
?>