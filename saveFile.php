<?php
session_start();
$ses = $_SESSION["user"];
$u = $_POST["user"];
$file = $_POST["dir"]; 
$contents = filter_var($_POST["contenuto"], FILTER_SANITIZE_STRING);

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