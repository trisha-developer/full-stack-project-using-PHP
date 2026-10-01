<?php

include_once("connection.php");

$query = "SELECT * FROM movie_upload";
$result_movie = mysqli_query($result, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies | CinemaBook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
    <a class="logo" href="book.php">
        Cinema<span>Book</span>
    </a>

    <nav>
        <a href="book.php">Home</a>
        <a class="active" href="movie.php">Movies</a>
        <a href="#">Theatres</a>
        <a href="showtime.php">My Bookings</a>
    </nav>

    <a class="profile-btn" href="logout.php">Logout</a>
</header>
<main class="page">
    <div class="page-title">
        <p class="eyebrow">DISCOVER</p>
        <h1>Movies</h1>
        <p>Find something you'll love watching.</p>

    </div>

    <div class="filters">
        <input type="search" placeholder="Search movies...">
    </div>

    <div class="movie-grid">
        <?php
        while ($row = mysqli_fetch_assoc($result_movie)) {
        ?>
        <div class="movie-card">
            <div class="movie-poster">
                <img src="upload/<?php echo $row['image']; ?>" alt="<?php echo $row['movie_name']; ?>" >
            </div>

            <div class="movie-info">
                <h2>
                    <?php echo $row['movie_name']; ?>
                </h2>

                <p class="category">
                    <?php echo $row['category']; ?>
                </p>

                <div class="movie-bottom">
                    <span class="rating">
                        ★ <?php echo $row['rating']; ?>
                    </span>

                    <a href="slot.php" class="book-btn">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</main>

<footer>
    <strong>Cinema<span>Book</span></strong>
    <p>Movie booking made simple.</p>

</footer>
</body>
</html>

