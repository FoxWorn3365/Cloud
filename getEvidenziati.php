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

session_start();
$user = $_SESSION["user"];

if (file_exists('protected/sys/' . $user. 'fileEvidenziati.array')) {
  die(json_encode(array('status' => 200, 'presence' => true, 'evidenziati' => explode('//!!\\(())(())(())((((()()()()()(()()984984578475987357/////(/&&\\', file_get_contents('protected/sys/' . $user . 'fileEvidenziati.array')))));
} else {
  die(json_encode(array('status' => 400, 'presence' => false)));
}
