<?php
require_once("protected/components/pesoUser.php");

$bb = str_replace("%20", " ", $bb);
?>

<form enctype="multipart/form-data" action="/up" method="POST">
  <input type="hidden" name="user" value="<?= $pp[0]; ?>">
  <input type="hidden" name="dir" value="<?= $bb; ?>">
  <input type="hidden" name="MAX_FILE_SIZE" value="<?= $freebytes; ?>">
  Invia questo file: <input name="userfile" type="file"></br>
  <input type="submit" value="Invia File">
</form>