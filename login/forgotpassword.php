<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect data from form
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Check if the new passwords match
    if ($new_password !== $confirm_new_password) {
        header('Location: forgotpassword.html?error=Passwords%20do%20not%20match');
        exit();
    }

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'hrs');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to check if the email exists in the database
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify if the old password matches the one stored in the database
        if (!password_verify($old_password, $user['password'])) {
            header('Location: forgotpassword.html?error=Old%20password%20is%20incorrect');
            exit();
        }

        // Hash the new password
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $update_sql = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $update_sql->bind_param("ss", $new_password_hashed, $email);

        if ($update_sql->execute()) {
            header('Location: login.html?message=Password%20updated%20successfully');
            exit();
        } else {
            header('Location: forgotpassword.html?error=Failed%20to%20update%20password');
            exit();
        }
    } else {
        header('Location: forgotpassword.html?error=User%20not%20found');
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotpassword.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <h1>Forgot Password</h1>
            <p>Reset your password by providing the required details.</p>
            <form action="forgotpassword.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" id="old_password" name="old_password" placeholder="Enter your old password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Enter your new password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required>
                </div>
                <button type="submit" class="btn">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
