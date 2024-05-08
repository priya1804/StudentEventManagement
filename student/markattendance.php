<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "student_event_manage");

if (!isset($_SESSION['user_id'])) {
    header("location:../login.php");
} else {
    $studentId = $_SESSION['user_id'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="dashboard.php" class="text-nowrap logo-img">
                        <h3>Marwadi University</h3>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./dashboard.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">LIST OF EVENTS</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./upcomingevents.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Upcoming Events</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./organizer.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Organizer</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Attendance</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./markattendance.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Mark Attendance</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./pastattendent.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Past Attendent</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header" style="box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="../logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="container-fluid">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-5">Mark attendance for event</h5>
                            <form action="markattendance.php" method="post">
                                <div class="mb-5">
                                    <?php
                                    $currDate = date("Y-m-d");
                                    $query = @mysqli_query($mysqli, "SELECT * FROM events WHERE status = 1 AND organizer_id != '$studentId' AND event_date <= '$currDate'") or die(mysqli_error($mysqli));
                                    $count = mysqli_num_rows($query);

                                    // Check if any rows were returned
                                    if ($count> 0) {
                                        // Output data of each row
                                        echo '<label for="exampleInputEmail1" class="form-label">Event List</label>';
                                        echo '<select name="event_id_selected" id="disabledSelect" class="form-select">';
                                        echo '<option value="">Select</option>';
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo '<option value=' .$row['event_id'] .'>' . $row['event_name'] . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo "No events found.";
                                    }
                                    ?>                                    
                                </div>
                                <div class="mb-5">
                                    <label for="exampleInputEmail1" class="form-label">Mark attendance</label>
                                    <div>
                                        <input name="eventRadio" type="radio" checked value="1" class="form-check-input"> <span style="margin-left: 2px;">Yes</span></input>
                                        <input name="eventRadio" type="radio" value="2" class="form-check-input" style="margin-left: 20px;"> <span style="margin-left: 2px;"> No </span></input>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="exampleInputPassword1" class="form-label">Feedback</label>
                                    <input type="text" name="feedback_msg" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button type="submit" name="save" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
        <script src="../assets/js/dashboard.js"></script>
</body>

</html>

<?php
if(isset($_POST['save'])){
    $eventId = $_POST['event_id_selected'];
    echo "eventId".$studentId;
    $eventAttended = $_POST['eventRadio'];
    $feedback = $_POST['feedback_msg'];

    mysqli_query($mysqli, "INSERT INTO attendance(user_id,event_id,is_present) 
        VALUES('$studentId','$eventId','$eventAttended')") or die(mysqli_error($mysqli));

    if($feedback != ""){
        mysqli_query($mysqli, "INSERT INTO ratings(user_id,event_id,feedback_msg) 
        VALUES('$studentId','$eventId','$feedback')") or die(mysqli_error($mysqli));
    }

    header("location:pastattendent.php");
}
?>