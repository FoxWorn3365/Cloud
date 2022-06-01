<?php
require_once("protected/components/pesoUser.php");

$bb = str_replace("%20", " ", $bb);

// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
  die("Nessun file inviato...");   
}

//percorso della cartella dove mettere i file caricati dagli utenti
$uploaddir = 'protected/disk/' . $user->dir . '/' . $bb;

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
  echo 'Il file è troppo grande!';
  exit;
}

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
  //Se l'operazione è andata a buon fine...
  echo 'File inviato con successo.';
}else{
  //Se l'operazione è fallta...
  echo 'Upload NON valido!'; 
}
?>