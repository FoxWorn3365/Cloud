<br>
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
 <h1>Crea una nuova Directory</h1>
 <a href="<?= $_SERVER["HTTP_REFERER"]; ?>"><i class="fa fa-level-up" aria-hidden="true"></i></a>
 <br><hr>
 La directory che stai creando sarà: <code><b><?= $bb ?></b><span id='newdirname'></span></code>
 <br><br>
 <form method="post" action="/newdir">
   <input type="hidden" name="user" value="<?= $pp[0]; ?>">
   <input type="hidden" name="dir" value="<?= $bb; ?>">
   Inserisci il nome: <input type="text" name="nomedelladirectory" id='dirname' maxlength='25' class='foxcloud-input'><br>
   <br><button class="foxcloud-button">Crea</button>
 </form>
 <script>
 document.getElementById('dirname').addEventListener('input', () => { document.getElementById('newdirname').innerHTML = document.getElementById('dirname').value; });
 </script>

