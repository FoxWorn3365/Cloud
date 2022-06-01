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
   echo "<div style='position: absolute; text-align: left; left: 50px; width: 95%'>";
   echo '<pre>' . file_get_contents("protected/disk/" . $user->dir . "/$bb") . '</pre>';
   echo '<br><br><br><br><br>';
   echo "</div>";
} elseif ($ext[$cc-1] == "png" || $ext[$cc-1] == "jpg" || $ext[$cc-1] == "jpeg") {
   echo '<button class="w3-button w3-orange w3-text-white" onclick="resize(0)" id="siz"></button><br><br>';
   echo '<img id="img" src="/image?user=' . $shared[0]. '&sharedurl=' .$link. '&type=shared" style="height: 80%; width: 100%">';
?>
 <script>
 var mode = 0;
 document.getElementById('siz').innerText = "Ridimensiona";
 function resize() {
  if (mode == 0) {
   document.getElementById('siz').innerText = "Originale";
   document.getElementById('img').style.width = "50%";
   mode = 1;
  } else {
   document.getElementById('siz').innerText = "Ridimensiona";
   document.getElementById('img').style.width = "";
   mode = 0;
  }
 }
 </script>
<?php
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
<video controls style='width: 50%'>
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
