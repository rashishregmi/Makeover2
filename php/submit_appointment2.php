<?php
echo "submit_appointment2.php is being executed";

include '../php/connection.php';

$fullname = $_POST['fullname3'];
$contact = $_POST['contact3'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender3'];
$selectedTime = $_POST['myDate3'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (username, email) 
                       VALUES (?, ?)");

$stmt->bind_param("ss", $fullname, $contact);

if ($stmt->execute()) {
    $lastUserId = $stmt->insert_id;

    // Continue with the code to insert data into the 'appointments' table
    $stmt = $conn->prepare("INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time, username, fullname) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $emptyValue = '';
    $stmt->bind_param("sssssssss", $fullname, $emptyValue, $contact, $emptyValue, $services, $selectedDate, $selectedTime, $fullname, $fullname);

    if ($stmt->execute()) {
        // Data insertion into 'appointments' table successful
        $lastAppointmentId = $stmt->insert_id;

        // Continue with the code to transfer data to 'tblcustomers' table in 'makeover_admin' database
        $stmt = $conn->prepare("INSERT INTO makeover_admin.tblcustomers (Name, Email, MobileNumber, Details) 
                               VALUES (?, ?, ?, ?)");

        $stmt->bind_param("ssss", $fullname, $contact, $contact, $services);

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
