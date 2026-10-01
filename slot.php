```php
<?php

include_once("connection.php");

$error = "";

if (isset($_POST['btn'])) {

    $date = $_POST['date'] ?? "";
    $time = $_POST['time'] ?? "";
    $seat = trim($_POST['seat'] ?? "");

    if ($date == "" || $time == "" || $seat == "") {
      
        $error = "Please select date, time and seat.";
    } 
    else {
        $data_insert = "INSERT INTO slot(date, time, seat) VALUES(?, ?, ?)";
        $stmt = mysqli_prepare($result, $data_insert);
        mysqli_stmt_bind_param($stmt, "sss", $date, $time, $seat);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: showtime.php");
            exit;
        } 
        else {
            $error = "Try again!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Showtime | CinemaBook</title>
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
        <a class="active" href="#">Theatres</a>
        <a href="showtime.php">My Bookings</a>
    </nav>
    <a class="profile-btn" href="logout.php">
        Logout
    </a>
</header>

<main class="page">
    <div class="page-title">
        <p class="eyebrow">
            PVR CINEMAS · PACIFIC MALL
        </p>
        <h1>Choose a Showtime</h1>
    </div>
    <?php if ($error != "") { ?>

        <p class="form-error">
            <?php echo $error; ?>
        </p>

    <?php } ?>

    <div class="time">
        <form action="" method="post">
<!-- date -->
            <h4>Date</h4>
            <div class="slot-options">
                <label>
                    <input type="radio" name="date" value="10 Oct">
                    <span>10 Oct</span>
                </label>
                <label>
                    <input type="radio" name="date" value="11 Oct">
                    <span>11 Oct</span>
                </label>
                <label>
                    <input type="radio" name="date" value="12 Oct">
                    <span>12 Oct</span>
                </label>
                <label>
                    <input type="radio" name="date" value="15 Oct">
                    <span>15 Oct</span>
                </label>
            </div>
            <!-- time  -->
            <h4>Time</h4>
            <div class="slot-options">
                <label>
                    <input type="radio" name="time" value="10:30 AM">
                    <span>10:30 AM</span>
                </label>
                <label>
                    <input type="radio" name="time" value="4:00 PM">
                    <span>4:00 PM</span>
                </label>
                <label>
                    <input type="radio" name="time" value="11:00 PM">
                    <span>11:00 PM</span>
                </label>
            </div>
            <h4>Select your seats</h4>
            <input type="text" name="seat" placeholder="Enter seat number">
            <br><br>
            <button type="submit" class="auth-btn" name="btn">Book</button>
        </form>
    </div>
</main>

<footer>
    <strong>Cinema<span>Book</span></strong>
    <p>Movie booking made simple.</p>
</footer>
</body>
</html>
