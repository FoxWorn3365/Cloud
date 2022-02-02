<?php

$file='protected/disk/' . $user->dir . '/' . $bb;

header('Content-Type: video/mp4'); 
header('Accept-Ranges: bytes');
header('Content-Length:'.filesize($file));

readfile($file);