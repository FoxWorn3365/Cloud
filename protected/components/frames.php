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
  <div id='settings' class='foxcloud-settings'>
   <a href='/logout' class='foxcloud-button' style='float: right'><i class="fa fa-sign-out" aria-hidden="true"></i></a>
   <h1>Hej!</h1>
   Al momento non ci sono impostazioni da impostare, provvederemo ad aggiungerle nella v1.9.<br>
  </div>
  <script>
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

