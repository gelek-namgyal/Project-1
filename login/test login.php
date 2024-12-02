<?php
$password = 'gelek123';  // Replace with the actual password you want to hash

// Hash the password using bcrypt algorithm
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo $hashed_password;
?>
