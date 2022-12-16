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

require_once('protected/components/adminSecurity.php');
$v = file_get_contents('version.txt');

$info = json_decode(file_get_contents('https://foxcloud.fcosma.it/api/integrityCheck/' . $v . '.json'));
$latest = json_decode(file_get_contents('https://foxcloud.fcosma.it/api/integrityCheck/latest.json'))->latest;

if ($info->status != 200) {
  die("<span style='color: red'>LA VERSIONE ({$v}) NON RISULTA PRESENTE SUI NOSTRI HOST</span>");
}
?>
<h1>Inizio aggiornamento FoxCloud (File FoxCloud v<?= $v ?>@main) [ <?= date("H:i:s"); ?> ]</h1><br>
<?php
$count = 0;
foreach ($info->layers as $layer) {
  foreach ($layer->files as $file) {
    $count++;
    file_put_contents($file, file_get_contents('https://raw.githubusercontent.com/FoxWorn3365/Cloud/' . $latest . '/' . $file));
  }
}
?>
<h1>Aggiornamento completato con successo => Aggiornati <?= $count; ?> file</h1>

<?php
die();
?>
