<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

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

// Retrieve user's location from the database
$username = $_SESSION["username"];
$user_location = "";
$sql_location = "SELECT location FROM users WHERE username = ?";
$stmt_location = $conn->prepare($sql_location);
$stmt_location->bind_param("s", $username);
$stmt_location->execute();
$stmt_location->bind_result($user_location);
$stmt_location->fetch();
$stmt_location->close();

// Query to fetch events based on the user's location
$sql_events = "SELECT EventID, eventName, eventDate, eventTime, eventLocation, venue, ticketPrice, eventDescription, organizerEmail, eventCapacity, registrationDeadline, eventImage FROM createevent WHERE eventLocation = ?";
$stmt_events = $conn->prepare($sql_events);
$stmt_events->bind_param("s", $user_location);
$stmt_events->execute();
$result_events = $stmt_events->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
      .navbar {
            background-color: #009394;
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
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .search-bar {
            margin-right: auto; /* Pushes the search bar to the left */
        }
        .search-input {
            padding: 10px 15px;
            border-radius: 25px;
            border: 1px solid #009394;
            font-size: 16px;
            outline: none;
            width: 280px; /* Adjust width as needed */
            background-color: #f2f2f2; /* Light gray background color */
            transition: all 0.3s ease; /* Smooth transition on hover */
        }
        .search-input::placeholder {
            color: #999; /* Placeholder text color */
        }
        .search-input:focus {
            background-color: #ddd; /* Lighter gray background color on focus */
        }
        .search-button {
            background-color: #009394;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition on hover */
        }
        .search-button:hover {
            background-color: #007272; /* Darker shade on hover */
        }
        .location {
            margin-left: 77%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: -7.5vh;
        }
        .location img {
            margin-top: 1vh;
            width: 2.6vw;
            height: 6vh;
            margin-right: 0.2vw; /* Spacing between image and text */
        }
        .location h3 {
            font-size: larger;
            margin: 0; /* Remove any default margin */
        }
        .events {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .event {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .event h2 {
            margin-bottom: 10px;
        }
        .event p {
            margin-bottom: 5px;
        }
        .event a {
            display: block;
            text-align: center;
            background-color: #009394;
            color: #fff;
            text-decoration: none;
            padding: 8px 0;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .event a:hover {
            background-color: #007272;
        }
    </style>
</head>
<body>
    <header>
    <div class="navbar">
        <div>
            <a href="#">Home</a>
            <a href="#">Events</a>
            <a href="#">About</a>
            <a href="userLogout.php">Logout</a>
        </div>
        <div class="brand-name">EventConnect</div> <!-- Align right -->
    </div>
    </header>

    <div class="content">
        <h2>Events Near You</h2>
        <div class="events-container">
            <?php
            // Check if there are any events available
            if ($result_events->num_rows > 0) {
                while ($row_event = $result_events->fetch_assoc()) {
                    // Display event details
                    echo '<div class="event">';
                    echo '<img src="' . $row_event["eventImage"] . '" alt="' . $row_event["eventName"] . '">';
                    echo '<h3>' . $row_event["eventName"] . '</h3>';
                    echo '<p><strong>Date:</strong> ' . $row_event["eventDate"] . '</p>';
                    echo '<p><strong>Time:</strong> ' . $row_event["eventTime"] . '</p>';
                    echo '<p><strong>Location:</strong> ' . $row_event["eventLocation"] . '</p>';
                    echo '<p><strong>Venue:</strong> ' . $row_event["venue"] . '</p>';
                    echo '<p><strong>Ticket Price:</strong> $' . $row_event["ticketPrice"] . '</p>';
                    echo '<p><strong>Description:</strong> ' . $row_event["eventDescription"] . '</p>';
                    echo '<p><strong>Email:</strong> ' . $row_event["organizerEmail"] . '</p>';
                    echo '<p><strong>Event Capacity:</strong> ' . $row_event["eventCapacity"] . '</p>';
                    echo '<p><strong>Registration Deadline:</strong> ' . $row_event["registrationDeadline"] . '</p>';
                    echo '<a href="register.php?EventID=' . $row_event["EventID"] . '">Register</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>No events found near your location.</p>";
            }
            ?>
        </div>
    </div>

    <footer>
        <!-- Add footer content here -->
    </footer>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
