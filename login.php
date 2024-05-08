<!doctype html>
<html lang="en">

<head>
  <title>Sign In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <h2><strong>Marwadi University</strong></h2>
                </a>
                <p class="text-center">Sign In Page</p>
                <form action="login.php" method="post" onsubmit="return validateForm()">
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
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">New to platform?</p>
                  <a class="text-primary fw-bold ms-2" href="registration.php">Create an account</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function validateForm() {
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

      // Check if fields are empty
      if (email == "" || password == "") {
        alert("All fields are required");
        return false;
      }

      // Check password length
      if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
      }

      // Check email format (basic validation)
      var emailPattern = /^[a-zA-Z]+[.][a-zA-Z]+[0-9]+@marwadiuniversity\.ac\.in$/;
      var $emailTeacherPattern = /^[a-z]+[.][a-z]+@marwadieducation\.edu\.in$/;
      if(!(emailPattern.test(email)||emailTeacherPattern.test(email))) {
        alert("Invalid email format");
        return false;
      }

      // Validation passed
      return true;
    }
  </script>
</body>

</html>

<?php
session_start();

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
      window.location = "login.php";
    </script>
<?php
  }
}
?>