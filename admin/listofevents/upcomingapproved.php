<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "student_event_manage");

if (!isset($_SESSION['user_id'])) {
    header("location:../../login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List OF Events</title>
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
                                        <!-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a> -->
                                        <a href="../../logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
                            <h5 class="card-title fw-semibold mb-4">List Of Events (Approved)</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="width: 50px;">
                                                <h6 class="fw-semibold mb-0">Sr. No.</h6>
                                            </th>
                                            <th class="border-bottom-0" style="max-width: 100px;">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0" style="width: 200px;">
                                                <h6 class="fw-semibold mb-0">Description</h6>
                                            </th>
                                            <th class="border-bottom-0" style="min-width: 5px;">
                                                <h6 class="fw-semibold mb-0">Organizer</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Event Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Start Time</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">End Time</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Review</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Update</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <?php
                                        $query = @mysqli_query($mysqli, "SELECT * FROM events WHERE status = 1") or die(mysqli_error($mysqli));
                                        $count = mysqli_num_rows($query);  
                                        while($row = mysqli_fetch_array($query)){
                                            $organizername = @mysqli_query($mysqli, "SELECT first_name, last_name FROM users WHERE user_id = {$row['organizer_id']}") or die(mysqli_error($mysqli));
                                            $organizername = mysqli_fetch_array($organizername);
                                            $i = 1;
                                            echo "<tr>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-0'>".$i."</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-1'>".$row['event_name']."</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw mb-1'>".$row['event_description']."</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-1'>".$organizername['first_name']."  ".$organizername['last_name']."</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-1'>".$row['event_date']."</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-1'>".$row['event_start_time']."</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-1'>".$row['event_end_time']."</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-1'>".$row['added_msg']."</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-1'>Approved</h6>";
                                            echo "</td>";
                                            echo "<td class='border-bottom-0'>";
                                            echo "<h6 class='fw-semibold mb-1'>
                                            <a class='btn btn-primary mb-1 fs-2 p-2' href='eventstatusedit.php?event_id={$row['event_id']}'>Update</a></h6>";
                                            echo "</td>";
                                            echo "</tr>";
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
</body>

</html>