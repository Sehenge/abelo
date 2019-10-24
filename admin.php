<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /");
$user_id = $_SESSION['user_id'];
require_once "Shortener.php";

//function get_title($url){
//    $str = file_get_contents($url);
//    if(strlen($str)>0){
//        $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
//        preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
//        return $title[1];
//    }
//}
?>

<!DOCTYPE html>
<head>
    <title>Abelohost - Tinylink</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="application/javascript" src="main.js"></script>
</head>
<body>
<div class="container">
    <form action="/shortener.php" method="post" class="form-inline">
            <h2>Get short link</h2>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" placeholder="Enter your link" name="link" class="mb-2" id="orig_url"/>
        </div>
        <button type="button" class="generate btn btn-success mb-2" >Generate</button>
    </form>
</div>


<div class="container">
    <table class="table">
        <?php
        $shortener = new Shortener();
        $allUrls = $shortener->getAllUrls($user_id);
        foreach ($allUrls as $url) {
            if ($url['original'] == '') continue;
            echo '<tr>';
//            echo '<td><a href="' . $url['original'] . '">' . $url['original'] . '</a></td>' .
            echo '<td>' . $url['original'] . '</td>' .
//                '<td><a href="http://' . $_SERVER['HTTP_HOST'] . '/route.php?url=' . $url['short'] . '" id="shortUrl_' . $url['id'] . '" target="_blank">' . $url['short'] . '</a></td>' .
                '<td><a href="http://' . $_SERVER['HTTP_HOST'] . '/s/' . $url['short'] . '" id="shortUrl_' . $url['id'] . '" target="_blank">' . $url['short'] . '</a></td>' .
                '<td><button class="btn btn-info" onclick="copyToClipboard(' . $url['id'] . ')" id="' . $url['id'] . '">Copy</button></td>'.
//                '<td><a class="btn btn-danger" href="http://' . $_SERVER['HTTP_HOST'] . '/shortener.php?action=delete&id=' . $url['id'] . '">Delete</a></td>'; //TODO: check this later (http/s)
                '<td><button class="btn btn-danger" onclick="deleteLink(' . $url['id'] . ', this)">Delete</a></td>'; //TODO: check this later (http/s)

            echo '</tr>';
        }
        ?>
    </table>

    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
        <hr />
    <button class="loginbtn btn btn-danger" onclick="window.location.href='/logout.php'">Logout</button>
    <?php endif?>
</div>
