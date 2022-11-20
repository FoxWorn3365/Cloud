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
$ses = $_SESSION["user"];
$u = filter_var($_POST["user"], FILTER_SANITIZE_STRING);
$file = filter_var($_POST["dir"], FILTER_SANITIZE_STRING; 
$contents = filter_var($_POST["contenuto"], FILTER_SANITIZE_STRING);

$file = str_replace("%20", " ", $file);

if (empty($u)) {
  die("User");
}

if ($u !== $ses) {
  header("Location: /u/$ses/dashboard");
  die("Permessi insufficenti");
}

if (empty($contents)) {
  die("Content");
}

if (empty($file)) {
  die("FileDir");
}

$user = json_decode(file_get_contents("protected/users/$u/userinfo.conf"));

$h = fopen('protected/disk/' . $user->dir . '/' . $file, "w+");
fwrite($h, $contents);
fclose($h);

header("Location: /u/$u/fileopen/$file");
