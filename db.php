<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "tourist_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>