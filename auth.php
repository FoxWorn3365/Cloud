<?php
session_start();

// Recupero l'utente e la password
$u = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$p = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
$r = filter_var($_POST["redi"], FILTER_SANITIZE_STRING);

// L'utente esiste?
if (!is_dir("protected/users/$u")) {
  header("Location: /login?error=username");
  die();
}

if (!file_exists("protected/users/$u/userpass.conf")) {
   $_SESSION["user"] = $u;
   header("Location: /newpassword");
   die();
}

// Ok, ora provvedo a recuperare la password

if (hash("sha512", $p) == file_get_contents("protected/users/$u/userpass.conf")) {
   // Verifichiamo che l'utente non sia bloccato
   if (file_exists('protected/users/' . $u . '/stop')) {
     header("Location: /admin/banned");
     die();
   }

   // Ok, lo loggo con successo!
   $_SESSION["user"] = $u;
   if ($r != "true") {
     header("Location: /u/$u/dashboard");
   } else {
     header("Location: " . $_SERVER["HTTP_REFERER"]);
   }
   file_put_contents("protected/users/$u/lastaccess.conf", strtotime("now"));
   exit;
} else {
   header("Location: /login?error=password");
   exit;
}
