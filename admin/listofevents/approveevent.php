<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "student_event_manage");

if (!isset($_SESSION['user_id'])) {
    header("location:../../login.php");
}
?>

