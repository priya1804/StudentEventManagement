<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "student_event_manage");

if (!isset($_SESSION['user_id'])) {
    header("location:../login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
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
                            <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
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
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="container-fluid">
                <div class="col-lg-12 d-flex align-items-stretch w-50">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-5">New Event</h5>
                            <form action="addnewevent.php" method="post">
                                <div class="form-group mb-4">
                                    <label class="form-label">Event Name</label>
                                    <input name="event_name" type="text" class="form-control w-100" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Event Description</label>
                                    <textarea class="form-control w-100" name="event_desc" placeholder="Enter text ..." style="width: 810px; height: 200px" required></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Event Date</label>
                                    <input class="form-control w-100" type="date" name="event_date" required>
                                </div>

                                <div style="display: flex; width: 100%;">
                                    <div class="form-group mb-4">
                                        <label class="form-label">Start Time</label>
                                        <input class="form-control w-100" type="text" name="start_time" required placeholder="HH:MM (Duration)">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label">End Minute</label>
                                        <input class="form-control w-100" type="text" name="end_time" required placeholder="HH:MM (Duration)">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Registration Close Date</label>
                                    <input class="form-control w-100" type="date" name="reg_close_date" required placeholder="HH:MM (Duration)">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Registration Closing Time</label>
                                    <input class="form-control w-100" type="text" name="reg_closing_time" required placeholder="HH:MM (Duration)">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="save" class="btn btn-primary w-20 py-8 fs-4 mb-4 rounded-2" id="save" title="Click to Save">Request</button>
                                </div>
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
if (isset($_POST['save'])) {
    $eventName = $_POST['event_name'];
    $eventDesc = $_POST['event_desc'];
    $eventDate = $_POST['event_date'];
    $eventStartTime = $_POST['start_time'];
    $eventEndTime = $_POST['end_time'];
    $regClosingDate = $_POST['reg_close_date'];
    $regclosingTime = $_POST['reg_closing_time'];
    $userId = $_SESSION['user_id'];

    $currentDate = date("Y-m-d");
    $currenTime = time();

    $query = @mysqli_query($mysqli, "SELECT * FROM events WHERE event_name = '$eventName'") or die(mysqli_error($mysqli));
    $count = mysqli_num_rows($query);

    if ($count > 0) { ?>
        <script>
            alert('Event Name already exists');
        </script>
    <?php
    } else {
        $insertionEvent = mysqli_query($mysqli, "INSERT INTO events(event_name,event_description,organizer_id,status,created_at,updated_at,event_date,
        event_start_time,event_end_time,registration_closing_date,registration_closing_time,batch_id) 
        VALUES('$eventName', '$eventDesc', '$userId', 1, '$currenTime', '$currenTime', '$eventDate', 
        '$eventStartTime', '$eventEndTime', '$regClosingDate', '$regclosingTime', 1)") or die(mysqli_error($mysqli));

        print_r($insertionEvent);
    ?>
        <script>
            alert('Event Registered Successfull');
            window.location = "organizer.php";
        </script>
<?php
    }
}
?>