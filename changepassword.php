<?php
session_start();
$user = $_POST["user"];
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

if (file_exists("protected/users/" . $user. "/userpass.conf")) {
   die("Non hai i permessi sufficenti!");
}

$_SESSION["user"] = '';

if (!empty($password) && !empty($user)) {
  file_put_contents("protected/users/$user/userpass.conf", hash("sha512", $password));
  header("Location: /login");
} else {
  die("I campi non sono stati compilati con successo!");
}
