<?php
session_start();
unset($_SESSION['user']);
$text = $_POST['text'];
echo json_encode($text);
?>