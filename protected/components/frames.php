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
?>
  <div id='userinfo' class='foxcloud-userinfo' style='display: none'>
<?php
$info = json_decode(file_get_contents('protected/users/' . $_SESSION["user"] . '/userinfo.conf'));
?>
   <h1><?= $_SESSION["user"]; ?></h1>
   <div class='foxcloud-userinfo-internalInfo'>
    <b>Nome:</b> <?= $info->name; ?><br>
    <b>Cognome:</b> <?= $info->surname; ?><br>
    <b>Email:</b> <?= $info->email; ?><br>
   </div>
   <br>
   <?php require_once("protected/components/pesoUser.php"); ?>
   <h3>Spazio su Disco</h3><br>
   Al momento stai usando <b><?= $gb; ?>GB</b> sul disco.<br><br>
   <b><?= $gb; ?></b> <progress max='<?= $info->diskSpace; ?>' value='<?= $gb; ?>'></progress> <b><?= $info->diskSpace; ?></b><br><br>
  </div>
  <script>
  var b = 0;
  let a = document.getElementById('userinfo');
  function showUserInfo() {
    if (b == 0) {
      a.style.display = "block";
      b = 1;
    } else {
      a.style.display = "none";
      b = 0;
    }
  }
  </script>
  <!-- SEPARATORIO > IMPOSTAZIONI -->
<?php
$localS = json_decode(file_get_contents('protected/sys/.' . $_SESSION["user"] . '_preferences.sys'));
if ($localS->foxPlayer == "true") {
  $a = ' checked';
} else {
  $a = '';
}

if ($localS->searchBar == "true") {
  $b = ' checked';
} else {
  $b = '';
}
?>
  <div id='settings' class='foxcloud-settings'>
   <a href='/logout' class='foxcloud-button' style='float: right'><i class="fa fa-sign-out" aria-hidden="true"></i></a>
   <h1>Impostazioni di FoxCloud</h1>
   <div class='foxcloud-settings-list'>
    <b>Usa <a href='https://github.com/FoxWorn3365/FoxPlayer' target='about:blank'>FoxPlayer</a></b> <input type='checkBox' class='foxcloud-iterator-settings' value='1' onclick='updateSettings()'<?= $a; ?>><br>
    <b>Abilita la searchBox nella lista file</b> <input type='checkBox' class='foxcloud-iterator-settings' value='1' onclick='updateSettings()'<?= $b; ?>>
   </div>
   <br>
  </div>
  <script>
  async function updateSettings() {
    const settings = document.getElementsByClassName('foxcloud-iterator-settings');
    await fetch('/updateSettings.php?foxPlayer=' + settings[0].checked + '&searchBar=' + settings[1].checked);
    alert('Impostazioni aggiornate con successo!');
  }

  document.body.onload = function() {
    document.getElementById('userinfo').style.top = document.getElementById('navbar').offsetHeight + 'px';
    document.getElementById('settings').style.top = document.getElementById('navbar').offsetHeight + 'px';
  }

  var d = 0;
  let c = document.getElementById('settings');
  function showUserSettings() {
    if (d == 0) {
      c.style.display = "block";
      d = 1;
    } else {
      c.style.display = "none";
      d = 0;
    }
  }
  </script>
