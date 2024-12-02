<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // 'user' or 'admin'

    // Hash the password before saving
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'hrs');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to insert new user
    $sql = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $full_name, $email, $password_hashed, $role);

    if ($sql->execute()) {
        header('Location: index.html?message=User%20added%20successfully');
    } else {
        header('Location: index.html.php?error=Failed%20to%20add%20user');
    }

    // Close the database connection
    $sql->close();
    $conn->close();
}
?>
