<?php
session_start();
echo "submit_appointment2.php is being executed";

include '../php/connection.php';

$fullname = $_POST['fullname3'];
$contact = $_POST['contact3'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender3'];
$selectedTime = $_POST['myDate3'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (fullname, contact) 
                       VALUES (?, ?)");

$stmt->bind_param("ss", $fullname, $contact);

if ($stmt->execute()) {
    $lastUserId = $stmt->insert_id;

    // Fetch the email from the 'users' table in the 'makeover' database using the 'username' (assuming it's stored in the $_SESSION['username'] variable)
    $username = $_SESSION['username']; // Assuming the username is stored in the session
    $stmt = $conn->prepare("SELECT email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
    } else {
        // Handle the case when the user with the given username is not found
        echo "Error: User not found!";
        exit;
    }

    // Continue with the code to insert data into the 'appointments' table
    $stmt = $conn->prepare("INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time, username, fullname) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $emptyValue = '';
    $stmt->bind_param("sssssssss", $emptyValue, $emptyValue, $contact, $email, $services, $selectedDate, $selectedTime, $username, $fullname);

    if ($stmt->execute()) {
        // Data insertion into 'appointments' table successful
        $lastAppointmentId = $stmt->insert_id;

        // Continue with the code to transfer data to 'tblcustomers' table in 'makeover_admin' database
        $stmt = $conn->prepare("INSERT INTO makeover_admin.tblcustomers (AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services, Status, Remark) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $status = "Pending"; // Default status, you can change it to whatever default status you want
        $emptyValue = '';
        $stmt->bind_param("sssssssss", $lastAppointmentId, $fullname, $email, $contact, $selectedDate, $selectedTime, $services, $status, $emptyValue);

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
