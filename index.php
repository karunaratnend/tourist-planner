<?php
include 'db.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';

$query = "SELECT * FROM places WHERE 1=1";

if ($search != '') {
    $search = mysqli_real_escape_string($conn, $search);
    $query .= " AND name LIKE '%$search%'";
}

if ($category != '') {
    $category = mysqli_real_escape_string($conn, $category);
    $query .= " AND category = '$category'";
}

if ($sort == 'distance') {
    $query .= " ORDER BY distance ASC";
} elseif ($sort == 'popularity') {
    $query .= " ORDER BY popularity DESC";
} else {
    $query .= " ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Local Tourist Day-Visit Planner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Local Tourist Day-Visit Planner and Information System</h1>
    <p>Find nearby places around Moratuwa and plan your one-day visit</p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="planner.php">Visit Planner</a>

    <?php if (isset($_SESSION['username'])) { ?>
        <span style="color:white; margin-left:20px; font-weight:bold;">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span>
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    <?php } ?>
</nav>

<div class="container">
    <div class="card">
        <h2>Search and Filter Places</h2>
        <form method="GET" action="">
            <label>Search by place name</label>
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Enter place name">

            <label>Filter by category</label>
            <select name="category">
                <option value="">All Categories</option>
                <option value="Beach" <?php if($category=='Beach') echo 'selected'; ?>>Beach</option>
                <option value="Nature" <?php if($category=='Nature') echo 'selected'; ?>>Nature</option>
                <option value="Cultural" <?php if($category=='Cultural') echo 'selected'; ?>>Cultural</option>
                <option value="Religious" <?php if($category=='Religious') echo 'selected'; ?>>Religious</option>
                <option value="Historical" <?php if($category=='Historical') echo 'selected'; ?>>Historical</option>
                <option value="Recreation" <?php if($category=='Recreation') echo 'selected'; ?>>Recreation</option>
                <option value="Modern" <?php if($category=='Modern') echo 'selected'; ?>>Modern</option>
                <option value="Wildlife" <?php if($category=='Wildlife') echo 'selected'; ?>>Wildlife</option>
            </select>

            <label>Sort by</label>
            <select name="sort">
                <option value="">Default</option>
                <option value="distance" <?php if($sort=='distance') echo 'selected'; ?>>Distance</option>
                <option value="popularity" <?php if($sort=='popularity') echo 'selected'; ?>>Popularity</option>
            </select>

            <button type="submit" class="btn">Apply</button>
        </form>
    </div>

    <div class="place-grid">

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <p style="text-align:center; font-size:18px; padding:20px;">
            No places found. Try another search.
        </p>
    <?php } else { ?>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="place-card">
                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Place Image">
                <div class="content">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                    <p><strong>Distance:</strong> <?php echo htmlspecialchars($row['distance']); ?> km</p>
                    <a class="btn" href="details.php?id=<?php echo $row['id']; ?>">View Details</a>
                </div>
            </div>
        <?php } ?>

    <?php } ?>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    <p>&copy; 2026 Local Tourist Day-Visit Planner and Information System | Developed by N. D. Karunaratne</p>
</div>

</body>
</html>