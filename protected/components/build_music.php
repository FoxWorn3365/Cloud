<?php
// Recuperiamo subito la canzone con le sue info
$info = json_decode(file_get_contents("protected/disk/diskOfMusic/info/$music"));
?>
<br>
 <h1>Fcosma Cloud - Musica</h1>
 <hr>
 <h2><?= $info->name; ?></h2>
 <b>Autore:</b> <?= $info->author; ?><br>
 <b>Data di rilascio:</b> <?= $info->data; ?>
 <b>Presente in:</b> <?= $info->presence; ?>
 <br><br>
 <audio controls>
  <source src="/audio?user=music&type=shared&sharedurl=<?= $info->shared; ?>&dir=track/<?= $music; ?>.ogg" type="audio/ogg">
  Il tuo browser non supporta il tag Audio!
 </audio>
 <br>
 <img src="/music_copertina?track=<?= $music; ?>"><br><br><hr><br><br><a href="https://cloud.fcosma.it/m/<?= $music; ?>/related"><button class="w3-button w3-orange w3-text-white" style="font-size: 50px">Relativo al Brano</button></a><br>
 In questa sezione delle cose <b>Relative al brano</b> puoi trovare canzoni correlate, il link di youtube e spotify e altre cose interessanti riguardo alla canzone