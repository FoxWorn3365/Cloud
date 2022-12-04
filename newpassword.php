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
  Inserisci la nuova password: <input type="password" name="password" class='foxcloud-input'>
  <br><br><button class="foxcloud-button">Imposta!</button>
 </form>
