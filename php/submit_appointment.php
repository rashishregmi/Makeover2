<?php
echo "appointment.php is being executed";
include '../php/connection.php';

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender'];
$selectedTime = $_POST['myDate'];
$fullname = $firstName . " " . $lastName; // Concatenate the full name separately

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (username, email, firstname, lastname, contact) 
                       VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("sssss", $firstName, $email, $firstName, $lastName, $contact);

if ($stmt->execute()) {
    // Data insertion into 'users' table successful
    $lastUserId = $stmt->insert_id;

    // Continue with the code to insert data into the 'appointments' table
    $stmt = $conn->prepare("INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time, username, fullname) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssss", $firstName, $lastName, $contact, $email, $services, $selectedDate, $selectedTime, $firstName, $fullname);

    if ($stmt->execute()) {
        // Data insertion into 'appointments' table successful
        $lastAppointmentId = $stmt->insert_id;

        // Continue with the code to transfer data to 'tblcustomers' table in 'makeover_admin' database
        $aptNumber = mt_rand(100000000, 999999999); // Generate a random 9-digit number for AptNumber
        $stmt = $conn->prepare("INSERT INTO makeover_admin.tblappointment (AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("issssss", $aptNumber, $fullname, $email, $contact, $selectedDate, $selectedTime, $services);

        if ($stmt->execute()) {
            // Data transferred successfully to 'tblcustomers' table in 'makeover_admin' database
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>
