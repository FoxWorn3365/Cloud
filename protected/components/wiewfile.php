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
<style>
#resized {
  max-height: 50%;
  max-width: 100%
}
</style>
<?php
// Recupero le info del file

$bb = str_replace("%20", " ", $bb);
$bb = str_replace("%28", "(", $bb);
$bb = str_replace("%29", ")", $bb);

// Mostro il file
$ext = explode(".", $bb);

$cc = count($ext);

$localS = json_decode(file_get_contents('protected/sys/.' . $_SESSION["user"] . '_preferences.sys'));

require_once("protected/components/wiew_header.php");

if ($ext[$cc-1] == "txt" || $ext[$cc-1] == "md" || $ext[$cc-1] == "fox") {
   require 'protected/packages/Parsedown/parsedown.php';
   $markdown = new Parsedown();
   $tempText = preg_split('/\r\n|\r|\n/', file_get_contents("protected/disk/" . $user->dir . "/$bb"));
   $text = "<!-- Generato da FoxCloud Line Reader -->";
   foreach ($tempText as $row) {
     if ($ext[$cc-1] == "md") {
       $text = $text . $markdown->line($row) . '<br>';
     } else {
       $text = $text . $row . '<br>';
     }
   }
?>
  <div class='foxcloud-textContent'>
   <p style="margin: 25px; text-align: left; max-width: 90%"><?= $text ?></p>
   <br><br><br><br>
  </div>
<?php
} elseif ($ext[$cc-1] == "png" || $ext[$cc-1] == "jpg" || $ext[$cc-1] == "jpeg" || $ext[$cc-1] == "webm" || $ext[$cc-1] == "gif") {
   echo '<img src="/u/' .$pp[0]. '/getcontentfile/' .$bb . '" id="resized">';
} elseif ($ext[$cc-1] == "mp3" || $ext[$cc-1] == "ogg" || $ext[$cc-1] == "wav" || $ext[$cc-1] == "m4a") {
?>
<audio controls>
  <source src="<?= '/audio?user=' . $pp[0] . '&dir=' . $bb; ?>" type="audio/mpeg">
  <source src="<?= '/audio?user=' . $pp[0] . '&dir=' . $bb; ?>" type="audio/ogg">
  <source src="<?= '/audio?user=' . $pp[0] . '&dir=' . $bb; ?>" type="audio/wav">
  Il tuo browser non sopporta il tag audio di HTML!
</audio>
<?php
} elseif ($ext[$cc-1] == "mp4" || $ext[$cc-1] == "avi" || $ext[$cc-1] == "webm" || $ext[$cc-1] == "mkv") {
?>
<video controls style='width: 50%;' class='foxPlayer'>
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb; ?>" type="video/mp4">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb; ?>" type="video/avi">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb; ?>" type="video/webm">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb; ?>" type="video/x-matroska">
  Il tuo browser non supporta il tag video di HTML!
</video>
<?php
if ($localS->foxPlayer == "true") {
?>
<script src='/foxplayer.js'></script>
<?php
  }
} else {
   die("Il file che stai cercando di visualizzare non è supportato!<br>Per aprirlo, scaricalo.");
}
?>
