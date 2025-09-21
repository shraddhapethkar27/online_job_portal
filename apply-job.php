<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name  = $_POST['full_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $resume_url = $_POST['resume_url'];
    $message    = $_POST['message'];

    // get job_id from URL (e.g. jobs.php?job_id=3 → apply-job.html?job_id=3)
    $job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;

    if ($job_id > 0) {
        $sql = "INSERT INTO applications (job_id, full_name, email, phone, resume_url, message) 
                VALUES ('$job_id', '$full_name', '$email', '$phone', '$resume_url', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "✅ Application submitted successfully!";
            // optional redirect after success:
            // header("Location: jobs.php?success=1");
            // exit();
        } else {
            echo "❌ Error: " . $conn->error;
        }
    } else {
        echo "❌ Invalid Job ID!";
    }
}

$conn->close();
?>
