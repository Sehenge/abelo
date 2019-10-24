<!DOCTYPE html>
<head>
    <title>Abelohost - Tinylink</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) header("location: /admin.php");
?>
<div class="container">
    <form action="/login.php" method="post">
        <div class="container">
            <h1>Login</h1>
            <label for="user"><b>User</b></label>
            <input type="text" placeholder="Enter Username" name="user" />
            <br />
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" />
            <br />
            <button type="submit" class="loginbtn btn btn-success">Login</button>
            <button type="button" class="loginbtn btn btn-danger" onclick="window.location.href='/registration.php'">Registration</button>
        </div>
    </form>
<!--    --><?php //if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
<!--        <a href="/logout.php">Logout</a> -->
<!--    --><?php //else :?>
<!--        <a href="/registration.php">Registration</a>-->
<!--    --><?php //endif;?>
</div>
</body>