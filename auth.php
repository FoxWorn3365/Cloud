<?php
session_start();

// Recupero l'utente e la password
$u = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$p = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

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
// die("Password inserita: " . password_hash($p, PASSWORD_BCRYPT, $opt) . "<br>Password recuperata: " . file_get_contents("protected/users/$u/userpass.conf"));
if (hash("sha512", $p) == file_get_contents("protected/users/$u/userpass.conf")) {
   // Ok, lo loggo con successo!
   $_SESSION["user"] = $u;
   header("Location: /u/$u");
   exit;
} else {
   header("Location: /login?error=password");
   exit;
}