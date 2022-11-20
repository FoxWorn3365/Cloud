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

// Recupero l'utente e la password
if (empty(filter_var($_GET["APP"], FILTER_SANITIZE_STRING))) {
  $u = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
  $p = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
  $r = filter_var($_POST["redi"], FILTER_SANITIZE_STRING);
} else {
  $u = filter_var($_GET["username"], FILTER_SANITIZE_STRING);
  $p = filter_var($_GET["password"], FILTER_SANITIZE_STRING);
}

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
   if (!empty(filter_var($_GET["pt"], FILTER_SANITIZE_STRING))) {
     die("ST200");
   }

   if ($r != "true") {
     header("Location: /u/$u/dashboard");
   } else {
     header("Location: " . $_SERVER["HTTP_REFERER"]);
   }
   file_put_contents("protected/users/$u/lastaccess.conf", strtotime("now"));
   exit;
} else {
   if (!empty(filter_var($_GET["pt"], FILTER_SANITIZE_STRING))) {
     die("ST400");
   }

   header("Location: /login?error=password");
   exit;
}
