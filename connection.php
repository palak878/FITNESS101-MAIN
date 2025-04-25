<?php
$db = mysqli_connect('localhost', 'root', '', 'fitness_db');

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
