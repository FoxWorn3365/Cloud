<?php
session_start();
$do = filter_var($_GET["action"], FILTER_SANITIZE_STRING);

if ($do == "auth") {
  // Autentichiamo l'utente
  $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
  require("config.php");

  if ($username == $admin_username && $password === $admin_password) {
    // Autenticato con successo!
    $_SESSION["admin"] = $username;
    header("Location: /admin/mep");
  } else {
    header("Location: /admin/");
  }
} elseif ($do == "createUser") {
  require("protected/components/adminSecurity.php");
  
  $user = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
  $name = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
  $surname = filter_var($_POST["cognome"], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
  $disk = filter_var($_POST["disk"], FILTER_SANITIZE_NUMBER_INT);
  $join = strtotime("now");
  $visible = filter_var($_POST["visible"], FILTER_SANITIZE_STRING);
  $dir = filter_var($_POST["dir"], FILTER_SANITIZE_STRING);

  if (!is_dir('protected/users/' . $user . '/')) {
    if (mkdir('protected/users/' . $user . '/', 0770) && mkdir('protected/disk/' . $dir . '/', 0770)) {
      $json = '
{
  "name":"' . $name . '",
  "surname":"' . $surname . '",
  "email":"' . $email . '",
  "diskSpace":' . $disk . ',
  "firstLogin":"' . $join . '",
  "isVisible":' . $visible . ',
  "dir":"' . $dir . '"
}';
      file_put_contents('protected/users/' . $user . '/userinfo.conf', $json);
      header("refresh:5;url=/admin/mep");
      echo "UTENTE CREATO CON SUCCESSO!<br>Reindirizzamento in 5 secondi...";
    } else {
      header("refresh:5;url=/admin/mep");
      echo "UTENTE NON CREATO - ERRORE: <code>errore nella creazione della dir -> controlla i permessi!</code><br>Reindirizzamento in 5 secondi...";
    }
  } else {
    header("refresh:5;url=/admin/mep");
    echo "UTENTE NON CREATO - ERRORE: <code>l'utente esiste già</code><br>Reindirizzamento in 5 secondi...";
  }
}
