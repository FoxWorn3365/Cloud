<?php
// +-----------------------------------+
// |             FoxCloud              |
// +-----------------------------------+
// | Questo file fa parte del progetto |
// | di Cloud Open Source "FoxCloud",  |
// | realizzato da FoxWorn.            |
// +-----------------------------------+
// | Web: https://foxcloud.fcosma.it   |
// | GH: github.com/FoxWorn3365/Cloud  |
// | License: GNU GPL 3.0              |
// +-----------------------------------+
// | You can write me an email at:     |
// | foxworn3365@gmail.com, also for   |
// | talk!                             |
// +-----------------------------------+

session_start();

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
if (stripos(file_get_contents('protected/sys/' . $_SESSION["user"] . 'fileEvidenziati.array'), $file) !== false) {
  // Rimuoviamolo 
  file_put_contents('protected/sys/' . $_SESSION["user"] . 'fileEvidenziati.array', str_replace($file, "", file_get_contents('protected/sys/' . $_SESSION["user"] . 'fileEvidenziati.array')));
} else {
  file_put_contents('protected/sys/' . $_SESSION["user"] . 'fileEvidenziati.array', file_get_contents('protected/sys/' . $_SESSION["user"] . 'fileEvidenziati.array') . $file . '[[FoxCloudEvidenziatiSeparator]]');
}

// Ok, tutto apposto, ritorno con un 200
die(json_encode(array('status' => 200, 'message' => 'File evidenziato!')));
