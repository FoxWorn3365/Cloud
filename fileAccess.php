<?php
session_start();

$password = $_POST["accessOfGo"];
$url = $_SERVER["HTTP_REFERER"];

$url = str_replace("https://cloud.fcosma.it", "", $url);

$link = str_replace("/s/", "", $url);

$shared = explode("{}", file_get_contents("protected/shared/$link"));

if ($password === $shared[3]) {
  $_SESSION[md5($url)] = "access_TRUE()";
  header("Location: ".$_SERVER["HTTP_REFERER"]);
} else {
  die("Password errata!");
}

