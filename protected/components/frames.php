  <div id='userinfo' class='foxcloud-userinfo' style='display: none'>
<?php
$info = json_decode(file_get_contents('protected/users/' . USER . '/userinfo.conf'));
?>
   <h1><?= USER; ?></h1>
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
  document.body.onload = function() {
    document.getElementById('userinfo').style.top = document.getElementById('navbar').offsetHeight + 'px';
  }
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
