<?php
session_start();
require_once("protected/components/header.php");
?>
<br>
 <h1>Documentazione sulle API del cloud</h1>
 <br><br>
 <h2>Recuperare immagine (SOLO SESSIONE)</h2>
 <code>/u/{user}/getcontentfile/{imageurl}</code>
 <h2>Recuperare video con uno shared</h2>
 <code>/video?user={utente che ha condiviso}&dir={file nel file shared}&sharedurl={sharedurl}</code>
 <h2>Recuperare audio con uno shared</h2>
 <code>/audio?user={utente che ha condiviso}&dir={file nel file shared}&sharedurl={sharedurl}</code>