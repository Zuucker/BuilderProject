<?php
$currentURL = $_SERVER['REQUEST_URI'];

$parts = explode("/", $currentURL);

$argument = end($parts);

if ($argument === "realizacja.php" || $argument === "") {
    echo "no argument";
} else {
    echo $argument;
}

?>