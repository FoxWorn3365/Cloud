<?php
// +-----------------------------------+
// |             FoxCloud              |
// +-----------------------------------+
// | Questo file fa parte del progetto |
// | di Cloud Open Source "FoxCloud",  |
// | realizzato da FoxWorn.            |
// +-----------------------------------+
// | Web: https://foxcloud.fcosma.it   |
// | GH: github.com/FoxWorn3365/Cloud  |
// | License: GNU GPL 3.0              |
// +-----------------------------------+
// | You can write me an email at:     |
// | foxworn3365@gmail.com, also for   |
// | talk!                             |
// +-----------------------------------+

session_start();

$password = filter_var($_POST["accessOfGo"], FILTER_SANITIZE_STRING);
$url = $_SERVER["HTTP_REFERER"];

$url = str_replace("https://" . $_SERVER["SERVER_NAME"], "", $url);

$link = str_replace("/s/", "", $url);

$shared = explode("{}", file_get_contents("protected/shared/$link"));

if ($password === $shared[3]) {
  $_SESSION[md5($url)] = "access_TRUE()";
  header("Location: ".$_SERVER["HTTP_REFERER"]);
} else {
  header("Location: ".$_SERVER["HTTP_REFERER"]);
}

