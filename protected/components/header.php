<?php
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
  <link rel="icon" type="image/png" href="https://foxcloud.fcosma.it/assets/img/icon.png">
  <link rel="stylesheet" href="/w3.css">
  <link rel="stylesheet" href="/local.css">
  <link rel="stylesheet" href="https://resources.fcosma.it/fa/css/all.min.css">
 </head>
 <body style="text-align: center; background: white" id='body'>
  <div id='temp_1' style='display: none'></div>
  <div class="w3-bar foxcloud-navbar">
<?php
if ($a == "/login") {
?>
    <a href="/" class="w3-bar-item foxcloud-button">Home</a>
    <a href="/info" class="w3-bar-item foxcloud-button">Info</a>
    <a href="<?= $a; ?>" class="w3-bar-item foxcloud-button w3-right"><?= $text; ?></a>
<?php
} else {
?>
    <a href="/" class="w3-bar-item foxcloud-button"><i class="fa fa-home" aria-hidden="true"></i></a>
    <a onclick='showUserInfo()' class="w3-bar-item foxcloud-button"><i class="fa fa-user" aria-hidden="true"></i></a>
    <a href="/u/<?= $_SESSION["user"]; ?>/files/" class="w3-bar-item foxcloud-button"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
    <a href="/u/<?= $_SESSION["user"]; ?>/sharedList" class="w3-bar-item foxcloud-button"><i class="fa fa-share-alt-square" aria-hidden="true"></i></a>
    <a href="/u/<?= $_SESSION["user"]; ?>/settings" class="w3-bar-item foxcloud-button w3-right"><i class="fa fa-cogs" aria-hidden="true"></i></a>
<?php
}
?>
  </div>
  <div id='footer' class='w3-container'  style='padding: 5px; position: absolute; left: 0px; width: 100%;'>
   <br><br>
   <div id='footerContent' class='w3-white' style='padding: 0px; position: absolute; bottom: 0px; text-align: center; width: 100%'>
    <span>&copy; 2021 - 2022 <a href='https://foxcloud.fcosma.it/'>FoxCloud</a> by <a href='https://github.com/FoxWorn3365'>FoxWorn3365</a> | Rilasciato sotto <a href='https://github.com/FoxWorn3365/Cloud/blob/v1.5/LICENSE'>GNU General Public License v3.0</a><a class='w3-right w3-button' onclick='changeTon()'><i id='ton' class="fa-solid fa-sun"></i></a></span>
   </div>
  </div>
  <script>
  let body = document.body;
  let html = document.documentElement;

  const height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );

  document.body.onload = function() {
     document.getElementById('footer').style.display = "block";
     document.getElementById('footer').style.top = height - 50 + "px";
  }

  function isInDarkMode() {
    if (document.cookie.split(';').some((item) => item.includes('mode=dark'))) {
      return true;
    } else {
      return false;
    }
  }

  // caricamento
  document.getElementById('body').addEventListener('load', checkView());
  
  (function() {
    if (!isInDarkMode()) {
      changeTon();
    }
  }());

  function checkView() {
    if (isInDarkMode()) {
      document.getElementById('ton').classList = "fa-solid fa-sun";
      changeTon();
    } else {
      document.getElementById('ton').classList = "fa-solid fa-moon";
      changeTon();
    }
  }

  function setViewCookie(mode) {
    if (mode == "dark") {
      document.cookie = "mode=dark; Secure";
    } else {
      document.cookie = "mode=light; Secure";
    }
  }
      
  function changeTon() {
    document.getElementById('temp_1').innerHTML = Number(document.getElementById('temp_1').innerHTML) + 1;
 
    if (Number(document.getElementById('temp_1').innerHTML) == 5) {
      window.location.href = "/admin/easter-egg/bazinga";
    }

    if (document.getElementById('ton').classList == "fa-solid fa-sun") {
      // Mettiamo in modalità notte
      document.getElementById('ton').classList = "fa-solid fa-moon";
      document.getElementById('body').style.color = "white";
      document.getElementById('body').style.backgroundColor = "black";
      document.getElementById('footerContent').classList = "w3-black w3-text-white";
      setViewCookie('dark');
    } else {
      document.getElementById('ton').classList = "fa-solid fa-sun";
      document.getElementById('body').style.color = "black";
      document.getElementById('body').style.backgroundColor = "white";
      document.getElementById('footerContent').classList = "w3-white w3-text-black";
      setViewCookie('light');
    }
  }
   
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
