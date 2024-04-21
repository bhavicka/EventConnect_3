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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $eventId = $_POST['eventId'];
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $eventLocation = $_POST['eventLocation'];
    $venue = $_POST['venue'];
    $ticketPrice = $_POST['ticketPrice'];
    $eventDescription = $_POST['eventDescription'];
    $organizerName = $_POST['eventOrganizer'];
    $organizerEmail = $_POST['organizerEmail'];
    $eventCapacity = $_POST['eventCapacity'];
    $registrationDeadline = $_POST['registrationDeadline'];

    // Prepare SQL statement to update event details
    $sql = "UPDATE createevent SET EventName=?, EventDate=?, EventTime=?, EventLocation=?, Venue=?, TicketPrice=?, EventDescription=?, OrganizerName=?, OrganizerEmail=?, EventCapacity=?, RegistrationDeadline=? WHERE eventId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssisssisi", $eventName, $eventDate, $eventTime, $eventLocation, $venue, $ticketPrice, $eventDescription, $organizerName, $organizerEmail, $eventCapacity, $registrationDeadline, $eventId);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: OrgDashboard.php");
    } else {
        echo "Error updating event: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
