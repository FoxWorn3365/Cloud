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
?>
<br>
 <h1>File Editor</h1><br>
 <form action="/saveFile" method="POST">
  <input type="hidden" name="user" value="<?= $pp[0]; ?>">
  <input type="hidden" name="dir" value="<?= $bb; ?>">
  <button class='w3-button w3-white w3-text-black'><i class="fa-solid fa-floppy-disk"></i></button> |&nbsp; <a href="/u/FoxWorn3365/files/"><i class="fa fa-level-up" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Modificando il File: <b><?= $bb; ?></b>
  <br>
  <hr>
  <br>
  
