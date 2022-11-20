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
