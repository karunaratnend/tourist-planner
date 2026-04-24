<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Place ID not found.");
}

$id = (int)$_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM places WHERE id = $id");
$place = mysqli_fetch_assoc($result);

if (!$place) {
    die("Place not found.");
}

$images = [];
$images[] = $place['image'];

$image_result = mysqli_query($conn, "SELECT * FROM place_images WHERE place_id = $id");
while ($img = mysqli_fetch_assoc($image_result)) {
    if (!in_array($img['image_path'], $images)) {
        $images[] = $img['image_path'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($place['name']); ?> - Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Place Details</h1>
    <p>Explore information about this tourist location</p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="planner.php">Visit Planner</a>

    <?php if (isset($_SESSION['username'])) { ?>
        <span class="nav-user">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    <?php } ?>
</nav>

<div class="container">
    <div class="card details-card">

        <h2 class="details-title"><?php echo htmlspecialchars($place['name']); ?></h2>

        <div class="gallery-main">
            <img id="mainImage" src="<?php echo htmlspecialchars($images[0]); ?>" alt="Place Image">
        </div>

        <?php if (count($images) > 1) { ?>
            <div class="gallery-thumbs">
                <?php foreach ($images as $index => $img) { ?>
                    <img
                        src="<?php echo htmlspecialchars($img); ?>"
                        alt="Thumbnail"
                        class="thumb <?php echo $index == 0 ? 'active-thumb' : ''; ?>"
                        onclick="changeMainImage(this)">
                <?php } ?>
            </div>
        <?php } ?>

        <div class="details-bottom">
            <div class="details-left">
                <h3>Description</h3>
                <p class="details-description">
                    <?php echo htmlspecialchars($place['description']); ?>
                </p>
            </div>

            <div class="details-right">
                <p><strong>Category:</strong> <?php echo htmlspecialchars($place['category']); ?></p>
                <p><strong>Popularity:</strong>
                <?php
                for ($i = 0; $i < $place['popularity']; $i++) {
                    echo "⭐";
                }
                ?>
                </p>
                <p><strong>Distance from Moratuwa:</strong> <?php echo htmlspecialchars($place['distance']); ?> km</p>
                <p><strong>Opening Hours:</strong> <?php echo htmlspecialchars($place['opening_hours']); ?></p>

                <div class="details-buttons">
                    <a class="btn btn-success" href="<?php echo htmlspecialchars($place['map_link']); ?>" target="_blank">View on Map</a>

                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <a class="btn" href="planner.php?add=<?php echo $place['id']; ?>">Add to Visit Plan</a>
                    <?php } else { ?>
                        <a class="btn" href="login.php?add_after_login=<?php echo $place['id']; ?>&message=Please login or sign up to add places to your planner.">Add to Visit Plan</a>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="footer">
    <p>&copy; 2026 Local Tourist Day-Visit Planner and Information System | Developed by N. D. Karunaratne</p>
</div>

<script>
let currentIndex = 0;
const thumbs = document.querySelectorAll(".thumb");
const mainImage = document.getElementById("mainImage");

function changeMainImage(clickedImg) {
    mainImage.src = clickedImg.src;

    thumbs.forEach(img => img.classList.remove("active-thumb"));
    clickedImg.classList.add("active-thumb");

    currentIndex = Array.from(thumbs).indexOf(clickedImg);
}

function autoSlide() {
    if (thumbs.length <= 1) return;

    currentIndex++;
    if (currentIndex >= thumbs.length) {
        currentIndex = 0;
    }

    mainImage.src = thumbs[currentIndex].src;

    thumbs.forEach(img => img.classList.remove("active-thumb"));
    thumbs[currentIndex].classList.add("active-thumb");
}

if (thumbs.length > 1) {
    setInterval(autoSlide, 4000);
}
</script>

</body>
</html>