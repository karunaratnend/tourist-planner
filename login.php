<?php
include 'db.php';

$error = '';
$message = isset($_GET['message']) ? $_GET['message'] : '';

if (isset($_GET['add_after_login'])) {
    $_SESSION['add_after_login'] = (int)$_GET['add_after_login'];
    $_SESSION['redirect_after_login'] = "planner.php";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if (isset($_SESSION['add_after_login'])) {
            $place_id = (int)$_SESSION['add_after_login'];
            $user_id = (int)$_SESSION['user_id'];

            $check = mysqli_query($conn, "SELECT * FROM planner_items WHERE user_id = $user_id AND place_id = $place_id");

            if (mysqli_num_rows($check) == 0) {
                mysqli_query($conn, "INSERT INTO planner_items (user_id, place_id) VALUES ($user_id, $place_id)");
            }

            unset($_SESSION['add_after_login']);
            unset($_SESSION['redirect_after_login']);

            header("Location: planner.php");
            exit();
        }

        if (isset($_SESSION['redirect_after_login'])) {
            $redirect = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']);
            header("Location: $redirect");
            exit();
        }

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>User Login</h1>
    <p>Login to access the system</p>
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
        <h2>Login</h2>

        <?php if ($message != '') { ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php } ?>

        <?php if ($error != '') { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn">Login</button>
        </form>

        <p>Don't have an account? <a href="signup.php">Create one here</a></p>
    </div>
</div>

<div class="footer">
    <p>&copy; 2026 Local Tourist Day-Visit Planner and Information System | Developed by N. D. Karunaratne</p>
</div>

</body>
</html>