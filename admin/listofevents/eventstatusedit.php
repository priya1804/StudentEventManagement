<?php
session_start();
require_once '../../sendEmails.php';

$mysqli = new mysqli("localhost", "root", "", "student_event_manage");

if (!isset($_SESSION['user_id'])) {
    header("location:../../login.php");
}

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    $adminId = $_SESSION['user_id'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Of Events</title>
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
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
                            <a class="sidebar-link" href="../dashboard.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">List Of Events</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./approvalneeded.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Upcoming (Pending)</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./upcomingapproved.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Upcoming (Approved)</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./upcomingrejected.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Upcoming(Rejected)</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./pastevents.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Past Events</span>
                            </a>
                        </li>

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Users</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../users.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Users Listing</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../organizers.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Organizers Listing</span>
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
            <header class="app-header">
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
                                    <img src="../../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="../../logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

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
                            <h5 class="fw mb-3 fs-4"> Organizer Name : <?php echo $organizerDetails['first_name'] . $organizerDetails['last_name'] ?></h5>
                            <h5 class="fw mb-3 fs-4"> Date : <?php echo $row['event_date'] ?></h5>
                            <h5 class="fw mb-3 fs-4"> Start Time : <?php echo $row['event_start_time'] ?></h5>
                            <h5 class="fw mb-3 fs-4"> End Time : <?php echo $row['event_end_time'] ?></h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 fs-5 ">Update Status For Event</h5>
                            <form action="eventstatusedit.php?event_id=<?php echo urlencode($eventId); ?>" method="post">
                                <div class="form-group mb-3">
                                    <label class="form-label fs-4">Approve</label>
                                    <div>
                                        <input type="radio" name="approvestatus" value="1" <?php echo ($row['status'] == 1 ? "checked": "") ?> class="form-check-input" id="approveRadio"> <span style="margin-left: 2px;">Approve</span></input>
                                        <input type="radio" name="approvestatus" value="2" <?php echo ($row['status'] == 2 ? "checked": "") ?> class="form-check-input" style="margin-left: 20px;" id="rejectRadio"> <span style="margin-left: 2px;"> Reject </span></input>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label fs-4">Message to show to organizer</label>
                                    <input type="text" class="form-control" name="addedMsg">
                                </div>
                                <div class="form-group mb-3" id="roomNumberField" style="display: none;">
                                    <label class="form-label fs-4">Room No</label>
                                    <input type="text" class="form-control" name="allocatedVenue" id="roomNumberInput" required>
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
        <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/sidebarmenu.js"></script>
        <script src="../../assets/js/app.min.js"></script>
        <script src="../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
        <script src="../../assets/js/dashboard.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get references to radio buttons and room number field
                var approveRadio = document.getElementById('approveRadio');
                var rejectRadio = document.getElementById('rejectRadio');
                var roomNumberField = document.getElementById('roomNumberField');

                // Add event listener to approve radio button
                approveRadio.addEventListener('change', function() {
                    if (this.checked) {
                        // If approve radio button is checked, show room number field
                        roomNumberField.style.display = 'block';
                        roomNumberInput.required = true;
                    }
                });

                // Add event listener to reject radio button
                rejectRadio.addEventListener('change', function() {
                    if (this.checked) {
                        // If reject radio button is checked, hide room number field
                        roomNumberField.style.display = 'none';
                        roomNumberInput.required = false;
                    }
                });
            });
        </script>
</body>

</html>

<?php
if (isset($_POST['save'])) {
    $approveStatus = $_POST['approvestatus'];
    $addedMsg = $_POST['addedMsg'];
    $allocatedVenue = $_POST['allocatedVenue'];
    $currentDate = date("Y-m-d");

    if ($approveStatus == 1 && $allocatedVenue == "") {
?>
        <script>
            alert('As event is approved allocated room number cannot be null');
        </script>
    <?php
    }

    if($approveStatus == 1 && $allocatedVenue != ""){
        $updateEvent = @mysqli_query($mysqli, "UPDATE events SET approved_by = '$adminId', status = '$approveStatus', allocated_venue = '$allocateVenue',
        added_msg = '$addedMsg', updated_at = '$currentDate' WHERE event_id = '$eventId'") or die(mysqli_error($mysqli));
        if($updateEvent){
            $eventDetails = @mysqli_query($mysqli, "SELECT * FROM events WHERE event_id = '$eventId'") or die(mysqli_error($mysqli));
            sendMailForEventReg(array("priyashukla@gmail.com"));
        }
    }
    ?>
    <script>
        alert('Saved Successfully');
        window.location = "upcomingapproved.php";
    </script>
<?php
}
?>