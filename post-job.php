<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title       = $_POST['job_title'];
    $posted_by       = $_POST['posted_by'];
    $job_location    = $_POST['job_location'];
    $salary_lpa      = $_POST['salary_lpa'];
    $job_description = $_POST['job_description'];

    // For now, assign company_id = 1 (later link with logged-in recruiter’s company)
    $company_id = 1;

    $sql = "INSERT INTO post_jobs (company_id, job_title, job_location, salary_lpa, job_description, posted_by) 
            VALUES ('$company_id', '$job_title', '$job_location', '$salary_lpa', '$job_description', '$posted_by')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Job posted successfully!";
        // Optional: redirect back to jobs list
        // header("Location: jobs.php?posted=1");
        // exit();
    } else {
        echo "❌ Error: " . $conn->error;
    }
}

$conn->close();
?>
