<?php
// v1.5
$contents = filter_var($_POST["file"], FILTER_SANITIZE_STRING);
$bb = str_replace("%20", " ", $bb);

if (empty($content)) {
  die("Content");
}

if (end(explode('.', $bb)) == "fox") {
  // Ci divertiamo con i placeholders ed il markdown
  $contents = str_replace("%data%", date("d/m/Y - H:i"), $contents);
  $contents = str_replace("%img%", "<img src='", $contents);
  $contents = str_replace("%/img%", "'>", $contents);
}

$h = fopen('protected/disk/' . $user->dir . '/' . $bb, "w+");
fwrite($h, $contents);
fclose($h);

header("Location: https://s1.fcosma.it/u/$pp[0]/fileopen/$bb");
