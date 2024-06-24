<?php
// Database connection settings
$servername = "attendancemsystem.cxueocagesiq.ap-southeast-2.rds.amazonaws.com";
$username = "admin";
$password = "October92002";
$dbname = "attsystem";

// Establishing connection with the RDS database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";
?>
