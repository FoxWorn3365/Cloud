<?php
session_start();
$user = $_POST["user"];
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

if (file_exists("protected/users/" . $user. "/userpass.conf")) {
   die("Non hai i permessi sufficenti!");
}

$_SESSION["user"] = '';

if (!empty($password) && !empty($user)) {
  unlink("protected/users/$user/userpass.conf");
  $h = fopen("protected/users/$user/userpass.conf", "w+");
  fwrite($h, hash("sha512", $password));
  fclose($h);
  header("Location: /login");
} else {
  die("I campi non sono stati compilati con successo!");
}

