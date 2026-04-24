<?php
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM places ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Admin Dashboard</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="add_place.php">Add New Place</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <div class="card">
        <h2>Manage Tourist Places</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Place Name</th>
                <th>Category</th>
                <th>Distance</th>
                <th>Action</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['distance']); ?> km</td>
                    <td>
                        <a class="btn btn-warning" href="edit_place.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="btn btn-danger" href="delete_place.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this place?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>