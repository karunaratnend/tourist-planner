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
    $extra_image1 = mysqli_real_escape_string($conn, $_POST['extra_image1']);
    $extra_image2 = mysqli_real_escape_string($conn, $_POST['extra_image2']);
    $extra_image3 = mysqli_real_escape_string($conn, $_POST['extra_image3']);
    $map_link = mysqli_real_escape_string($conn, $_POST['map_link']);
    $popularity = mysqli_real_escape_string($conn, $_POST['popularity']);

    mysqli_query($conn, "INSERT INTO places (name, category, description, distance, opening_hours, image, map_link, popularity)
    VALUES ('$name', '$category', '$description', '$distance', '$opening_hours', '$image', '$map_link', '$popularity')");

    $place_id = mysqli_insert_id($conn);

    if ($extra_image1 != '') {
        mysqli_query($conn, "INSERT INTO place_images (place_id, image_path) VALUES ($place_id, '$extra_image1')");
    }

    if ($extra_image2 != '') {
        mysqli_query($conn, "INSERT INTO place_images (place_id, image_path) VALUES ($place_id, '$extra_image2')");
    }

    if ($extra_image3 != '') {
        mysqli_query($conn, "INSERT INTO place_images (place_id, image_path) VALUES ($place_id, '$extra_image3')");
    }

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

            <label>Main Image URL</label>
            <input type="text" name="image" placeholder="images/place.jpg" required>

            <label>Extra Image 1</label>
            <input type="text" name="extra_image1" placeholder="images/place1.jpg">

            <label>Extra Image 2</label>
            <input type="text" name="extra_image2" placeholder="images/place2.jpg">

            <label>Extra Image 3</label>
            <input type="text" name="extra_image3" placeholder="images/place3.jpg">

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