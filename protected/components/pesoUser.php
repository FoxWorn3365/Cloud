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
