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

// Valori banditi
$special_chars = array("?", "[", "]", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}", "%", "+", chr(0));

session_start();

// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
  die("Nessun file inviato...");   
}

$u = $_SESSION["user"];
$dir = $_POST["dir"];

if (empty($u)) {
  die("Permessi insufficenti: ERRORE 02 -> TU:$u | tu2 = " .$_SESSION['user']);
}

$user = json_decode(file_get_contents("protected/users/$u/userinfo.conf"));

require_once("protected/components/pesoUser.php");

//percorso della cartella dove mettere i file caricati dagli utenti
$uploaddir = 'protected/disk/' . $user->dir . '/' . $dir;

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['userfile']['tmp_name'];

$ext_ok = array('php', 'html', 'css', 'htm', 'cpp');
$temp = explode('.', $_FILES['userfile']['name']);
$ext = end($temp);
if (in_array($ext, $ext_ok)) {
  die("Estensione del file non valida! ($ext)");
}

$target_file = $uploaddir . $_FILES['userfile']['name'];
if (file_exists($target_file)) {
  die("Il file esiste già!");
}

// limito la dimensione massima a quanto ha libero l'utente
if ($_FILES['userfile']['size'] > $freebytes) {
  die("FILE TROPPO GRANDE! Peso: " .$_FILES["userfile"]["size"] . " / Massimo: $freebytes");
}

//recupero il nome originale del file caricato
$userfile_name = str_replace(" ", "_", str_replace($special_chars, '-', $_FILES['userfile']['name']));

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, str_replace("%2F", "/", $uploaddir . $userfile_name))) {
  //Se l'operazione è andata a buon fine...
  $text = file_get_contents("protected/pages/upload_success.pagetext");
  $texta = str_replace("%user%", $u, str_replace("%dir%", $dir, str_replace("%filename%", $userfile_name, $text)));
  shell_exec("sudo chmod 0777 /var/www/cloud/$uploaddir . $userfile_name");
  echo $texta;
}else{
  //Se l'operazione è fallta...
  echo 'Upload fallito!'; 
}
