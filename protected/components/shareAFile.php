<?php

$bb = str_replace("%20", " ", $bb);
?>
<br>
 <h1>Condividi un file</h1>
 <br><br>
 <b>Stai per condividere il file <code><?= $bb; ?></code></b>
 <br><br>
 <form method="post" action="/sharing">
   Inserisci una password.<br><u>Se non desideri usare una password lascia vuoto</u><br>
   <input type="text" name="typePasswordOfShared1"><br><br>
   <button class="w3-button w3-orange w3-text-white">Condividi</button>
 </form>
 <br><br><br>
 <span style="color: red"><b>ATTENZIONE!</b> Se non imposti una password tutti coloro che hanno il link potranno accedere al contenuto!</span>
 <br><br>