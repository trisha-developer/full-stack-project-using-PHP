<?php
session_start();

include_once("connection.php");

$error="";

if(isset($_POST['btn'])){
    $email=trim($_POST['email']);
    $password=$_POST['password'];

    $data="SELECT * FROM register WHERE email =?";
    $stmt=mysqli_prepare($result,$data);

    mysqli_stmt_bind_param($stmt,'s',$email);
    mysqli_stmt_execute($stmt);
    $res=mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($res)==1){
        $user=mysqli_fetch_assoc($res);

        if(password_verify($password,$user['password'])){
            $_SESSION['user_id']=$user['s_no'];
            $_SESSION['user_name']=$user['username'];
            $_SESSION['user_email']=$user['email'];

            header("Location: book.php");
            exit;
        }
        else{
            $error="Incorrect password";
        }
        }
    else{
            $error= "Email not found";
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | CinemaBook</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <a href="book.php" class="logo"><span>▶</span> CineBook</a>
        <a href="book.php" class="back-home">← Back to home</a>
    </nav>
    <main class="auth-page">
        <div class="auth-box">
            <div class="auth-heading">
                <div class="auth-icon">🎬</div>
                <h1>Welcome back</h1>
                <p>Sign in to continue your movie experience.</p>
            </div>
<?php if ($error != "") { ?>
<p class="form-error"><?php echo $error; ?></p>
<?php } ?>
            <form action="#" method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                </div>

                <div class="input-group">
                    <div class="label-row">
                        <label for="password">Password</label>
                        <a href="#" class="forgot">Forgot password?</a>
                    </div>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                </div>
                <button type="submit" class="auth-btn" name="btn">Sign In</button>
            </form>
            <div class="divider"><span>OR</span></div>
        <p class="switch-auth">New to CinemaBook?<a href="register.php">Create an account</a></p>
        </div>
    </main>
</body>
</html>

