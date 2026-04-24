<?php
include 'db.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $confirm_password = mysqli_real_escape_string($conn, trim($_POST['confirm_password']));

    if ($username == '' || $password == '' || $confirm_password == '') {
        $error = "Please fill all fields.";
    } elseif ($password != $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username already exists.";
        } else {
            $insert = mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')");
            if ($insert) {
                $message = "Account created successfully. You can now log in.";
            } else {
                $error = "Something went wrong.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Create Account</h1>
    <p>Register as a new user</p>
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
        <h2>Sign Up</h2>

        <?php if ($message != '') { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>

        <?php if ($error != '') { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit" class="btn btn-success">Create Account</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>

<div class="footer">
    <p>&copy; 2026 Local Tourist Day-Visit Planner and Information System | Developed by N. D. Karunaratne</p>
</div>

</body>
</html>