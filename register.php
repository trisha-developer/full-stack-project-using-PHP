<?php

include_once("connection.php");
$error = "";

if (isset($_POST['btn'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
       $error = "Passwords do not match.";
    } 
    else {
        $check = "SELECT s_no FROM register WHERE email = ?";
        $stmt = mysqli_prepare($result, $check);

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $check_result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($check_result) > 0) {

            $error = "This email is already registered.";
        } 
        else{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $data_insert = "INSERT INTO register(username,email,password) VALUES (?,?,?)";
            $stmt = mysqli_prepare($result, $data_insert);

            mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: login.php");
                exit;
            } 
            else{
                $error = "Registration Failed!";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account | CinemaBook</title>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
   <a href="book.php" class="logo"><span>▶</span> CinemaBook</a>
   <a href="book.php" class="back-home">← Back to home</a>
</nav>

<main class="auth-page">
<div class="auth-box register-box">
  <div class="auth-heading">
    <div class="auth-icon">🎟️</div>
      <h1>Create your account</h1>
      <p>Join CinemaBook and start booking your favourite movies.</p>
</div>

<?php if ($error != "") { ?>
    <p class="form-error"><?php echo $error; ?></p>
<?php } ?>

<form action="" method="post">
<div class="input-group">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Enter your username">
</div>

<div class="input-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Enter your email">
</div>

<div class="input-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Create a password">
</div>

<div class="input-group">
    <label for="confirm-password">Confirm Password</label>
    <input type="password" id="confirm-password" name="confirm_password" placeholder="Repeat your password">
</div>
    <button type="submit" class="auth-btn" name="btn">Create Account</button>
</form>
    <p class="switch-auth">Already have an account?<a href="login.php">Sign in</a></p>
</div>

</main>
</body>
</html>