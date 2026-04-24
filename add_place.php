<?php
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);
    $opening_hours = mysqli_real_escape_string($conn, $_POST['opening_hours']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $map_link = mysqli_real_escape_string($conn, $_POST['map_link']);
    $popularity = mysqli_real_escape_string($conn, $_POST['popularity']);

    mysqli_query($conn, "INSERT INTO places (name, category, description, distance, opening_hours, image, map_link, popularity)
    VALUES ('$name', '$category', '$description', '$distance', '$opening_hours', '$image', '$map_link', '$popularity')");

    $message = "Place added successfully.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Place</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Add New Place</h1>
</header>

<nav>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <div class="card">
        <?php if ($message != '') { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>

        <form method="POST">
            <label>Place Name</label>
            <input type="text" name="name" required>

            <label>Category</label>
            <input type="text" name="category" required>

            <label>Description</label>
            <textarea name="description" rows="5" required></textarea>

            <label>Distance from Moratuwa (km)</label>
            <input type="number" step="0.01" name="distance" required>

            <label>Opening Hours</label>
            <input type="text" name="opening_hours">

            <label>Image URL</label>
            <input type="text" name="image" required>

            <label>Google Map Link</label>
            <input type="text" name="map_link" required>

            <label>Popularity (1-10)</label>
            <input type="number" name="popularity" min="1" max="10">

            <button type="submit" class="btn btn-success">Add Place</button>
        </form>
    </div>
</div>
</body>
</html>