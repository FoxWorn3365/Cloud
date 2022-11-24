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

session_start();
require_once("protected/components/header.php");
?>
<br>
 <div class='foxcloud-homepage-box w3-display-container'>
  <span style='font-size: 50px'><b>FoxCloud - Informazioni</b></span>
  <div class='foxcloud-homepage-inBox-left'>
   Tutte le informazioni relative a quest'istanza di FoxCloud.
  </div>
 </div>
 <br>
 <div class='foxcloud-homepage-box w3-display-container'>
  <span style='font-size: 30px'><b>Mantenitori e Contributori</b></span>
  <div class='foxcloud-homepage-inBox-left'>
   <a href='https://github.com/FoxWorn3365/'><b>FoxWorn3365</b></a> <i>Principale sviluppatore di FoxCloud.</i><br>
  </div>
 </div>
 <br>
 <div class='foxcloud-homepage-box w3-display-container'>
  <span style='font-size: 30px'><b>Pacchetti usati</b></span>
  <div class='foxcloud-homepage-inBox-left'>
   <a href='https://github.com/FoxWorn3365/FoxPlayer'><b>FoxPlayer</b></a> <i>Player di video. Versione adattata a FoxCloud.</i><br>
   <a href='https://github.com/erusev/parsedown'><b>Parsedown</b></a> <i>Gestore del markdown per i file .md</i>
  </div>
 </div>
 <br>
 <div class='foxcloud-homepage-box w3-display-container'>
  <span style='font-size: 30px'><b><i class="fa-solid fa-earth-europe"></i> FoxCloud World</b></span>
  <div class='foxcloud-homepage-inBox-left'>
<?php
// FoxCloud World Loader
if (file_exists('protected/sys/foxworld.key')) {
  $key = file_get_contents('protected/sys/foxworld.key');

  $is = json_decode(file_get_contents('https://foxcloud.fcosma.it/api/world/get?host=' . $key));
  if ($is->status == 200) {
?>
   Questa istanza di <b>FoxCloud</b> risulta al momento correttamente registrata tramite <u>FoxCloudWorld</u>.<br>
   <h3>Istanza: foxcloudworld-<?= $is->data->id; ?></h3>
   Presente sui nostri sistemi dal <code><?= date('d/m/Y - H:i:s', $is->data->date); ?></code> - Istanza N°<?= $is->data->number; ?> di FoxCloud registrata.
<?php
  }
} else {
?>
   Istanza non presente su <b>FoxCloudWorld</b>, probabilmente l'opzione è stata disattivata dalla configurazione!
<?php
}
?>
  </div>
 </div>
 <br><br><br><br>
