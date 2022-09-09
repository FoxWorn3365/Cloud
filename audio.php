<?php
$u = filter_var($_GET["user"], FILTER_SANITIZE_STRING);
$type = filter_var($_GET["type"], FILTER_SANITIZE_STRING);
$shared = filter_var($_GET["sharedurl"], FILTER_SANITIZE_STRING);

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

$mp3 ='protected/disk/' . $user->dir . '/' . $dir;
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
