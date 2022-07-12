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
    <input type="text" name="username"><br>
    Password:<br>
    <input type="password" name="password">
    <br><br>
    <button class="w3-button w3-green">Accedi!</button>
  </form>
