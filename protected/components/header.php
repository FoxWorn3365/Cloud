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

// Verifichiamo l'URL del caricamento delle cose che ci interessano tipo il mirror delle risorse
if (!isset($cloudConfig)) {
  $cloudConfig = json_decode(file_get_contents('protected/config/config.json'));
}
$mirror = $cloudConfig->resourcesMirror;
$elements = explode(' ', $mirror);
if ($elements[0] == "auto") {
  $resources = 'https://resources.fcosma.it/fa/css/all.min.css';
} elseif ($elements[0] == "defined") {
  $resources = 'https://resources.fcosma.it/fa/css/all.min.css?' . $elements[1];
} elseif ($elements[0] == "custom") {
  if ($elements[1] == "HTTP") {
    $resources = $elements[2];
  }
}

if (empty($_SESSION["user"])) {
  $a = "/login";
  $text = "Accedi";
} else {
  $a = '/u/' .$_SESSION["user"]. '/dashboard';
  $text = "Dashboard";
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Fox Cloud</title>
  <meta charset="UTF-8">
  <?php require_once("protected/components/meta.php"); ?>

  <meta name="keywords" content="FoxCloud, Cloud, File, PHP, PHP Made, PHP Art">
  <meta name="author" content="Federico Cosma">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="https://resources.fcosma.it/foxcloud/logo.png">
  <link rel="stylesheet" href="/w3.css">
  <link rel="stylesheet" href="/local.css">
  <link rel="stylesheet" href="<?= $resources; ?>">
 </head>
 <body style="text-align: center; background: black; color: white;height: fit-content" id='body'>
  <div id='temp_1' style='display: none'></div>
  <div class="w3-bar foxcloud-navbar" id='navbar'>
<?php
if ($a == "/login") {
?>
    <a href="/" class="w3-bar-item foxcloud-button-expanded">Home</a>
    <a href="/info" class="w3-bar-item foxcloud-button-expanded">Info</a>
    <a href="<?= $a; ?>" class="w3-bar-item foxcloud-button-expanded w3-right"><?= $text; ?></a>
<?php
} else {
?>
    <a title='Home' href="/u/<?= $_SESSION["user"]; ?>/files/" class="w3-bar-item foxcloud-button-expanded"><i class="fa fa-home" aria-hidden="true"></i></a>
    <a title="Informazioni sull'utente" onclick='showUserInfo()' class="w3-bar-item foxcloud-button-expanded"><i class="fa fa-user" aria-hidden="true"></i></a>
    <a title='I tuoi file' href="/u/<?= $_SESSION["user"]; ?>/files/" class="w3-bar-item foxcloud-button-expanded"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
    <a title='I tuoi file condivisi' href="/u/<?= $_SESSION["user"]; ?>/sharedList/" class="w3-bar-item foxcloud-button-expanded"><i class="fa fa-share-alt-square" aria-hidden="true"></i></a>
    <a title='Imposazioni' onclick='showUserSettings()' class="w3-bar-item foxcloud-button-expanded w3-right"><i class="fa fa-cogs" aria-hidden="true"></i></a>
<?php
  $b = '';
}
?>
  </div>
<?php
if (isset($b)) {
  require 'protected/components/frames.php';
}
?>
  <script>
/*   RICORDI
  function isInDarkMode() {
    if (document.cookie.split(';').some((item) => item.includes('mode=dark'))) {
      return true;
    } else {
      return false;
    }
  }
*/

  function getDevice() {
    const ua = navigator.userAgent;
    if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
      return "tablet";
    } else if (/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) {
      return "mobile";
    } else {
      return "desktop";
    }
  }
  </script>
