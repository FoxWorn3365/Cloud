<?php
   header("Content-Type: image/png");
   header("Content-Length: " . filesize("protected/oth/audio.png"));
   readfile("protected/oth/audio.png");
?>
