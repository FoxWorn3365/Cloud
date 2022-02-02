<?php
session_start();
// (C) 2022 - FoxWorn3365

// Get URL
$url = $_SERVER["REQUEST_URI"];

// Verifico che l'utente sia loggato e in caso che un file sia condiviso
if (stripos($url, "/oldshared/") !== false) {
  require_once("protected/components/header.php");
  // File condiviso, recupero subito l'ID
  $pid = str_replace("/s/", "", $url);
  $dir = str_replace("/s/$pid/", "", $url);
  // Verifichiamo che lo shared esista
  if (!file_exists("protected/shared/$pid")) {
   require_once("protected/error/notshared.html");
  } else {
   // Buildo la dir con il builderdir
   require_once("protected/components/builder_dir.php");
  }
} elseif (stripos($url, "/u/") !== false) {
  // Pagina utente
  $u = str_replace("/u/", "", $url);
  $pp = explode("/", $u);
  if (!is_dir('protected/users/' .$pp[0])) {
    require_once("protected/error/usernotexists.html");
    exit;
  }
  // Recupero la pagina basica dell'utente
  $user = json_decode(file_get_contents("protected/users/" . $pp[0]. "/userinfo.conf"));
  if ($url == '/u/' .$pp[0]) {
    require_once("protected/components/header.php");
    require_once("protected/components/build_user.php");
  } elseif ($url == '/u/' . $pp[0] . '/dashboard') {
    require_once("protected/components/header.php");
    require_once("protected/components/security.php");
    require_once("protected/components/build_dashboard.php");
  } elseif ($url == '/u/' . $pp[0] . '/file') {
    require_once("protected/components/header.php");
    require_once("protected/components/security.php");
    require_once("protected/components/build_files.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/files/') !== false) {
    require_once("protected/components/header.php");
    require_once("protected/components/security.php");
    // Conto la directory
    $ap = count($pp);
    for($te = 2; $te < $ap-1; $te++) {
      $dd = $pp[$te] . '/';
    }
    $dd = $dd . '*';
    $dd = str_replace("%20", " ", $dd);
    $bb = str_replace('/u/' . $pp[0] . '/files/', '', $url);
    require_once("protected/components/header.php");
    require_once("protected/components/build_files.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/fileopen/') !== false) {
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/fileopen/', '', $url);
    require_once("protected/components/header.php");
    require_once("protected/components/wiewfile.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/editfile/') !== false) {
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/editfile/', '', $url);
    require_once("protected/components/header.php");
    require_once("protected/components/build_visualEditor.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/save/') !== false) {
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/save/', '', $url);
    require_once("protected/components/header.php");
    require_once("protected/components/saveFile.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/download/') !== false) {
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/download/', '', $url);
    require_once("protected/components/downloadFile.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/getcontentfile/') !== false) {
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/getcontentfile/', '', $url);
    require_once("protected/components/build_content_file.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/deleteFile/') !== false) {
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/deleteFile/', '', $url);
    unlink("protected/disk/$user->dir/$bb");
    $bb = '';
    require_once("protected/components/header.php");
    require_once("protected/components/build_files.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/uploadFile/') !== false) {
    require_once("protected/components/header.php");
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/uploadFile/', '', $url);
    require_once("protected/components/uploadfile_header.php");
    require_once("protected/components/uploadAFile.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/up/') !== false) {
    session_start();
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/up/', '', $url);
    require_once("protected/components/up.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/createDir/') !== false) {
    require_once("protected/components/header.php");
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/createDir/', '', $url);
    require_once("protected/components/newdirform.php");
  } elseif (stripos($url, '/u/' . $pp[0] . '/deleteDirectory/') !== false) {
    require_once("protected/components/security.php");
    // Recupero il file
    $bb = str_replace('/u/' . $pp[0] . '/deleteDirectory/', '', $url);
    require_once("protected/components/functions.php");
    if (!empty($bb)) {
     rmdir_recursive('protected/disk/' .$user->dir . '/' . $bb);
     require_once("protected/components/header.php");
     $bb = '';
     require_once("protected/components/build_files.php");
    } else {
     die("ERROR 02: Permession denied");
    }
  } else {
    require_once("protected/components/header.php");
    require_once("protected/error/notfound.html");
  }
} elseif (stripos($url, "/s/") !== false) {
  // GWAAA SHARED!
  $sh = str_replace("/s/", "", $url);
  $link = explode("/", $sh);
  $link = $link[0];
  if (!file_exists("protected/shared/$link")) {
    require_once("protected/error/notshared.html");
    die();
  }
  // Ok, ora il file è condiviso!
  // Recuperiamo subito le informazioni base su come fare
  $shared = explode("{}", file_get_contents("protected/shared/$link"));

  // Che tipo di shard è?
  $author = $shared[0];
  $type = $shared[1];
  // shared[2] -> file / directory
  // shared[3] -> eventuale password
  $user = json_decode(file_get_contents("protected/users/$author/userinfo.conf"));

  if ($type == "file") {
    // Ok, è un file singolo quindi lo mostro con il file wiewer
    // Ricordiamo di inserire i parametri base quindi l'autore con $u e $bb quindi la dir
    // Intanto ho già recuperato la configurazione dell'autore
    $pp[0] = $author;
    $bb = $shared[2];
    require_once("protected/components/header.php");
    require_once("protected/components/wiewfile_shared.php");
  } elseif ($type == "dir") {
    // Ok, qua la situazione si complica poichè dobbiamo condividere la directory e TUTTI I FILE LEGATI AD ESSA
    // Impostiamo i valori principali
    $dd = $shared[2] . '*';
    $u = $author;
    require_once("protected/components/header.php");
    require_once("protected/components/buildshared_file.php");
  }
} else {
  require_once("protected/components/header.php");
  die("Richiesta non valida!");
}
  