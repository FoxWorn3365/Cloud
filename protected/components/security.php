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

// Recuperiamo l'utente e verifichiamo se l'utente è quello giusto!
session_start();
$temp = $_SESSION["user"];


if (empty($temp)) {
  require_once("login_in.php");
  die();
} elseif ($temp !== $pp[0]) {
  // Non è la sua dashboard
  header("Location: /u/$temp/files/");
  die("Non è il tuo pannello");
}
