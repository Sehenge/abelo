<?php

require_once "Shortener.php";

$route = $_GET;
$shortener = new Shortener();
if (isset($route['url'])) {
    $source = $route['url'];

    if (isset($source) && $source != NULL) {
        $orig_url = $shortener->getOriginalUrl($source);

        $parsed_url = parse_url($orig_url);

        if(($parsed_url['scheme'] == 'https') || ($parsed_url['scheme'] == 'http')){
            header("Location: " . $orig_url);
        } else {
            header("Location: http://" . $orig_url);
        }
    }
}

