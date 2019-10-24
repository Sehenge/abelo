<?php

session_start();
require_once "Shortener.php";

$shortener = new Shortener();
if ($_GET['action'] == 'delete') {
    $shortener->removeUrl($_GET['id']);
}

if (isset($_POST) && isset($_POST['link'])) {
    $link = $_POST['link'];
    $generated = $shortener->generateShortUrl($link, $_SESSION['user_id']);
    echo $generated;
}