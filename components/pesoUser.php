<?php
require_once("protected/components/peso.php");
// calcolo il peso di una ipotetica cartella contenente immagini
$size = dirsize('protected/disk/' . $user->dir . '/');

// converto in MB con una precisione di due decimali
$mb = round($size / 1000000, 2);
$gb = round($mb / 1000, 2);

$free = $user->diskSpace - $gb; 
$freeMB = $user->diskSpace * 1000 -$mb;
$used = $user->diskSpace - $free;

$freebytes = round($freeMB * 1000000, 2);