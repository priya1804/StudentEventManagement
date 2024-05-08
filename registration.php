<!doctype html>
<html lang="en">

<head>
  <title>Sign Up</title>
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
                <a href="./index.php" class="text-nowrap text-center d-block w-100">
                  <h3><strong>Marwadi University</strong></h3>
                </a>
                <p class="text-center">Registration</p>
                <form action="registration.php" method="post" onsubmit="return validateForm()">
                  <div class="form-group mb-3">
                    <label for="firstName" class="form-label">First Name <span style="color: red;">*</span></label>
                    <input type="text" name="firstname" class="form-control" id="firstname" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="lastName" class="form-label">Last Name <span style="color: red;">*</span></label>
                    <input type="text" name="lastname" class="form-control" id="lastname" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="Role" class="form-label">Role <span style="color: red;">*</span></label>
                    <div>
                      <input name="role" type="radio" value="1" checked class="form-check-input" id="studentrole"> <span style="margin-left: 2px;">Student</span></input>
                      <input name="role" type="radio" value="2" class="form-check-input" style="margin-left: 20px;" id="adminrole"> <span style="margin-left: 2px;"> Admin </span></input>
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label">Contact Number <span style="color: red;">*</span></label>
                    <input type="tel" required name="contact_number" id="contactNumber" class="form-control form-control-lg" value="">
                  </div>
                  <div class="form-group mb-3">
                    <label for="Email" class="form-label">Email Address <span style="color: red;">*</span></label>
                    <input type="text" id="email" name="email" class="form-control" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="Password" class="form-label">Password <span style="color: red;">*</span></label>
                    <input type="password" name="password" class="form-control" id="password" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="save" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" id="save" title="Click to Save">Sign Up</button>
                  </div>
                </form>
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                  <a class="text-primary fw-bold ms-2" href="login.php">Sign In</a>
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
      var firstname = document.getElementById("firstname").value;
      var lastname = document.getElementById("lastname").value;
      var contactNumber = document.getElementById("contactNumber").value;
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

      // Check if fields are empty
      if (firstname == "" || lastname == "" || email == "" || contactNumber == "" || password == "") {
        alert("All fields are required");
        return false;
      }

      // Check password length
      if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
      }

      // Check if passwords match
      if (contactNumber.length < 10 && contactNumber.length > 10) {
        alert("Contact Number is not coreect");
        return false;
      }

      // Check email format (basic validation)
      var emailPattern = /^[a-z]+[.][a-z]+[0-9]+@marwadiuniversity\.ac\.in$/;
      var emailTeacherPattern = /^[a-z]+[.][a-z]+@marwadieducation\.edu\.in$/;

      if (studentrole) {
        if (!emailPattern.test(email)) {
          alert("Invalid email format");
          return false;
        }
      } else {
        if (!emailTeacherPattern.test(email)) {
          alert("Invalid email format");
          return false;
        }
      }

      // Validation passed
      return true;
    }
  </script>
</body>

</html>

<?php
if (isset($_POST['save'])) {
  $firstName = $_POST['firstname'];
  $lastName = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $contactNumber = $_POST['contact_number'];
  $currentDate = date("Y-m-d");

  $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $emailPattern = '/^[a-z]+[.][a-z]+[0-9]+@marwadiuniversity\.ac\.in$/';
  $emailTeacherPattern = '/^[a-z]+[.][a-z]+@marwadieducation\.edu\.in$/';

  if (preg_match($emailPattern, $email) !== 1 &&  $role == 1) {
?>
    <script>
      alert('Email is not correct');
      window.location('registration.php');
    </script>
  <?php
  } else if (preg_match($emailTeacherPattern, $email) !== 1 &&  $role == 2) {
  ?>
    <script>
      alert('Email is not correct');
      window.location('registration.php');
    </script>
    <?php
  } else {
    $mysqli = new mysqli("localhost", "root", "", "student_event_manage");
    $query = @mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$email'") or die(mysqli_error($mysqli));
    $count = mysqli_num_rows($query);

    if ($count > 0) { ?>
      <script>
        alert('Email already exists');
      </script>
    <?php
    } else {
      mysqli_query($mysqli, "INSERT INTO users(first_name,last_name,password,email,role,contact_number,
        created_at,updated_at,status,is_admin) 
        VALUES('$firstName','$lastName','$hashPassword','$email', '$role', '$contactNumber', '$currentDate', '$currentDate', 1, 0)") or die(mysqli_error($mysqli));
    ?>
      <script>
        alert('Registartion Successfull');
        window.location = "login.php";
      </script>
<?php
    }
  }
}
?>