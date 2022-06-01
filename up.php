<?php
session_start();

$bb = str_replace("%20", " ", $bb);

// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
  die("Nessun file inviato...");   
}

$u = $_POST["user"];
$dir = $_POST["dir"];

if ($_SESSION["user"] !== $u) {
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
$userfile_name = $_FILES['userfile']['name'];

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
  //Se l'operazione è andata a buon fine...
  $text = file_get_contents("protected/pages/upload_success.pagetext");
  $texta = str_replace("%user%", $u, str_replace("%dir%", $dir, str_replace("%filename%", $userfile_name, $text)));
  shell_exec("sudo chmod 0777 /var/www/cloud/$uploaddir . $userfile_name");
  require_once("protected/components/header.php");
  echo $texta;
}else{
  //Se l'operazione è fallta...
  echo 'Upload NON valido!'; 
}
?>