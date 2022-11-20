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

require_once("protected/components/header.php");

// Caricamento dei file di configurazione
$config = json_decode(file_get_contents('protected/users/' . $us . '/userinfo.conf'));

if (empty($config->dir)) {
  die("ERRORE NEL CARICAMENTO DELLA CONFIGURAZIONE!");
}
?>
  <style>
  input {
    color: white;
    background-color: gray;
    border: solid 2px gray;
    width: 50%;
  }
  </style>
  <h1>Modifica un Utente - <?= $us; ?></h1>
  <br><br>
  <form method='POST' action='/admin.php?action=editUser&user=<?= $us; ?>'>
   <pre style='background-color: gray; border: solid 6px gray; border-radius: 20px; color: white; text-align: left; position: absolute; left: 15px; width: 50%'>
{
  "username":"<input type='text' name='username' value='<?= $us; ?>' disabled>",
  "nome":"<input type='text' name='nome' value='<?= $config->name; ?>'>",
  "cognome":"<input type='text' name='cognome' value='<?= $config->surname; ?>'>",
  "email":"<input type='email' name='email' value='<?= $config->email; ?>'>",
  "diskSpace":"<input type='number' name='disk' value='<?= $config->diskSpace; ?>'>",
  "firstLogin":"<input type='number' value='<?= $config->firstLogin; ?>' disabled>",
  "isVisible":"<select name='visible'><option value='true' selected>true</option><option value='false'>false</option></select>",
  "dir":"<input type='text' name='dir'  value='<?= $config->dir; ?>'>"
}
   </pre>
   <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
   <button class='w3-button w3-orange w3-text-white'>Modifica</button>
   <br><br><br><br><br><br><br>
  </form>
