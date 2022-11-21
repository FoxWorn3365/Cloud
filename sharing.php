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

function randomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

session_start();
$user = $_SESSION["user"];

if (empty($user)) {
  die("ERROR 02: Permission denied");
}

$url = $_SERVER["HTTP_REFERER"];
$server = $_SERVER["SERVER_NAME"];
$password = $_POST["typePasswordOfShared1"];

$file = str_replace("https://$server/u/$user/share/", "", $url);

$s = randomString(20);
$string = "$user{}file{}$file";

if (!empty($password)) {
  // Ok, niente password
  file_put_contents("protected/shared/$s", $string . '{}' . $password);
  $password = "<span style='color: green'>SI</span>";
} else {
  file_put_contents("protected/shared/$s", $string);
  $password = "<span style='color: red'>NO</span>";
}
require("protected/components/header.php");
?>
<br>
 <h1>File condiviso - Fox Cloud</h1>
 <br><br>
 <h3 style="color: green">File condiviso con successo!</h3>
 <br><br><br>
 <b>Codice dello shared:</b> <?= $s; ?><br>
 <b>Link dello shared:</b> <a onclick='copyurl()'>https://cloud.fcosma.it/s/<?= $s; ?></a><br>
 <b>Password:</b> <?= $password; ?>
 <br><br><br>
 <a href="/u/<?= $user; ?>/files/"><button class="foxcloud-button">Torna ai tuoi File</button></a>
 <br><br><br>
 <script>
 function copyurl() {
   navigator.clipboard.writeText('https://cloud.fcosma.it/s/<?= $s; ?>');
 }
 </script>
