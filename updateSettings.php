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

if (!empty($_SESSION["user"])) {
  define('USER', $_SESSION["user"]);
} else {
  header("Location: /login");
  exit;
}

$fp = filter_var($_GET["foxPlayer"], FILTER_SANITIZE_STRING);
$sb = filter_var($_GET["searchBar"], FILTER_SANITIZE_STRING);

if (!empty($fp) && !empty($sb)) {
  file_put_contents('protected/sys/.' . USER . '_preferences.sys', json_encode(array('foxPlayer' => $fp, 'searchBar' => $sb)));
  die('done');
} else {
  die('error');
}
