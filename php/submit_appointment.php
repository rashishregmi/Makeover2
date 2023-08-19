<?php
echo "submit_appointment.php is being executed";
require '../php/connection.php';

// Check if the required form fields are set and not empty
if (
    isset($_POST['firstname']) && !empty($_POST['firstname']) &&
    isset($_POST['lastname']) && !empty($_POST['lastname']) &&
    isset($_POST['contact']) && !empty($_POST['contact']) &&
    isset($_POST['topics']) && is_array($_POST['topics'])
) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $contact = $_POST['contact'];

    $services = implode(", ", $_POST['topics']); // Convert the array to a string using implode
    $selectedDate = $_POST['myCalender'];
    $selectedTime = $_POST['myDate'];
     
     
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Retrieve the user_id from the session
    } else {
        // Handle the case when user_id is not available in the session
        echo "Error: User ID not available.";
        exit;
    }
    // Continue with the code to insert data into the 'appointments' table
    $aptNumber = mt_rand(100000000, 999999999);
    $stmtAppointments = $conn->prepare("INSERT INTO appointments (user_id, first_name, last_name, contact, services, selected_date, selected_time,AptNumber) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmtAppointments->bind_param("issssssi", $user_id, $firstName, $lastName, $contact, $services, $selectedDate, $selectedTime, $aptNumber);

    if ($stmtAppointments->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmtAppointments->error;
    }

    $stmtAppointments->close();

    if (isset($stmtUpdateUser)) {
        $stmtUpdateUser->close();
    }

    $conn->close();

    header("Location: http://localhost/Makeover/Appointment.php");
    exit;
} else {
    echo "Error: Please fill in all required fields.";
}
?>
