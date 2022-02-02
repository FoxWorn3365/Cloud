<?php
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