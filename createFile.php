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
$content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);

if (empty($dir)) {
  $dir = '/';
}

if (empty($filename)) {
  json(array('status' => 401, 'message' => 'Alcuni valori non sono presenti! - FILENAME'));
}

if (empty($content)) {
  json(array('status' => 401, 'message' => 'Alcuni valori non sono presenti! - CONTENT'));
}

$user = json_decode(file_get_contents("protected/users/$u/userinfo.conf"));

$ext = end(explode('.', $filename));
if ($ext != "md" && $ext != "fox" && $ext != "txt") {
  json(array('status' => 401, 'message' => 'Estensione non valida!'));
}

if (!file_exists('protected/disk/' . $user->dir . '/' . $dir . $filename)) {
  file_put_contents('protected/disk/' . $user->dir . '/' . $dir . $filename, $content);
  json(array('status' => 200, 'message' => 'Completato!'));
} else {
  json(array('status' => 402, 'message' => 'Esiste già un file con quel nome! protected/disk/' . $user->dir . '/' . $dir . $filename));
}
