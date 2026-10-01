<?php

session_start();
include_once("connection.php");

$error = "";
$success = "";

// delete query 
if (isset($_POST['cancel'])) {

    $id = $_POST['id'];
    $delete = "DELETE FROM slot WHERE s_no = ?";
    $stmt = mysqli_prepare($result, $delete);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $success = "Ticket cancelled successfully!";
    } else {
        $error = "Unable to cancel ticket.";
    }
}

$query = "SELECT * FROM slot ORDER BY s_no DESC LIMIT 1";
$ticket = mysqli_query($result, $query);
$row = mysqli_fetch_assoc($ticket);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ticket | CinemaBook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
    <a class="logo" href="book.php">
        Cinema<span>Book</span>
    </a>
    <nav>
        <a href="book.php">Home</a>
        <a href="movie.php">Movies</a>
        <a href="#">Theatres</a>
        <a href="showtime.php">My Ticket</a>
    </nav>
    <a class="profile-btn" href="logout.php">Logout</a>
</header>
<main class="page">
    <div class="page-title">
        <p class="eyebrow">BOOKING CONFIRMED</p>
        <h1>Your Ticket</h1>
        <p>Here are your ticket details.</p>
    </div>

    <?php if ($success != "") { ?>

        <p class="success-message">
            <?php echo $success; ?>
        </p>
    <?php } ?>

    <?php if ($error != "") { ?>

        <p class="form-error">
            <?php echo $error; ?>
        </p>
    <?php } ?>

    <?php if ($row) { ?>

        <div class="booking-box">
            <h1>🎟️ Movie Ticket</h1>
            <div class="booking-summary">

                <div>
                    <span>Movie</span>
                    <strong>CinemaBook Movie</strong>
                </div>

                <div>
                    <span>Date</span>
                    <strong><?php echo $row['date']; ?></strong>
                </div>

                <div>
                    <span>Showtime</span>
                    <strong><?php echo $row['time']; ?></strong>
                </div>

                <div>
                    <span>Seat</span>
                    <strong><?php echo $row['seat']; ?></strong>
                </div>

                <div class="total-row">
                    <span>Ticket Price</span>
                    <strong>₹149</strong>
                </div>
            </div>

            <form action="" method="post">
                <input type="hidden" name="id"
                       value="<?php echo $row['s_no']; ?>">
                <button type="submit" name="cancel" class="cancel-booking">Cancel Ticket</button>
            </form>
        </div>
    <?php } else { ?>
        <div class="empty-bookings">
            <h2>No Ticket Found</h2>
            <p>You haven't booked a ticket yet.</p>
            <a href="movie.php">Book a Movie</a>
        </div>
    <?php } ?>
</main>
<footer>

    <strong>Cinema<span>Book</span></strong>
    <p>Movie booking made simple.</p>
</footer>
</body>
</html>

