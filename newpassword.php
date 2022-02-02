<?php
session_start();
if (file_exists("protected/users/" . $_SESSION['user']. "/userpass.conf")) {
   die("Non hai i permessi sufficenti!");
}
require_once("protected/components/header.php"); 
?>
 <br>
 <h1>Crea la tua Password</h1>
 <hr>
 <br>
 <form method="post" action="/changepassword.php">
  <input type="hidden" name="user" value="<?= $_SESSION["user"]; ?>">
  Inserisci la nuova password: <input type="text" name="password">
  <br><br><button class="w3-button w3-green w3-text-white">Imposta!</button>
 </form>
  