<?php
session_start();
$file = $_GET["url"];
$user = $_SESSION["user"];
$type = $_GET["type"];

$link = str_replace("/u/", "", $file);
$u = explode("/", $link);

if (empty($type)) {
  // Autenticazione base via sessione utente
  if ($u[0] !== $user) {
    die("Permessi insufficenti!");
  }
  // OK, ora abbiamo autenticato l'utente
  // facciamo quello che dobbiamo fare
  $uconf = json_decode(file_get_contents("protected/users/$u[0]/userinfo.conf"));

  $file = 'protected/disk/' .$uconf->dir. '/' . $file;
} else {
  // Autenticazione avanzata tramite shared
  $shared = $_GET["shared"];
  if (empty($shared)) {
    die("ERRORE: Shared VALUE vuoto!");
  }
  
  if (file_exists('protected/shared/' . $shared)) {
    die("SHARED FORNITO NON ESISTENTE!");
  }
  
  $sh = explode('{}', file_get_contents('protected/shared/' . $shared));
  $useri = json_decode(file_get_contents("protected/users/' . $sh[0] . '/userinfo.conf"));
  $file = 'protected/disk/' . $useri->dir . '/' . $sh[2];
}

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    die("Invalid token");
}
