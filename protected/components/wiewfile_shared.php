<?php
// Recupero le info del file

$bb = str_replace("%20", " ", $bb);
$bb = str_replace("%28", "(", $bb);
$bb = str_replace("%29", ")", $bb);

// Mostro il file
$ext = explode(".", $bb);

$cc = count($ext);

require_once("protected/components/wiew_header.php");

if ($ext[$cc-1] == "txt" || $ext[$cc-1] == "md") {
   echo '<pre>' . file_get_contents("protected/disk/" . $user->dir . "/$bb") . '</pre>';
} elseif ($ext[$cc-1] == "png" || $ext[$cc-1] == "jpg" || $ext[$cc-1] == "jpeg") {
   echo '<img src="/s/' .$link. '/getimage/' .$bb . '">';
} elseif ($ext[$cc-1] == "mp3" || $ext[$cc-1] == "ogg") {
?>
<audio controls>
  <source src="<?= '/audio?user=' . $pp[0] . '&type=shared&sharedurl=' . $link. '&dir=' . $bb; ?>" type="audio/mpeg">
  <source src="<?= '/audio?user=' . $pp[0] . '&type=shared&sharedurl=' . $link. '&dir=' . $bb; ?>" type="audio/ogg">
  Il tuo browser non sopporta il tag audio di HTML!
</audio>
<?php
} elseif ($ext[$cc-1] == "mp4" || $ext[$cc-1] == "avi" || $ext[$cc-1] == "webm" || $ext[$cc-1] == "mkv") {
?>
<video controls>
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb . '&type=shared&sharedurl=' . $link; ?>" type="video/mp4">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb . '&type=shared&sharedurl=' . $link; ?>" type="video/avi">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb . '&type=shared&sharedurl=' . $link; ?>" type="video/webm">
  <source src="<?= '/video?user=' . $pp[0] . '&dir=' . $bb . '&type=shared&sharedurl=' . $link; ?>" type="video/mkv">
  Il tuo browser non supporta il tag video di HTML!
</video>
<?php
} else {
   die("Il file che stai cercando di visualizzare non è supportato!<br>Per aprirlo, scaricalo.");
}
