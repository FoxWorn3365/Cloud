<?php
$file = filter_var($_GET["file"], FILTER_SANITIZE_STRING);

if (empty($file)) {
  die(json_encode(array('status' => 400, 'message' => 'Il file non esiste!')));
}

if (empty($_SESSION["user"])) {
  die(json_encode(array('status' => 400, 'message' => 'Non sei autenticato!')));
}

$user = json_decode(file_get_contents('protected/users/' . $_SESSION["user"] . '/userinfo.conf'));

if (!file_exists('protected/disk/' . $user->dir . '/' . $file)) {
  die(json_encode(array('status' => 400, 'message' => 'Il file non esiste!')));
}

// Ok, ora sistemiamo tutto evidenziando il file
file_put_contents('protected/sys/' . $_SESSION["user"] . 'fileEvidenziati.array', file_get_contents('protected/sys/' . $_SESSION["user"] . 'fileEvidenziati.array') . $file . '//!!\\(())(())(())((((()()()()()(()()984984578475987357/////(/&&\\'));

// Ok, tutto apposto, ritorno con un 200
die(json_encode(array('status' => 200, 'message' => 'File evidenziato!')));
