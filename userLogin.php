<?php
// Start the session
session_start();

// Database connection
$servername = "localhost"; // Change this to your database server
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
    // Retrieve username and password from form
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    // Prepare SQL statement to retrieve user information
    $sql = "SELECT * FROM users WHERE username = '$input_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Verify password
        if (password_verify($input_password, $hashed_password)) {
            // Authentication successful, redirect to dashboard or homepage
            $_SESSION["username"] = $input_username;
            header("Location: userDashboard.php"); // Redirect to dashboard.php after successful login
            exit();
        } else {
            // Authentication failed, redirect back to login page with error message
            $_SESSION["error"] = "Invalid username or password";
            echo "ERROR Password"; // Redirect back to login page
            exit();
        }
    } else {
        // User not found, redirect back to login page with error message
        $_SESSION["error"] = "Invalid username or password";
       echo "ERROR "; // Redirect back to login page
        exit();
    }
} else {
    // If the form is not submitted, redirect back to login page
     // Redirect back to login page
    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EventConnect</title>
    <style>
        /* Reset default margin and padding */
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
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            margin-bottom: 34vh;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color:  #009394;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color:  #009394;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color:  #009394;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
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

       

    </style>
</head>
  
<div class="navbar">
    <div>
        <a href="trial.html">Home</a>
        <a href="#">Events</a>
        <a href="#">About</a>
        <a href="orgLogin.php">Login As Organizer</a>
    </div>
    <div class="brand-name">EventConnect</div> <!-- Align right -->
</div>

<body>
    <div class="container">
        <h2>User Login to EventConnect</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <a href="regUser-Register.html" class="back-link">not registered yet?</a>
    </div>
</body>
<footer>
    <p>&copy; 2024 EventConnect. All rights reserved.</p>
</footer>
</html>
