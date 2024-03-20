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
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <h2><strong>Marwadi University</strong></h2>
                </a>
                <p class="text-center">Your Key</p>
                <form action="login.php" method="post">
                  <div class="form-group mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                  </div>
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
</body>

</html>

<?php
if (isset($_POST['save'])){
$email= $_POST['email'];
$password = $_POST['password'];
$hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

$mysqli = new mysqli("localhost","root","","student_event_manage");
$query = @mysqli_query($mysqli,"SELECT * FROM users WHERE email = '$email'")or die(mysqli_error($mysqli));
$count = mysqli_num_rows($query);
$row = mysqli_fetch_array($query);

if($count > 0 && password_verify($password,$row['password'])){
  ?>

  <script>
    window.location = "student/dashboard.php";
    $.jGrowl("Student Logged In added", { header: 'Staff add' });
  </script>

  <?php 
}else{
?>
<script>
alert("Wrong Data Entered");
window.location = "login.php";
$.jGrowl("Wrong Data Entered", { header: 'Staff add' });
</script>
<?php
}
}
?>