<?php
// Recuperiamo l'utente e verifichiamo se l'utente è quello giusto!
session_start();
$temp = $_SESSION["user"];


if (empty($temp)) {
  require_once("login.php");
  die();
} elseif ($temp !== $pp[0]) {
  // Non è la sua dashboard
  header("Location: /u/$temp/dashboard");
  die("Non è il tuo pannello");
}