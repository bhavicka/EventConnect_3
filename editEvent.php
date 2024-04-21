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

    // Prepare SQL statement to fetch event details based on eventId
    $sql = "SELECT * FROM createevent WHERE EventID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if event details are found
    if ($result->num_rows > 0) {
        // Fetch event details into an associative array
        $eventDetails = $result->fetch_assoc();
        // Extract event details into separate variables
        $eventName = $eventDetails['EventName'];
        $eventDate = $eventDetails['EventDate'];
        $eventTime = $eventDetails['EventTime'];
        $eventLocation = $eventDetails['EventLocation'];
        $venue = $eventDetails['Venue'];
        $ticketPrice = $eventDetails['TicketPrice'];
        $eventDescription = $eventDetails['EventDescription'];
        $organizerName = $eventDetails['OrganizerName'];
        $organizerEmail = $eventDetails['OrganizerEmail'];
        $eventCapacity = $eventDetails['EventCapacity'];
        $registrationDeadline = $eventDetails['RegistrationDeadline'];
    } else {
        // Handle case where event with given ID is not found
        echo "Event not found";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<div class="navbar">
    <div>
        <a href="trial.html">Home</a>
        <a href="#">Events</a>
        <a href="#">About</a>
        <a href="userLogin.php">Login As User</a>
    </div>
    <div class="brand-name">EventConnect</div> <!-- Align right -->
</div>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
         .navbar {
            background-color:  #009394;
            color: #fff;
            padding: 15px 20px; /* Increased padding */
            display: flex;
            justify-content: space-between; /* Align items horizontally */
            align-items: center; /* Align items vertically */
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            font-size: large;
        }
        .brand-name {
            font-size: 1.8em;
            font-weight: bold;
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f2f2f2;
        }
        form {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333333;
        }
        label {
            font-weight: bold;
            color: #666666;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color:  #009394;
            color: white;
            margin-top: 2vh;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color:  #009394;
        }
    </style>
</head>
<body>
    <h1>Edit Event</h1>
    <form method="post" action="updateEvent.php" enctype="multipart/form-data">
        <input type="hidden" name="eventId" value="<?php echo $eventId; ?>"> <!-- Include eventId as a hidden input field -->
        <label for="eventName">Event Name:</label><br>
        <input type="text" id="eventName" name="eventName" value="<?php echo isset($eventName) ? $eventName : ''; ?>" required><br>

        <label for="eventDate">Event Date:</label><br>
        <input type="date" id="eventDate" name="eventDate" value="<?php echo isset($eventDate) ? $eventDate : ''; ?>" required><br>

        <label for="eventTime">Event Time:</label><br>
        <input type="time" id="eventTime" name="eventTime" value="<?php echo isset($eventTime) ? $eventTime : ''; ?>" required><br>

        <label for="eventLocation">Event Location:</label><br>
        <input type="text" id="eventLocation" name="eventLocation" value="<?php echo isset($eventLocation) ? $eventLocation : ''; ?>" required><br>

        <label for="venue">Venue:</label><br>
        <input type="text" id="venue" name="venue" value="<?php echo isset($venue) ? $venue : ''; ?>" required><br>

        <label for="ticketPrice">Ticket Price ($):</label><br>
        <input type="number" id="ticketPrice" name="ticketPrice" value="<?php echo isset($ticketPrice) ? $ticketPrice : ''; ?>" min="0" required><br>

        <label for="eventDescription">Event Description:</label><br>
        <textarea id="eventDescription" name="eventDescription" rows="4" cols="50" required><?php echo isset($eventDescription) ? $eventDescription : ''; ?></textarea><br>

        <label for="eventOrganizer">Organizer Name:</label><br>
        <input type="text" id="eventOrganizer" name="eventOrganizer" value="<?php echo isset($organizerName) ? $organizerName : ''; ?>" required><br>

        <label for="organizerEmail">Organizer Email:</label><br>
        <input type="email" id="organizerEmail" name="organizerEmail" value="<?php echo isset($organizerEmail) ? $organizerEmail : ''; ?>" required><br>

        <label for="eventCapacity">Event Capacity:</label><br>
        <input type="number" id="eventCapacity" name="eventCapacity" value="<?php echo isset($eventCapacity) ? $eventCapacity : ''; ?>" min="1" required><br>

        <label for="registrationDeadline">Registration Deadline:</label><br>
        <input type="datetime-local" id="registrationDeadline" name="registrationDeadline" value="<?php echo isset($registrationDeadline) ? $registrationDeadline : ''; ?>" required><br>

        <input type="submit" value="Update Event">
    </form>
</body>
</html>
