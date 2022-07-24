<!DOCTYPE html>
<html>
 <head>
  <title>Fox Cloud</title>
  <meta charset="UTF-8">
  <?php require_once("protected/components/meta.php"); ?>

  <meta name="keywords" content="Federico, Cosma, Federico Cosma, Fcosma, Cloud, Fcosma Cloud, PHP">
  <meta name="author" content="Federico Cosma">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="https://foxcloud.fcosma.it/assets/img/icon.png">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdn.rgbcraft.com/static/fontawesome/css/all.min.css">
 </head>
 <body style="text-align: center; background: white" id='body'>
  <div id='debug' style='display: none'>
   <span id='temp_1'></span>
   <span id='temp_2'></span>
   <span id='debug_1'></span>
  </div>
  <div id='footer' class='w3-container w3-bottom'  style='padding: 5px'>
   <br><br>
   <div id='footerContent' class='w3-white' style='padding: 0px; position: absolute; bottom: 0px; text-align: center; width: 100%'>
    <span>&copy; 2021 - 2022 <a href='https://foxcloud.fcosma.it/'>FoxCloud</a> by <a href='https://github.com/FoxWorn3365'>FoxWorn3365</a> | Rilasciato sotto <a href='https://github.com/FoxWorn3365/Cloud/blob/v1.5/LICENSE'>GNU General Public License v3.0<a class='w3-right w3-button' onclick='changeTon()'><i id='ton' class="fa-solid fa-sun"></i></a></span>
   </div>
  </div>
  <script>
  function isInDarkMode() {
    if (document.cookie.split(';').some((item) => item.includes('mode=dark'))) {
      return true;
    } else {
      return false;
    }
  }

  // caricamento
  document.getElementById('body').addEventListener('load', checkView());
  
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
  </script>
 <?php require_once("protected/components/menu.php"); ?>
