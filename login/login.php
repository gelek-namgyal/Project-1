<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email']; // Change from username to email
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'hrs');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to fetch user by email
    $sql = $conn->prepare("SELECT id, full_name, password, role FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user data in session
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['full_name'] = $user['full_name']; // Store full name in session
            $_SESSION['role'] = $user['role']; // Store role in session

            // Redirect based on role
            if ($user['role'] === 'Admin') {
                header('Location: ../admin/dashboard.php'); // Admin dashboard
                exit();
            } else {
                header('Location: ../index.html'); // User dashboard
                exit();
            }
        } else {
            header('Location: login.html?error=Invalid%20password');
            exit();
        }
    } else {
        header('Location: login.html?error=Invalid%20email');
        exit();
    }

    // Close connection
    $sql->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <h1>Login</h1>
            <p>Welcome back! Please enter your credentials to log in.</p>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p>
                <a href="forgotpassword.php" class="forgot-password-link">Forgot Password?</a>
            </p>
            <p>Don't have an account? <a href="register.php">Sign up here</a>.</p>
        </div>
    </div>
</body>
</html>

