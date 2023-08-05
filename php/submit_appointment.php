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
$stmtUsers = $conn->prepare("INSERT INTO users (username, email, firstname, lastname, contact) 
                            VALUES (?, ?, ?, ?, ?)");

$stmtUsers->bind_param("sssss", $fullname, $email, $firstName, $lastName, $contact);

if ($stmtUsers->execute()) {
    // Data insertion into 'users' table successful
    $lastUserId = $stmtUsers->insert_id;

    // Continue with the code to insert data into the 'appointments' table
    $stmtAppointments = $conn->prepare("INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time, username) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmtAppointments->bind_param("ssssssss", $firstName, $lastName, $contact, $email, $services, $selectedDate, $selectedTime, $firstName);

    if ($stmtAppointments->execute()) {
        // Data insertion into 'appointments' table successful
        $lastAppointmentId = $stmtAppointments->insert_id;

        // Continue with the code to transfer data to 'tblappointments' table in 'makeover_admin' database
        $aptNumber = mt_rand(100000000, 999999999); // Generate a random 9-digit number for AptNumber
        $stmtTblAppointments = $conn->prepare("INSERT INTO makeover_admin.tblappointment (AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services) 
                                              VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmtTblAppointments->bind_param("issssss", $aptNumber, $fullname, $email, $contact, $selectedDate, $selectedTime, $services);

        if ($stmtTblAppointments->execute()) {
            // Data transferred successfully to 'tblappointment' table in 'makeover_admin' database
            // Continue with the code to transfer data to 'tblcustomers' table in 'makeover_admin' database
            $stmtCustomers = $conn->prepare("INSERT INTO makeover_admin.tblcustomers (Name, Email, MobileNumber, Details) 
                                            VALUES (?, ?, ?, ?)");

            $stmtCustomers->bind_param("ssss", $fullname, $email, $contact, $services);

            if ($stmtCustomers->execute()) {
                // Data transferred successfully to 'tblcustomers' table in 'makeover_admin' database
                echo "Appointment booked successfully!";
            } else {
                echo "Error: " . $stmtCustomers->error;
            }
        } else {
            echo "Error: " . $stmtTblAppointments->error;
        }
    } else {
        echo "Error: " . $stmtAppointments->error;
    }
} else {
    echo "Error: " . $stmtUsers->error;
}

$stmtUsers->close();
$stmtAppointments->close();
$stmtTblAppointments->close();
$conn->close();

header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>
