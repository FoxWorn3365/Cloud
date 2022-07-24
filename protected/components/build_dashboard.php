  <h1>Benvenuto, <?= $pp[0]; ?></h1>
  <br><br>
  <h3>Informazioni sull'utente</h3>
  <b>Nome:</b> <?= $user->name; ?> | <b>Cognome:</b> <?= $user->surname; ?> | <b>Email:</b> <?= $user->email; ?><br><br>
  <br>
  <h3>Opzioni</h3>
  <a href="file"><button class="w3-button w3-orange w3-text-white">Vai ai tuoi File</button></a>
  <a href="/u/<?= $pp[0]; ?>/sharedList/"><button class="w3-button w3-orange w3-text-white">Vai ai file Condivisi</button></a>
  <a href="/logout"><button class="w3-button w3-red w3-text-white">Esci</button></a>
  <br>
  <h3>Gestione dello Spazio</h3>
  <b>Il tuo spazio totale:</b> <?= $user->diskSpace; ?>GB
  <br>
<?php
require_once("protected/components/pesoUser.php");
?>

  <b>Spazio usato:</b> <?= $gb; ?>GB (<?= $mb; ?>MB)<br>
  <b>Spazio libero:</b> <?= $free ?>GB (<?= $freeMB ?>MB )
