<?php
$contents = filter_var($_POST["file"], FILTER_SANITIZE_STRING);

if (empty($content)) {
  die("Content");
}

$h = fopen('protected/disk/' . $user->dir . '/' . $bb, "w+");
fwrite($h, $contents);
fclose($h);

header("Location: https://s1.fcosma.it/u/$pp[0]/fileopen/$bb");