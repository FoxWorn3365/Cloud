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

$bb = str_replace("%20", " ", $bb);
?>
<br>
 <h1>Condividi un file</h1>
 <br><br>
 <b>Stai per condividere il file <code><?= $bb; ?></code></b>
 <br><br>
 <form method="post" action="/sharing">
   Inserisci una password.<br><u>Se non desideri usare una password lascia vuoto</u><br>
   <input type="text" name="typePasswordOfShared1" class='foxcloud-input'><br><br>
   <button class="w3-button w3-orange w3-text-white">Condividi</button>
 </form>
 <br><br><br>
 <span style="color: red"><b>ATTENZIONE!</b> Se non imposti una password tutti coloro che hanno il link potranno accedere al contenuto!</span>
 <br><br>
