<?php
$u = $_GET["user"];
$url = $_GET["dir"];
$type = $_GET["type"];
$shared = $_GET["sharedurl"];

$dir = str_replace("%20", " ", $url);

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