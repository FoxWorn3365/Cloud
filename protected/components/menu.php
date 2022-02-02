<?php
if (empty($_SESSION["user"])) {
  $a = "/login";
  $text = "Accedi";
} else {
  $a = '/u/' .$_SESSION["user"]. '/dashboard';
  $text = "Dashboard";
}
?>
  <div class="w3-bar w3-orange w3-text-white">
    <a href="/" class="w3-bar-item w3-button">Home</a>
    <a href="/info" class="w3-bar-item w3-button">Info</a>
    <a href="<?= $a; ?>" class="w3-bar-item w3-button w3-right"><?= $text; ?></a>
  </div>
  <br><br>