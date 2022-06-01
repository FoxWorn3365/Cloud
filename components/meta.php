<?php
 $bb = str_replace("%20", " ", $bb);

 // Verifichiamo subito cosa è 
 if (stripos($url, "/u/") !== false) {
   // Recuperiamo solo le info dell'utente
   $mt = str_replace("/u/", "", $url);
   $mt = explode("/", $mt);
   $mt = $mt[0];

   $ig = json_decode(file_get_contents("protected/users/$mt/userinfo.conf"));

 ?>
<meta name="description" content="Pagina dell'utente <?= $mt; ?>, ovvero <?= $ig->name; ?>">
 <?php
 } elseif (stripos($url, "/s/") !== false) {
   // Recupero le info
   $mt = str_replace("/s/", "", $url);
   $mt = explode("/", $mt);
   $mt = $mt[0];

   $ig = explode("{}",  file_get_contents("protected/shared/$mt"));
   echo '<meta name="description" content="File ' . $ig[2] . ', condiviso da ' . $ig[0]. '">
';
 } else {
 ?>
<meta name="description" content="Il cloud di Federico è uno spazio digitale dove si possono caricare e scaricare file online">
 <?php
 }
?>
   