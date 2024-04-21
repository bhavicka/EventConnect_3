
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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $eventName = $_POST["eventName"];
    $eventDate = $_POST["eventDate"];
    $eventTime = $_POST["eventTime"];
    $eventLocation = $_POST["eventLocation"];
    $venue = $_POST["venue"];
    $ticketPrice = $_POST["ticketPrice"];
    $eventDescription = $_POST["eventDescription"];
    $organizerName = $_POST["eventOrganizer"];
    $organizerEmail = $_POST["organizerEmail"];
    $eventCapacity = $_POST["eventCapacity"];
    $registrationDeadline = $_POST["registrationDeadline"];

    
    if (isset($_FILES['eventImage']) && $_FILES['eventImage']['error'] === UPLOAD_ERR_OK) {
        // Get file details
        $fileName = $_FILES['eventImage']['name'];
        $fileTmpName = $_FILES['eventImage']['tmp_name'];
        $fileSize = $_FILES['eventImage']['size'];
        $fileType = $_FILES['eventImage']['type'];

        // Move uploaded file to a permanent location
        $uploadDir = 'uploads/'; // Directory where you want to store uploaded files
        $targetFilePath = $uploadDir . basename($fileName);
        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            // File uploaded successfully, now update the database with file path
            $stmt = $conn->prepare("UPDATE createevent SET eventImage = ? WHERE eventId = ?");
            $stmt->bind_param('si', $targetFilePath, $eventId);
            $stmt->execute();
            header("Location: OrgDashboard.php");
        } else {
            // Handle file upload error
            echo "Error moving uploaded file.";
        }
    } else {
        // Handle file upload error
        echo "Error uploading file.";
    }


    // Prepare SQL statement to insert data into the createevent table
    // Prepare SQL statement to insert data into the createevent table
    $sql = "INSERT INTO createevent (EventName, EventDate, EventTime, EventLocation, Venue, TicketPrice, eventImage, EventDescription, OrganizerName, OrganizerEmail, EventCapacity, RegistrationDeadline) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Bind parameters and execute statement
$stmt->bind_param("ssssssssisss", $eventName, $eventDate, $eventTime, $eventLocation, $venue, $ticketPrice, $targetFilePath, $eventDescription, $organizerName, $organizerEmail, $eventCapacity, $registrationDeadline);
$stmt->execute();


    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "<p>Event created successfully!</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
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
    <title>Create Event</title>
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
    <h1>Create Event</h1>
    <form method="post" enctype="multipart/form-data">

        <label for="eventName">Event Name:</label><br>
        <input type="text" id="eventName" name="eventName" required><br>

        <label for="eventDate">Event Date:</label><br>
        <input type="date" id="eventDate" name="eventDate" required><br>

        <label for="eventTime">Event Time:</label><br>
        <input type="time" id="eventTime" name="eventTime" required><br>

        <label for="eventLocation">Event Location:</label><br>
        <input type="text" id="eventLocation" name="eventLocation" required><br>

        <label for="venue">Venue:</label><br>
        <input type="text" id="venue" name="venue" required><br>

        <label for="ticketPrice">Ticket Price ($):</label><br>
        <input type="number" id="ticketPrice" name="ticketPrice" min="0" required><br>

         <label for="eventImage">Event Image:</label><br>
        <input type="file" id="eventImage" name="eventImage" accept="image/*" required><br>


        <label for="eventDescription">Event Description:</label><br>
        <textarea id="eventDescription" name="eventDescription" rows="4" cols="50" required></textarea><br>

        <label for="eventOrganizer">Organizer Name:</label><br>
        <input type="text" id="eventOrganizer" name="eventOrganizer" required><br>

        <label for="organizerEmail">Organizer Email:</label><br>
        <input type="email" id="organizerEmail" name="organizerEmail" required><br>

        <label for="eventCapacity">Event Capacity:</label><br>
        <input type="number" id="eventCapacity" name="eventCapacity" min="1" required><br>

        <label for="registrationDeadline" >Registration Deadline:</label><br>
        <input type="datetime-local" id="registrationDeadline" name="registrationDeadline" required><br>

        <input type="submit" value="Create Event">
    </form>
</body>
</html>

