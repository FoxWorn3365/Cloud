<?php
$u = filter_var($_GET["user"]. FILTER_SANITIZE_STRING);
$type = filter_var($_GET["type"], FILTER_SANITIZE_STRING);
$shared = filter_var($_GET["sharedurl"], FILTER_SANITIZR_STRING);

session_start();
if ($type == "shared" && file_exists("protected/shared/$shared")) {
  // Carichiamo il loader
  $sh = explode("{}", file_get_contents("protected/shared/$shared"));
  if ($sh[0] === $u && empty($sha[3])) {
    // Ok, non dico niente
    $dir = str_replace("%20", " ", $sh[2]);
  } elseif ($sh[0] === $u && !empty($sha[3]) && !empty($_SESSION[md5('/s/' .$shared)])) {
    // Ok, non dico niente
    $dir = str_replace("%20", " ", $sh[2]);
  } else {
    die("Permessi dello shared insufficenti / accesso negato");
  }
} else {
  if ($_SESSION["user"] !== $u) {
     die("ERROR 02: Permission denied");
  } else {
     $dir = $_GET["dir"];
  }
}

$user = json_decode(file_get_contents("protected/users/$u/userinfo.conf"));

$file='protected/disk/' . $user->dir . '/' . $dir;

header('Content-Type: video/mp4 video/x-matroska'); #Optional if you'll only load it from other pages
header('Accept-Ranges: bytes');
header('Content-Length:'.filesize($file));

readfile($file);
