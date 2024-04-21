<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventConnect</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        header {
            background-color:  #009394;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
        }

        footer {
            background-color:  #009394;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        footer p {
            margin: 0;
        }

        .grid-container {
    display:-ms-inline-grid;
    gap: 10px; 
    grid-template-columns: repeat(auto-grid,minmax(300px, 1fr));
    /* Adjust gap between grid items */
    margin: 20px;
 /* Add margin around the grid */
}


        .grid-item {
            margin-right: 3.5%;
            margin-bottom: 2%;
            width: 300px; /* Set a fixed width for each grid item */
            background-color: #fff; /* Background color of each grid item */
            border-radius: 10px; /* Border radius to round corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for depth effect */
            display: inline-flex;
            flex-direction:column;
        }

        .grid-item img {
            width: 100%;
            height: 200px; /* Set a fixed height for the image */
            object-fit: cover; /* Ensure the image covers the entire container */
            border-radius: 10px 10px 0 0; /* Round only the top corners */
        }

        .grid-item-content {
            padding: 20px; /* Padding around each grid item content */
            flex: 1; /* Allow the content to grow to fill remaining space */
        }

        .grid-item-content h3 {
            margin-bottom: 10px; /* Add some space below the heading */
        }

        .grid-item-content p {
            margin-bottom: 10px; /* Add some space below each paragraph */
            overflow: hidden; /* Hide any overflowing content */
            text-overflow: ellipsis; /* Display an ellipsis (...) when text overflows */
            white-space: nowrap; /* Prevent text from wrapping */
        }

        .grid-item .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: auto; /* Align buttons to the bottom of the grid item */
            padding-top: 10px; /* Add some space between buttons and content */
            border-top: 1px solid #ddd; /* Add a border above buttons */
        }

        .grid-item .btn-container a {
            text-decoration: none;
            color: #fff;
            background-color:  #009394;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .grid-item .btn-container a:hover {
            background-color: #333;
            color: #fff;
        }

    </style>
</head>
<body>
    <header>
        <h1>Welcome to EventConnect</h1>
        <nav>
            <ul>
                <li><a href="trial.html">Home</a></li>
                <li><a href="createEvent.php">Register An Event</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="orgLogout.php">Logout</a></li>
            </ul>
        </nav>
    </header> 
    <div class="grid-container">
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


        // Query to fetch data from the events table
        $sql = "SELECT EventID,eventName, eventDate, eventTime, eventLocation, venue, ticketPrice, eventDescription, organizerEmail, eventCapacity, registrationDeadline, eventImage FROM createevent;";

        $result = $conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="grid-item">';
                echo '<img src="' . $row['eventImage'] . '" alt="'.$row['eventName'].'">'; 
                echo '<div class="grid-item-content">';
                echo '<h3>' . $row['eventName'] . '</h3>';
                echo '<p><strong>Event Date:</strong> ' . $row['eventDate'] . '</p>';
                echo '<p><strong>Event Time:</strong> ' . $row['eventTime'] . '</p>';
                echo '<p><strong>Location:</strong> ' . $row['eventLocation'] . '</p>';
                echo '<p><strong>Venue:</strong> ' . $row['venue'] . '</p>';
                echo '<p><strong>Ticket Price:</strong> $' . $row['ticketPrice'] . '</p>';
                echo '<p><strong>Description:</strong> ' . $row['eventDescription'] . '</p>';
                echo '<p><strong>Email:</strong> ' . $row['organizerEmail'] . '</p>';
                echo '<p><strong>Event Capacity:</strong> ' . $row['eventCapacity'] . '</p>';
                echo '<p><strong> Deadline:</strong> ' . $row['registrationDeadline'] . '</p>';
                echo '<div class="btn-container">';
                echo '<a href="editEvent.php?EventID=' . $row['EventID'] . '">Edit</a>';
                echo '<a href="deleteEvent.php?EventID=' . $row['EventID'] . '">Delete</a>';
                echo '</div>'; // Close btn-container
                echo '</div>'; // Close grid-item-content
                echo '</div>'; // Close grid-item
            }
        } else {
            echo "0 results";
        }

        // Close connection
        $conn->close();
        ?>
    </div>
    <footer>
        <p>&copy; 2024 EventConnect. All rights reserved.</p>
    </footer>
</body>
</html>
