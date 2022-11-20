<?php
require_once("protected/components/header.php");
session_start();

if (!empty($_SESSION["admin"])) {
  header("Location: /admin/mep");
}
?>
  <br><br>
  <h1>Accedi alla zona Admin</h1>
  <br>
  <form method="post" action="/admin.php?action=auth">
    Username:<br>
    <input type="text" name="username" class='foxcloud-input'><br>
    Password:<br>
    <input type="password" name="password" class='foxcloud-input'>
    <br><br>
    <button class="foxcloud-button">Accedi!</button>
  </form>
