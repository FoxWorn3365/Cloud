<?php
session_start();
require_once("protected/components/header.php"); 
?>
  <br><br>
  <h1>Accedi al tuo Cloud</h1>
  <br>
  <form method="post" action="/auth.php">
    Username:<br>
    <input type="text" name="username" class='foxcloud-input'><br>
    Password:<br>
    <input type="password" name="password" class='foxcloud-input'>
    <br><br>
    <button class="foxcloud-button">Accedi!</button>
  </form>
