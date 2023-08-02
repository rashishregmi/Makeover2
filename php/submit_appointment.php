<?php
echo "appointment.php is being executed";

include '../php/connection.php';

// Add code to insert data into the 'users' table
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$contact = $_POST['contact'];
$email = $_POST['email'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, contact, email) 
                       VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssss", $firstName, $lastName, $contact, $email);

if ($stmt->execute()) {
    echo "User data added to the users table successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

// Continue with the code to insert data into the 'appointments' table

$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender'];
$selectedTime = $_POST['myDate'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssss", $firstName, $lastName, $contact, $email, $services, $selectedDate, $selectedTime);

if ($stmt->execute()) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>
