<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="Style/main.css">
</head>
<body>

    <form>
        Hello,
        <?= $_SESSION['user']['name'] ?>
        <button type="submit"  class="logout" >Выход</button>
    </form>
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/main.js"></script>
</body>
</html>