<?php
session_start();
require '../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are provided
    if (isset($_POST["email1"]) && isset($_POST["password1"])) {
        $email = $_POST["email1"];
        $password = $_POST["password1"];

        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Login successful, redirect to the appointment page
            header("Location: http://localhost/Makeover/html/Appointment2.html");
            exit;
        } else {
            // Login failed, redirect back to the login page with an error message
            header("Location: http://localhost/Makeover/html/login.html#");
            exit;
        }
        $stmt->close();
    } else {
        // Missing required fields: email or password
        header("Location: http://localhost/Makeover/html/login.html#");
        exit;
    }
}

$conn->close();
?>
