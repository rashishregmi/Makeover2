<?php
echo "submit_appointment2.php is being executed";

include '../php/connection.php';

$fullname = $_POST['fullname3'];
$contact = $_POST['contact3'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender3'];
$selectedTime = $_POST['myDate3'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO appointments (fullname, contact, services, selected_date, selected_time) 
                       VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("sssss", $fullname, $contact, $services, $selectedDate, $selectedTime);

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
