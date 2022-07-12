<?php
$bb = str_replace("%20", " ", $bb);

   header("Content-Type: image/jpg");
   header("Content-Length: " . filesize("protected/disk/$user->dir/$bb"));
   readfile("protected/disk/$user->dir/$bb");
?>
