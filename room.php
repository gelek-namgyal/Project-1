<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        header {
            background-color: #343a40;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }
        .rooms-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }
        .room-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
        }
        .room-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .room-card h3 {
            margin: 10px 0;
            font-size: 20px;
        }
        .room-card p {
            margin: 5px 0;
            color: #555;
        }
        .room-card .price {
            color: #28a745;
            font-weight: bold;
        }
        .book-now {
            display: inline-block;
            margin: 15px 0;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        .book-now:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <h1>Available Rooms</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="profile.php">My Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="rooms-container">
    <!-- Room 1 -->
    <div class="room-card">
        <img src="/img/hotel-deluxe.jpg" alt="Deluxe Room">
        <h3>Deluxe Room (Room No: 101)</h3>
        <p>A luxurious room with all modern amenities.</p>
        <p class="price">Price: Rs. 3000 / night</p>
        <a href="book_room.php?room_id=1&room_type=Deluxe Room&price=3000" class="book-now">Book Now</a>
    </div>

    <!-- Room 2 -->
    <div class="room-card">
        <img src="/img/hotel-normal.jpg" alt="Suite Room">
        <h3>Suite Room (Room No: 102)</h3>
        <p>A spacious suite with a separate living area.</p>
        <p class="price">Price: Rs. 5000 / night</p>
        <a href="book_room.php?room_id=2&room_type=Suite Room&price=5000" class="book-now">Book Now</a>
    </div>

    <!-- Room 3 -->
    <div class="room-card">
        <img src="/img/hotel-suite.jpg" alt="Standard Room">
        <h3>Standard Room (Room No: 103)</h3>
        <p>An affordable room with basic facilities.</p>
        <p class="price">Price: Rs. 1500 / night</p>
        <a href="book_room.php?room_id=3&room_type=Standard Room&price=1500" class="book-now">Book Now</a>
    </div>

    <!-- Room 4 -->
    <div class="room-card">
        <img src="/img/hotel-deluxe.jpg" alt="Luxury Room">
        <h3>Luxury Room (Room No: 104)</h3>
        <p>A lavish room with premium amenities and great views.</p>
        <p class="price">Price: Rs. 6000 / night</p>
        <a href="book_room.php?room_id=4&room_type=Luxury Room&price=6000" class="book-now">Book Now</a>
    </div>

    <!-- Room 5 -->
    <div class="room-card">
        <img src="/img/hotel-deluxe.jpgg" alt="Economy Room">
        <h3>Economy Room (Room No: 105)</h3>
        <p>A budget-friendly room with essential facilities.</p>
        <p class="price">Price: Rs. 1000 / night</p>
        <a href="book_room.php?room_id=5&room_type=Economy Room&price=1000" class="book-now">Book Now</a>
    </div>
</div>

</body>
</html>
