<?php
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("ID not found.");
}

$id = (int)$_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM places WHERE id = $id");
$place = mysqli_fetch_assoc($result);

if (!$place) {
    die("Place not found.");
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

    mysqli_query($conn, "UPDATE places SET
        name='$name',
        category='$category',
        description='$description',
        distance='$distance',
        opening_hours='$opening_hours',
        image='$image',
        map_link='$map_link',
        popularity='$popularity'
        WHERE id=$id
    ");

    header("Location: admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Place</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Edit Place</h1>
</header>

<nav>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <div class="card">
        <form method="POST">
            <label>Place Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($place['name']); ?>" required>

            <label>Category</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($place['category']); ?>" required>

            <label>Description</label>
            <textarea name="description" rows="5" required><?php echo htmlspecialchars($place['description']); ?></textarea>

            <label>Distance from Moratuwa (km)</label>
            <input type="number" step="0.01" name="distance" value="<?php echo htmlspecialchars($place['distance']); ?>" required>

            <label>Opening Hours</label>
            <input type="text" name="opening_hours" value="<?php echo htmlspecialchars($place['opening_hours']); ?>">

            <label>Image URL</label>
            <input type="text" name="image" value="<?php echo htmlspecialchars($place['image']); ?>" required>

            <label>Google Map Link</label>
            <input type="text" name="map_link" value="<?php echo htmlspecialchars($place['map_link']); ?>" required>

            <label>Popularity (1-10)</label>
            <input type="number" name="popularity" min="1" max="10" value="<?php echo htmlspecialchars($place['popularity']); ?>">

            <button type="submit" class="btn btn-success">Update Place</button>
        </form>
    </div>
</div>
</body>
</html>