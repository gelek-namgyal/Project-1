<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Validate input data
if (!isset($_GET['room_id']) || !isset($_GET['room_type']) || !isset($_GET['price'])) {
    echo "<script>alert('Invalid request. Please try again.'); window.location.href = 'rooms.php';</script>";
    exit;
}

$room_id = $_GET['room_id'];
$room_type = $_GET['room_type'];
$price = $_GET['price'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Room</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .booking-form {
            width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .booking-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="booking-form">
        <h2>Confirm Your Booking</h2>
        <form action="confirm_booking.php" method="POST">
            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
            <input type="hidden" name="room_type" value="<?php echo $room_type; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <div class="form-group">
                <label>Room Type:</label>
                <input type="text" value="<?php echo $room_type; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Price per Night:</label>
                <input type="text" value="Rs. <?php echo $price; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Number of Days:</label>
                <input type="number" name="days" min="1" required>
            </div>
            <div class="form-group">
                <label>Number of Persons:</label>
                <input type="number" name="persons" min="1" required>
            </div>
            <div class="form-group">
                <label>Booking Date:</label>
                <input type="date" name="booking_date" required>
            </div>
            <button type="submit" class="btn">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
