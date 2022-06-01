<?php
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
$password = $_POST["typePasswordOfShared1"];

$file = str_replace("https://cloud.fcosma.it/u/$user/share/", "", $url);

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
 <a href="/u/<?= $user; ?>/sharedList/"><button class="w3-button w3-orange w3-text-white">Vai agli Shared</button></a>
 <a href="/u/<?= $user; ?>/file"><button class="w3-button w3-orange w3-text-white">Vai ai tuoi File</button></a>
 <br><br><br>
 <script>
 function copyurl() {
   navigator.clipboard.writeText('https://cloud.fcosma.it/s/<?= $s; ?>');
 }
 </script>