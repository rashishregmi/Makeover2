<?php
require '../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];

    // Prepare the query to check if a user with the same username or email exists
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User with the same username or email already exists
        echo "true";
    } else {
        // User with the same username or email does not exist
        echo "false";
    }
    $stmt->close();
}
?>
