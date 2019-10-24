<?php

session_start();

require_once("Database.php");
$db = new Database();
$auth = $db->auth($_POST['user'], $_POST['psw']);

if ($auth->num_rows != 0) {
    $_SESSION['loggedin'] = true;
    $user = mysqli_fetch_assoc($auth);
    $_SESSION['user_id'] = $user['id'];
    header("location: admin.php");
} else {
    header("location: /");
}

