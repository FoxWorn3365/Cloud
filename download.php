<?php
session_start();
$file = $_GET["url"];
$user = $_SESSION["user"];

$link = str_replace("/u/", "", $file);
$u = explode("/", $link);

if ($u[0] !== $user) {
  die("Permessi insufficenti!");
}

// OK, ora abbiamo autenticato l'utente
// facciamo quello che dobbiamo fare
$bb = str_replace('/u/' . $u[0] . '/files/', '', $file);

$uconf = json_decode(file_get_contents("protected/users/$u[0]/userinfo.conf"));

$file = 'protected/disk/' .$uconf->dir. '/' . $bb;

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