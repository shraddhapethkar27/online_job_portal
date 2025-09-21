<?php
// JobLink Database Connection File
$host   = "127.0.0.1";      // Database server (or "localhost")
$user   = "Job_Portal";     // MySQL username (created for this project)
$pass   = "jobportal321";   // Password for the MySQL user
$dbname = "joblink_db";     // Database name created in MySQL

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    // If connection fails, stop execution and show error
    die("❌ Database connection failed: " . $conn->connect_error);
} else {
    // If successful, you can uncomment the line below for testing
    // echo "✅ Connected successfully!";
}
?>

