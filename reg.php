<?php
include('db.php');
session_start();
// Registration form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // If no errors, insert the user into the database
    if (!isset($message)) {
        // Insert user data including codename and profile picture into the database
        $stmt = $conn->prepare("INSERT INTO `users` (`fname`, `lname`, `username`, `email`, `password`, `user_level_id`) VALUES (?, ?, ?, ?, ?, ?)");
        $user_level_id = 3; // Example: 3 = crew, 2 = manager, 1 = owner/admin
        $stmt->bind_param("sssssi", $fname, $lname, $username, $email, $password, $user_level_id);
        
        if ($stmt->execute()) {
            $message = "Registration successful! Redirecting to login page...";
            $message_type = "success";
            $redirect = true;  // Flag for redirection
        } else {
            $message = "Error: " . $stmt->error;
            $message_type = "error";
        }
        
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    <div class="wrapper">
        <h2>Register</h2>
        <form action="reg.php" method="post" enctype="multipart/form-data">

        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>