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
    <form>
        <label>Login</label>
        <input type="text" name="login" placeholder="Enter your email" value="<?php if(isset($_COOKIE["login"])) { echo $_COOKIE["login"]; } ?>">
        <p class="log none error-text"></p>
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password">
        <p class="pass none error-text"></p>
        <button type="submit" class="login-btn">Войти</button>
        <p>
            Don't have an account yet? - <a href="register.php">register</a>!
        </p>
    </form>
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/main.js"></script>
</body>

</html>