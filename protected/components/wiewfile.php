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

require_once("protected/components/wiew_header.php");

if ($ext[$cc-1] == "txt" || $ext[$cc-1] == "md" || $ext[$cc-1] == "fox") {
   $tempText = preg_split('/\r\n|\r|\n/', file_get_contents("protected/disk/" . $user->dir . "/$bb"));
   $text = "<!-- Generato da FoxCloud Line Reader -->";
   foreach ($tempText as $row) {
     $text = $text . $row . '<br>';
   }
   echo "<div>";
   echo '<p style="margin: 25px; text-align: left; max-width: 90%">' . $text . '</pre>';
   echo '<br><br><br><br><br>';
   echo "</div>";
} elseif ($ext[$cc-1] == "png" || $ext[$cc-1] == "jpg" || $ext[$cc-1] == "jpeg" || $ext[$cc-1] == "gif") {
   echo '<img src="/u/' .$pp[0]. '/getcontentfile/' .$bb . '" id="resized">';
} elseif ($ext[$cc-1] == "mp3" || $ext[$cc-1] == "ogg" || $ext[$cc-1] == "wav") {
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
<video controls style='width: 50%;'>
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb; ?>" type="video/mp4">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb; ?>" type="video/avi">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb; ?>" type="video/webm">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb; ?>" type="video/x-matroska">
  Il tuo browser non supporta il tag video di HTML!
</video>
<?php
} else {
   die("Il file che stai cercando di visualizzare non è supportato!<br>Per aprirlo, scaricalo.");
}
