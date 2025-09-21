<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role     = $_POST['role'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // If Job Seeker
    if ($role === "job_seeker") {
        $full_name  = $_POST['full_name'];
        $resume_url = $_POST['resume_url'] ?? null;

        // Insert into users table
        $sql = "INSERT INTO users (full_name, email, password, role) 
                VALUES ('$full_name', '$email', '$password', 'job_seeker')";

        if ($conn->query($sql) === TRUE) {
            echo "✅ Job Seeker registered successfully!";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    }

    // If Recruiter
    elseif ($role === "recruiter") {
        $company_name   = $_POST['company_name'];
        $contact_person = $_POST['full_name']; // recruiter’s name

        // Insert recruiter into users table first
        $sql = "INSERT INTO users (full_name, email, password, role) 
                VALUES ('$contact_person', '$email', '$password', 'recruiter')";

        if ($conn->query($sql) === TRUE) {
            $recruiter_id = $conn->insert_id; // last inserted user_id

            // Insert company info
            $sql_company = "INSERT INTO companies (recruiter_id, company_name, contact_person) 
                            VALUES ('$recruiter_id', '$company_name', '$contact_person')";

            if ($conn->query($sql_company) === TRUE) {
                echo "✅ Recruiter and Company registered successfully!";
            } else {
                echo "❌ Recruiter added, but error in company: " . $conn->error;
            }
        } else {
            echo "❌ Error in recruiter registration: " . $conn->error;
        }
    }
}

$conn->close();
?>
