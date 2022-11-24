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

require_once("protected/components/loadpage.php");

session_start();
$u = filter_var($_POST["user"], FILTER_SANITIZE_STRING);
$dir = filter_var($_POST["dir"], FILTER_SANITIZE_STRING);

$dir = str_replace("%20", " ", $dir);

if ($_SESSION["user"] !== $u) {
  require_once("protected/components/header.php");
  echo load("Unhautorized", $u, "02", "Non hai i permessi sufficenti per creare una cartella!");
}

$user = json_decode(file_get_contents("protected/users/$u/userinfo.conf"));

$namedir = $_POST["nomedelladirectory"];

if (empty($namedir)) {
   require_once("protected/components/header.php");
   echo load("dirname->empty", $u, "11", "Il nome della directory è vuoto!");
}

// Allora creiamo questa directory!
mkdir('protected/disk/' . $user->dir . '/' . $dir . $namedir, 0777, true);

chmod('protected/disk/' . $user->dir . '/' . $dir . $namedir, 0777);

header("Location: /u/" . $_SESSION["user"] . "/files/" . $dir . $namedir);
