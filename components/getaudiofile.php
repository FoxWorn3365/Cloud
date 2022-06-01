<?php
$bb = str_replace("%20", "", $bb);
$bb = str_replace("%28", "(", $bb);
$bb = str_replace("%29", ")", $bb);

$fileloc ='protected/disk/diskNumber139/report_to_mtf_external.mp3';

header('Content-type: audio/mpeg3');
header('Content-Disposition: inline; filename=report_to_mtf_external.mp3');
header('Content-Length:'.filesize($fileloc));

readfile($fileloc);