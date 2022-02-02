<?php
$u = $_GET["user"];
$url = $_GET["dir"];

session_start();

if ($_SESSION["user"] !== $u) {
  die("ERRORE 02: Permission denied!");
}

$user = json_decode(file_get_contents("protected/users/$u/userinfo.conf"));

$mp3 ='protected/disk/' . $user->dir . '/' . $url;
if(file_exists($mp3)) {
  header('Content-Type: audio/mpeg');
  header('Content-Disposition: inline; filename="' .$url. '"');
  header('Content-length: '. filesize($mp3));
  header('Cache-Control: no-cache');
  header('Content-Transfer-Encoding: chunked'); 
  readfile($mp3);
  exit;
} else {
    echo "no file";
}