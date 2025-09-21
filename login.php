<?php
include 'db_connect.php'; // your connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    // check if user exists
    $sql = "SELECT * FROM users WHERE email='$email' AND role='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // verify hashed password
        if (password_verify($password, $row['password'])) {
            echo "✅ Welcome back, " . $row['full_name'] . " (" . $row['role'] . ")";
            // later you can redirect to dashboard:
            // header("Location: dashboard.html");
            // exit();
        } else {
            echo "❌ Incorrect password!";
        }
    } else {
        echo "❌ No user found with this email & role!";
    }
}
$conn->close();
?>