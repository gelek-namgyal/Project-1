<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hrs");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Validate POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $room_id = $_POST['room_id'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $days = $_POST['days'];
    $persons = $_POST['persons'];
    $booking_date = $_POST['booking_date'];
    $total_price = $price * $days;

    // Insert booking into the database
    $query = $conn->prepare("INSERT INTO bookings (user_id, room_id, room_type, days, persons, booking_date, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("iisissi", $user_id, $room_id, $room_type, $days, $persons, $booking_date, $total_price);
    

    if ($query->execute()) {
        echo "<script>alert('Booking confirmed successfully!'); window.location.href = 'profile.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "<script>alert('Invalid request. Please try again.'); window.location.href = 'rooms.php';</script>";
}
?>
