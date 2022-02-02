<?php
if (empty($lol)) {
  $a = "Lol";
}
header("Content-Type: image/jpg");
header("Content-Length: " . filesize("protected/disk/diskNumber139/Fox.jpg"));
readfile("protected/disk/diskNumber139/Fox.jpg");