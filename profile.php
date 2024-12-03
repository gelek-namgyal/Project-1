<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hrs");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user's booking details
$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM bookings WHERE user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$bookings = $query->get_result();

// Fetch user details
$user_query = $conn->prepare("SELECT full_name, email FROM users WHERE id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user = $user_query->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-header h2 {
            margin: 10px 0;
        }
        .profile-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #f3f3f3;
            border-radius: 5px;
        }
        .profile-details div {
            text-align: center;
        }
        .bookings-section {
            margin-top: 30px;
        }
        .bookings-section h3 {
            margin-bottom: 15px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }
        .booking-item {
            padding: 10px;
            margin-bottom: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .booking-item strong {
            display: block;
        }
        .logout-btn {
            display: block;
            text-align: center;
            margin: 20px auto;
            padding: 10px 20px;
            background: #ff5e57;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-btn:hover {
            background: #e04e4a;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <h2>Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    </div>

    <div class="profile-details">
        <div>
            <strong>User ID:</strong>
            <?php echo htmlspecialchars($user_id); ?>
        </div>
        <div>
            <strong>Total Bookings:</strong>
            <?php echo $bookings->num_rows; ?>
        </div>
    </div>

    <div class="bookings-section">
        <h3>Your Bookings</h3>
        <?php if ($bookings->num_rows > 0): ?>
            <?php while ($booking = $bookings->fetch_assoc()): ?>
                <div class="booking-item">
                    <strong>Room Type:</strong> <?php echo htmlspecialchars($booking['room_type']); ?><br>
                    <strong>Booking Date:</strong> <?php echo htmlspecialchars($booking['booking_date']); ?><br>
                    <strong>Room Number:</strong> <?php echo htmlspecialchars($booking['room_id']); ?><br> <!-- Using room_id instead of room_number -->
                    <strong>Number of Days:</strong> <?php echo htmlspecialchars($booking['days']); ?> days<br> <!-- Using 'days' instead of 'nights' -->
                    <strong>Total Price:</strong> Rs. <?php echo htmlspecialchars($booking['total_price']); ?><br>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
</div>

</body>
</html>
