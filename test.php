<?php
$connection = mysqli_connect("localhost", "root", "", "fitness_db");

if ($connection) {
    echo "✅ Database connection is working!";
} else {
    echo "❌ Failed to connect to database: " . mysqli_connect_error();
}
?>
