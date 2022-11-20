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

function load($errortitle, $user, $errornumber, $error) { // Error facoltativo
   $vv = file_get_contents("protected/pages/anerror.pagetext");
   $vv = str_replace("%title%", $errortitle, $vv);
   $vv = str_replace("%error%", $error, $vv);
   $vv = str_replace("%en%", $errornumber, $vv);
   $vv = str_replace("%user%", $user, $vv);
   $vv = str_replace("%back%", $_SERVER["HTTP_REFERER"], $vv);

   return $vv;
}

function loadSuccess($errortitle, $user, $errornumber, $error) { // Error facoltativo
   $vv = file_get_contents("protected/pages/ansuccess.pagetext");
   $vv = str_replace("%title%", $errortitle, $vv);
   $vv = str_replace("%error%", $error, $vv);
   $vv = str_replace("%en%", $errornumber, $vv);
   $vv = str_replace("%user%", $user, $vv);
   $vv = str_replace("%back%", $_SERVER["HTTP_REFERER"], $vv);

   return $vv;
   die("NO");
}
