<?php
echo "submit_appointment.php is being executed";
include '../php/connection.php';

// Check if the required form fields are set and not empty
if (
    isset($_POST['firstname']) && !empty($_POST['firstname']) &&
    isset($_POST['lastname']) && !empty($_POST['lastname']) &&
    isset($_POST['contact']) && !empty($_POST['contact']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['topics']) && is_array($_POST['topics'])
) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $services = implode(", ", $_POST['topics']); // Convert the array to a string using implode
    $selectedDate = $_POST['myCalender'];
    $selectedTime = $_POST['myDate'];
    $fullname = $firstName . " " . $lastName; // Concatenate the full name separately
    $username = $firstName . $lastName; // Combine first name and last name to create the username

    // Check if the user already exists in the 'users' table based on email
    $getUserSQL = "SELECT user_id FROM users WHERE email = ?";
    $stmtGetUser = $conn->prepare($getUserSQL);
    $stmtGetUser->bind_param("s", $email);
    $stmtGetUser->execute();
    $getUserResult = $stmtGetUser->get_result();

    if ($getUserResult->num_rows > 0) {
        // User already exists, update the user data in the 'users' table
        $updateUserSQL = "UPDATE users SET firstname = ?, lastname = ?, contact = ? WHERE email = ?";
        $stmtUpdateUser = $conn->prepare($updateUserSQL);
        $stmtUpdateUser->bind_param("ssss", $firstName, $lastName, $contact, $email);

        if (!$stmtUpdateUser->execute()) {
            echo "Error: " . $stmtUpdateUser->error;
            exit;
        }

        // Get the user_id from the existing user
        $userRow = $getUserResult->fetch_assoc();
        $user_id = $userRow['user_id'];
    } else {
        // User does not exist, insert into the 'users' table first
        $insertUserSQL = "INSERT INTO users (firstname, lastname, contact, email,services) VALUES (?, ?, ?, ?, ?)";
        $stmtInsertUser = $conn->prepare($insertUserSQL);
        $stmtInsertUser->bind_param("sssss", $firstName, $lastName, $contact, $email, $services);

        if ($stmtInsertUser->execute()) {
            // User inserted successfully, get the newly created user_id
            $user_id = $stmtInsertUser->insert_id;
        } else {
            echo "Error: " . $stmtInsertUser->error;
            exit;
        }

        $stmtInsertUser->close(); // Close the statement after use
    }

    // Continue with the code to insert data into the 'appointments' table
    $aptNumber = mt_rand(100000000, 999999999);
    $stmtAppointments = $conn->prepare("INSERT INTO appointments (user_id, first_name, last_name, contact, email, services, selected_date, selected_time, username,AptNumber) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmtAppointments->bind_param("issssssssi", $user_id, $firstName, $lastName, $contact, $email, $services, $selectedDate, $selectedTime, $username,$aptNumber);

    if ($stmtAppointments->execute()) {
        
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
        echo "Error: " . $stmtAppointments->error;
    }

    $stmtAppointments->close();
     
    $stmtCustomers->close();
   
} else {
    echo "Error: Please fill in all required fields.";
}
if ($stmtUpdateUser !== null) {
    $stmtUpdateUser->close();
}

$conn->close();

header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>
