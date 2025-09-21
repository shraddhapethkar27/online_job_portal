<?php
include 'db_connect.php'; // connect to database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (name, email, message) 
            VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Thank you, your message has been sent!";
        // optional: redirect back to contact page
        // header("Location: contact.html?success=1");
        // exit();
    } else {
        echo "❌ Error: " . $conn->error;
    }
}

$conn->close();
?>
