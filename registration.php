<!DOCTYPE html>
<head>
    <title>Abelohost - Tinylink</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php

session_start();
require_once("Database.php");

if (isset($_POST) && !empty($_POST)) {
    if (($_POST['psw-repeat'] !== $_POST['psw']) || $_POST['psw'] == '') die('passes mismatched');
    $db = new Database();
    $db->registration($_POST['user'], $_POST['psw']); //TODO: change this too
    header("location: /admin.php");
}
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) header("location: /admin.php");
?>

<form action="/registration.php" method="post">
    <div class="container">

        <a href="/index.php"><-- Back </a></h1>
        <h2>Registration</h2>
        <label for="user"><b>User</b></label>
        <input type="text" placeholder="Enter Username" name="user" />
        <br />
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" />
        <br />
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" />
        <hr>
        <br />
        <button type="submit" class="registerbtn">Register</button>
    </div>
</form>
