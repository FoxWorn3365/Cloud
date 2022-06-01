<?php
session_start();
require_once("protected/components/header.php"); 
?>
  <br><br>
  <h1>Accedi al tuo Cloud</h1>
  <br>
  <form method="post" action="/auth.php">
    <input type="hidden" name="redi" value="true">
    Username:<br>
    <input type="text" name="username"><br>
    Password:<br>
    <input type="password" name="password">
    <br><br>
    <button class="w3-button w3-green">Accedi!</button>
  </form>