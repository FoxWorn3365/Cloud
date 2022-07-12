<?php
// Recuperiamo l'utente e verifichiamo se l'utente è quello giusto!
session_start();
$temp = $_SESSION["admin"];


if (empty($temp)) {
  require_once("protected/components/adminlogin.php");
  die();
}
