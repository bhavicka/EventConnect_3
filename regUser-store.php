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
$fullname = $_POST['fullname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$location = $_POST['location'];
$gender = $_POST['gender'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Prepare SQL statement
$sql = "INSERT INTO Users (fullname, lastname, email, mobile, location, gender, password, username) 
        VALUES ('$fullname', '$lastname', '$email', '$mobile', '$location', '$gender', '$password', '$username')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
