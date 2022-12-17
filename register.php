<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location: profile.php');
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization and registration</title>
    <link rel="stylesheet" href="Style/main.css">
</head>
<body>
    <form action="#">
        <label>Login</label>
        <input type="text" name="login" placeholder="Enter login">
        <p class="log none error-text"></p>
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password">
        <p class="pass none error-text"></p>
        <label>Password confirm</label>
        <input type="password" name="password_confirm" placeholder="Confirm password">
        <p class="pass-con none error-text"></p>
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter email">
        <p class="em none error-text"></p>
        <label>Name</label>
        <input type="text" name="name" placeholder="Enter name">
        <p class="nam none error-text"></p>
        <button type="submit" id="submit" class="register-btn">Register</button>
        <p>
            Have an account? - <a href="index.php">login</a>!
        </p>
    </form>
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/main.js"></script>
</body>
</html>