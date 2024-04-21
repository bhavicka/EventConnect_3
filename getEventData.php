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

// Prepare SQL statement to select specific information from the createevent table
$sql = "SELECT EventID,EventName, EventDate, EventLocation, TicketPrice, eventImage FROM createevent";
 // Modify this query as per your requirements
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data as JSON
    $events = array();
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
} else {
    echo "No events found";
}

// Close connection
$conn->close();
?>
