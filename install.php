<?php
if (file_exists('protected/config/config.json')) {
  die("FoxCloud già installato!");
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>FoxCloud Installation</title>
 </head>
 <body style='text-align: center'>
  <br><br>
  <img src='https://resources.fcosma.it/foxcloud/logo-full.png'><br>
  <form method='POST'>
   <input type='hidden' name='send' value='true'>
   <h1>Installazione di FoxCloud</h1>
   Benvenuto nel processo di installazione di FoxCloud, dove configureremo insieme i valori principali del Cloud!<br><br><br>
   <h2>Configurazioni generali</h2>
   <h3>Admin</h3>
   Inserisci di seguito le credenziali per l'utente admin:<br>
   Username: <input type='text' name='admin_username'><br>
   Password: <input type='password' name='admin_password'><br>
   <br><br>
   <h3>Altro</h3>
   Abilitare <a href='https://github.com/FoxWorn3365/Cloud/blob/v1.9/README.md#foxcloud-world'>FoxCloudWorld</a>?<br>
   <input type='checkbox' name='foxcloudworld'>
   <br><br><br>
   Abilitare la funzione <a href='https://github.com/FoxWorn3365/Cloud/blob/v1.9/README.md#sistema-per-la-riduzione-degli-shared'>FewShared</a> per ridurre il numero di shared?<br>
   <input type='checkbox' name='fewshared'>
   <br><br>
   <button>Salva ed attiva FoxCloud</button><br><br>
   <i>Per creare il tuo utente accedi a <a href='/admin/'>questo link</a> con le credenziali dell'admin</i>
   <br><br>
  </form>
  <br><br><br>
 </body>
</html>
<?php
if ($_POST["send"] == "true") {
  // Elaboriamo le risposte
  $username = $_POST["admin_username"];
  $password = $_POST["admin_password"];
  $foxcloudworld = $_POST["foxcloudworld"];
  $few = $_POST["fewshared"];
  if (!(!empty($username) && !empty($password))) {
    die("Alcuni valori sono vuoti!");
  }
  // Procediamo
  $json = array();
  $json['admin_username'] = $username;
  $json['admin_password'] = $password;
  $json['resourcesMirror'] = 'auto';
  if (empty($foxcloudworld)) {
    $json['foxcloudworld'] = false;
  } else {
    $json['foxcloudworld'] = true;
  }

  if (empty($few)) {
    $json['fewshared'] = false;
  } else {
    $json['fewshared'] = true;
  }
  file_put_contents('protected/config/config.json', json_encode($json));
  die("Installato con successo!<br>Puoi tornare <a href='/'>alla home</a>");
}
?>
