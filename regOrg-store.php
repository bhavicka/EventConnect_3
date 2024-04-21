<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Mihir6487@";
$dbname = "nirma";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$organization = $_POST['organization'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$location = $_POST['location'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Prepare SQL statement
$sql = "INSERT INTO Organizers (organization, email, mobile, location, password) 
        VALUES (?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $organization, $email, $mobile, $location, $password);

// Execute SQL statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
