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

function rrmdir($dir) { 
  if (is_dir($dir)) { 
    $objects = scandir($dir);
    foreach ($objects as $object) { 
      if ($object != "." && $object != "..") { 
        if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
          rrmdir($dir. DIRECTORY_SEPARATOR .$object);
        else
          unlink($dir. DIRECTORY_SEPARATOR .$object); 
      } 
    }
    rmdir($dir); 
  } 
}

session_start();
$do = filter_var($_GET["action"], FILTER_SANITIZE_STRING);

if ($do != "auth") {
  require_once("protected/components/adminSecurity.php");
}

if ($do == "auth") {
  // Autentichiamo l'utente
  $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
  // Carichiamo la configurazione
  $config = json_decode(file_get_contents('protected/config/config.json'));

  if ($username == $config->admin_username && $password === $config->admin_password) {
    // Autenticato con successo!
    $_SESSION["admin"] = $username;
    header("Location: /admin/mep");
  } else {
    header("Location: /admin/");
  }
} elseif ($do == "createUser") {  
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
      $json = json_encode(array('name' => $name, 'surname' => $surname, 'email' => $email, 'diskSpace' => $diskSpace, 'firstLogin' => $join, 'isVisible' => $visible, 'dir' => $dir));
      file_put_contents('protected/sys/.' . $user . '_preferences.sys', '{"foxPlayer":"true","foxPlayerBlob":"false","searchBar":"true"}');
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
} elseif ($do == "delete") {
  $user = filter_var($_GET["user"], FILTER_SANITIZE_STRING);
  $config = json_decode(file_get_contents('protected/users/' . $user . '/userinfo.conf'));
  if (!empty($config->dir) && 'protected/disk/' . $config->dir . '/' !== 'protected/disk//' && 'protected/users/' . $user . '/' !== 'protected/users//') {
    rrmdir('protected/disk/' . $config->dir . '/');
    rrmdir('protected/users/' . $user . '/');
    die(json_encode(array('status' => 200, 'message' => 'Utente eliminato con successo!', 'user' => $user)));
  } else {
    die(json_encode(array('status' => 400, 'message' => 'Utente non eliminato!', 'user' => $user)));
  }
} elseif ($do == "editUser") {
  $user = filter_var($_GET["user"], FILTER_SANITIZE_STRING);
  if (!is_dir('protected/users/' . $user . '/')) {
    die("ERRORE! L'utente non esiste!");
  }

  $config = json_decode(file_get_contents('protected/users/' . $user . '/userinfo.conf'));
  $name = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
  $surname = filter_var($_POST["cognome"], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
  $disk = filter_var($_POST["disk"], FILTER_SANITIZE_NUMBER_INT);
  $dir = filter_var($_POST["dir"], FILTER_SANITIZE_STRING);
  $json = '
{
  "name":"' . $name . '",
  "surname":"' . $surname . '",
  "email":"' . $email . '",
  "diskSpace":' . $disk . ',
  "firstLogin":"' . $config->firstLogin . '",
  "isVisible":' . $config->isVisible . ',
  "dir":"' . $dir . '"
}';

  file_put_contents('protected/users/' . $user . '/userinfo.conf', $json);
  header("refresh:5;url=/admin/mep");
  echo "UTENTE AGGIORNATO CON SUCCESSO!<br>Reindirizzamento in 5 secondi...";
} elseif ($do == "manage") {
  $user = filter_var($_GET["user"], FILTER_SANITIZE_STRING);

  if (!file_exists('protected/users/' . $user . '/')) {
    die(json_encode(array('status' => 400, 'message' => 'L`utente non esiste')));
  }

  if (!file_exists('protected/users/' . $user . '/stop')) {
    // SI BANNA L'UTENTE!
    file_put_contents('protected/users/' . $user . '/stop', strtotime("now"));
    die(json_encode(array('status' => 200, 'message' => 'Utente bannato con successo!', 'action' => 'ban')));
  } else {
    unlink('protected/users/' . $user . '/stop');
    die(json_encode(array('status' => 200, 'message' => 'Utente unbannato con successo!', 'action' => 'unban')));
  }
}
