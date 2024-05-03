<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "student_event_manage");

if (!isset($_SESSION['user_id'])) {
    header("location:../login.php");
} else {
    $userId = $_SESSION['user_id'];
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
            <?php
            $eventId = $_GET['event_id'];
            $query = @mysqli_query($mysqli, "SELECT * FROM events WHERE event_id = '$eventId'") or die(mysqli_error($mysqli));
            $count = mysqli_num_rows($query);
            $row = mysqli_fetch_array($query);

            $organizerId = $row['organizer_id'];
            $organizerDet = @mysqli_query($mysqli, "SELECT * FROM users WHERE user_id = '$organizerId'") or die(mysqli_error($mysqli));
            $count = mysqli_num_rows($organizerDet);
            $organizerDetails = mysqli_fetch_array($organizerDet);
            ?>
            <div class="container-fluid">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 fs-5">Event Details</h5>
                            <h5 class="fw mb-3 fs-4"> Name : <?php echo $row['event_name'] ?></h5>
                            <h5 class="fw mb-3 fs-4"> Description : <?php echo $row['event_description'] ?></h5>
                            <h5 class="fw mb-3 fs-4"> Organizer Name : <?php echo $organizerDetails['first_name'] ."   ". $organizerDetails['last_name'] ?></h5>
                            <h5 class="fw mb-3 fs-4"> Event Date : <?php echo $row['event_date'] ?></h5>
                            <h5 class="fw mb-3 fs-4"> Start Time : <?php echo $row['event_start_time'] ?></h5>
                            <h5 class="fw mb-3 fs-4"> End Time : <?php echo $row['event_end_time'] ?></h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 fs-5 ">Update your presence for event</h5>
                            <form action="registerforevent.php?event_id=<?php echo urlencode($eventId); ?>" method="post">
                                <div class="form-group mb-3">
                                    <label class="form-label fs-4">Presence</label>
                                    <div>
                                        <input type="radio" name="presentstatus" value="1" class="form-check-input" id="presentRadio"> <span style="margin-left: 2px;">Will be attending</span></input>
                                        <input type="radio" name="presentstatus" value="2" class="form-check-input" style="margin-left: 20px;" id="absentRadio"> <span style="margin-left: 2px;"> Will not be attending </span></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="save" class="btn btn-primary w-20 py-8 fs-4 mb-4 rounded-2" id="save" title="Click to Save">Save</button>
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
    $approveStatus = $_POST['presentstatus'];
    $currentDate = date("Y-m-d");

    $alreadyRespondent = @mysqli_query($mysqli, "SELECT * FROM event_attendees_replies WHERE event_id = '$eventId'") or die(mysqli_error($mysqli));
	$count = mysqli_num_rows($alreadyRespondent);

    if($count > 0){
        $updateEvent = @mysqli_query($mysqli, "UPDATE event_attendees_replies SET link_reply = '$approveStatus' 
            WHERE event_id = '$eventId' AND user_id = '$userId'") or die(mysqli_error($mysqli));
    } else {
        $insertEventReply = @mysqli_query($mysqli, "INSERT INTO event_attendees_replies(event_id, user_id, link_reply) 
            VALUES('$eventId', '$userId', '$approveStatus')") or die(mysqli_error($mysqli));
    }

    ?>
    <script>
        alert('Saved Successfully');
        window.location = "upcomingevents.php";
    </script>
<?php
}
?>