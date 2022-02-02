<?php
$u = $_GET["user"];
$dir = $_GET["dir"];
$type = $_GET["type"];
$shared = $_GET["sharedurl"];

session_start();
if ($type == "shared" && file_exists("protected/shared/$shared")) {
  // Carichiamo il loader
  $sh = explode("{}", file_get_contents("protected/shared/$shared"));
  if ($sh[0] === $u && $sh[2] == $dir) {
    // Ok, non dico niente
    $do = true;
  } else {
    die("Permessi dello shared insufficenti");
  }
} else {
  if ($_SESSION["user"] !== $u) {
     die("ERROR 02: Permission denied");
  }
}

$user = json_decode(file_get_contents("protected/users/$u/userinfo.conf"));

$file='protected/disk/' . $user->dir . '/' . $dir;

header('Content-Type: video/mp4'); #Optional if you'll only load it from other pages
header('Accept-Ranges: bytes');
header('Content-Length:'.filesize($file));

readfile($file);