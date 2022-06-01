<?php
header("Content Type: application/json");

function json($d = array()) {
  die(json_encode($d));
}

session_start();
$u = $_SESSION["user"];
if (empty($u)) {
  json(array('status' => 400, 'message' => 'Non sei autorizzato!'));
}

$dir = filter_var($_POST["dir"], FILTER_SANITIZE_STRING);
$filename = filter_var($_POST["file"], FILTER_SANITIZE_STRING);

if (empty($dir)) {
  json(array('status' => 401, 'message' => 'Alcuni valori non sono presenti!'));
}

if (empty($filename)) {
  json(array('status' => 401, 'message' => 'Alcuni valori non sono presenti!'));
}

$user = json_decode(file_get_contents("protected/users/$u/userinfo.conf"));
$dira = end(explode('/', $dir));

$diro = str_replace($dira, $filename, $dir);

if (!file_exists('protected/disk/' . $user->dir . '/' . $dir)) {
  json(array('status' => 402, 'message' => 'Il file originale non esiste!'));
} else {
  rename('protected/disk/' . $user->dir . '/' . $dir, 'protected/disk/' . $user->dir . '/' . $diro);
  json(array('status' => 200, 'message' => 'Completato!'));
}
 