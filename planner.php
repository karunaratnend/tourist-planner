<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = "planner.php";
    header("Location: login.php?message=Please login or sign up to use the visit planner.");
    exit();
}

$user_id = (int)$_SESSION['user_id'];

if (isset($_GET['add'])) {
    $place_id = (int)$_GET['add'];

    $check = mysqli_query($conn, "SELECT * FROM planner_items WHERE user_id = $user_id AND place_id = $place_id");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO planner_items (user_id, place_id) VALUES ($user_id, $place_id)");
    }

    header("Location: planner.php");
    exit();
}

if (isset($_GET['remove'])) {
    $remove_id = (int)$_GET['remove'];
    mysqli_query($conn, "DELETE FROM planner_items WHERE user_id = $user_id AND place_id = $remove_id");
    header("Location: planner.php");
    exit();
}

$total_distance = 0;
$total_time = 0;

$planner_result = mysqli_query($conn, "
    SELECT places.* 
    FROM planner_items
    INNER JOIN places ON planner_items.place_id = places.id
    WHERE planner_items.user_id = $user_id
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visit Planner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>One-Day Visit Planner</h1>
    <p>Create your travel plan by selecting places</p>
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
        <h2>Your Selected Places</h2>

        <?php if (mysqli_num_rows($planner_result) == 0) { ?>
            <p>No places selected yet. Go to the home page or details page and add places.</p>
        <?php } else { ?>
            <table class="table">
                <tr>
                    <th>Place Name</th>
                    <th>Category</th>
                    <th>Distance (km)</th>
                    <th>Estimated Travel Time</th>
                    <th>Action</th>
                </tr>

                <?php while ($row = mysqli_fetch_assoc($planner_result)) {
                    $total_distance += $row['distance'];
                    $estimated_time = $row['distance'] * 4;
                    $total_time += $estimated_time;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['distance']); ?></td>
                        <td><?php echo round($estimated_time); ?> minutes</td>
                        <td>
                            <a class="btn btn-danger" href="planner.php?remove=<?php echo $row['id']; ?>">Remove</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <div class="card" style="margin-top:20px;">
                <h3>Visit Plan Summary</h3>
                <p><strong>Total Distance:</strong> <?php echo round($total_distance, 2); ?> km</p>
                <p><strong>Estimated Total Travel Time:</strong> <?php echo round($total_time); ?> minutes</p>
                <p>This is a simple estimated plan for a one-day visit.</p>
            </div>
        <?php } ?>
    </div>
</div>

<div class="footer">
    <p>&copy; 2026 Local Tourist Day-Visit Planner and Information System | Developed by N. D. Karunaratne</p>
</div>

</body>
</html>