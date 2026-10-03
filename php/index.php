<?php
session_start();
$logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CinemaBook</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.css">
</head>
<body>
<header class="navbar">
    <a class="logo" href="book.php">Cinema<span>Book</span></a>
<nav>
    <a class="active" href="book.php">Home</a>
    <a class="active" href="movie.php">Movies</a>
    <a class="active" href="#">Theatres</a>
    <?php if ($logged_in) { 
        ?> 
        <a href="showtime.php">My Bookings</a> <?php 
        } ?>
    <!-- <a class="active" href="bookings.php">My Bookings</a> -->
</nav>
<?php if ($logged_in) { 
    ?> 
    <a class="auth-btn1" href="logout.php">Logout</a> 
    <?php } else { 
        ?> <a class="auth-btn1" href="login.php">Sign In</a> 
        <?php } 
?>
</header>
    <main>
        <section class="search">
            <h2>Ultimate movies, shows, and more</h2>
            <h5>Starts at<i class="fa-solid fa-indian-rupee-sign"></i>149. Cancel at any time.</h5>
            <br>
            <p class="gap">Ready to watch? Search for your favourite movie.</p>
    <div class="search-box">
    <input id="movieSearch" type="search" placeholder="Search for a movie...">
    <a href="movie.php">Search</a>
    </div>
    </section>

<section class="section">
    <div class="section-head">
        <div>
        <p class="eyebrow">WHAT'S PLAYING</p>
        <h2>Now Showing</h2>
    </div>

<a class="view-all" href="movie.php">View all →</a>
</div>
<?php //include_once("movie.php")?>

<section class="feature-strip">
<div>
    <strong>🎬 Latest Movies</strong>
    <span>Discover what's playing near you</span>
</div>

<div>
    <strong>🎟️ Easy Booking</strong>
    <span>Choose your seats in seconds</span>
</div>

<div>
    <strong>🔒 Secure Payments</strong>
    <span>Simple and secure checkout</span>
</div>

    </section>
    </section>
</main>
<footer>

        <strong>Cinema<span>Book</span></strong>
        <p>Movie booking made simple.</p>

</footer>

</body>
</html>
