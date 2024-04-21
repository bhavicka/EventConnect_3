<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = "Mihir6487@"; // Change this to your database password
$dbname = "nirma"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if eventId is set in the URL query string
if(isset($_GET['EventID'])) {
    $eventId = $_GET['EventID'];

    // Prepare SQL statement to delete the event based on eventId
    $sql = "DELETE FROM createevent WHERE EventID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventId);
    
    // Execute the statement
    if ($stmt->execute()) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error deleting event: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
