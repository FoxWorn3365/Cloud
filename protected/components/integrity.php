<?php
require_once('protected/components/adminSecurity.php');
$v = file_get_contents('version.txt');

// Inizio controllo attività caricando dalle API in base alla versione i file e le dir richieste
$info = json_decode(file_get_contents('https://foxcloud.fcosma.it/api/integrityCheck/' . $v . '.json'));

if ($info->status != 200) {
  die("<span style='color: red'>LA VERSIONE NON RISULTA PRESENTE SUI NOSTRI HOST</span>");
}

// Procediamo ad analizzare passo per passo la versione
?>
<style>
a {
  text-decoration: none;
  color: green;
}
</style>
<h1>Inizio analisi integrità (File FoxCloud v<?= $v ?>@main) [ <?= date("H:i:s"); ?> ]</h1>
<?php
foreach ($info->layers as $layer) {
?>
  <h3>Inizio analisi del Layer "<?= $layer->name; ?>"</h3>
<?php
  foreach ($layer->files as $file) {
    if (file_exists($file)) {
?>
   <span style='color: green'>File <b><a href='https://github.com/FoxWorn3365/Cloud/blob/v<?= $v; ?>/<?= $file; ?>'><?= $file; ?></a></b> controllato con successo => PRESENTE</span><br>
<?php
    } else {
?>
   <span style='color: red'>File <?= $file; ?> <u>NON PRESENTE SUL CLOUD!</u>. Ti consigliamo di reinstallare la versione oppure recuperare il file da <a href='https://github.com/FoxWorn3365/Cloud'>GitHub</a> => <a href='https://github.com/FoxWorn3365/Cloud/blob/v<?= file_get_contents('version.txt'); ?>/<?= $file; ?>'>QUI</a></span><br>
<?php
      die("File non trovato, task terminata con un errore");
    }
  }

  foreach ($layer->dir as $dir) {
    if (is_dir($dir)) {
?>
   <span style='color: green'>Directory <a href='<b><a href='https://github.com/FoxWorn3365/Cloud/blob/v<?= $v; ?>/<?= $dir; ?>'><?= $dir; ?></a></b> controllata con successo => PRESENTE</span><br>
<?php
    } else {
?>
   <span style='color: red'>Directory <?= $dir; ?> <u>NON PRESENTE SUL CLOUD!</u>. Ti consigliamo di reinstallare la versione oppure creare la directory <code><?= $dir; ?></code> con i giusti permessi.</span><br>
<?php
      die("File non trovato, task terminata con un errore");
    }
  }
}
die("<br><br><span style='font-size: 40px'>Operazione terminata con successo, task esaurita con 0 errori => <b>tutti i file sono presenti</b></span>");
?>
