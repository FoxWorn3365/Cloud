<?php
require_once("protected/components/header.php");

// Peso di una dir
function GetDirectorySize($path){
    $bytestotal = 0;
    $path = realpath($path);
    if($path!==false && $path!='' && file_exists($path)){
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
            $bytestotal += $object->getSize();
        }
    }
    return $bytestotal;
}
?>
  <h1>Benvenuto nel pannello Admin</h1>
  Da qua potai gestire tutti gli utenti del Cloud!<br>
  <br><br>
  <a href='/admin/new'><button class='foxcloud-button'><i class="fa-solid fa-circle-plus"></i></button></a><br>
  <table class="w3-table">
    <tr>
      <th>Username</th>
      <th>Spazio Totale</th>
      <th>Spazio Usato</th>
      <th>Directory</th>
      <th></th>
      <th></th>
    </tr>
<?php
foreach (glob("protected/users/*") as $user) {
  $conf = json_decode(file_get_contents($user . '/userinfo.conf'));

  if (file_exists($user . '/stop')) {
    $bt = '<i id="' . str_replace("protected/users/", "", $user) . '" class="fa-solid fa-circle-play"></i>';
  } else {
    $bt = '<i id="' . str_replace("protected/users/", "", $user) . '" class="fa-solid fa-hammer"></i>';
  }

  if (!empty($conf->dir)) {
    $size = GetDirectorySize('protected/disk/' . $conf->dir . '/');
    $mb = round($size / 1000000, 2);
    $gb = round($mb / 1000, 2);

?>
    <tr>
      <td><?= str_replace("protected/users/", "", $user); ?></td>
      <td><?= $conf->diskSpace; ?>GB</td>
      <td><?= $gb; ?>GB</td>
      <td><i><code><?= $conf->dir; ?></code><i></td>
      <td><a href='/admin/edit/user/<?= str_replace("protected/users/", "", $user); ?>/'><i class="fa-solid fa-pen-to-square"></i></a></td>
      <td><a href='/admin/delete/user/<?= str_replace("protected/users/", "", $user); ?>/'><i class="fa-solid fa-trash"></i></a></td>
      <td><a onclick='manageUser("<?= str_replace("protected/users/", "", $user); ?>")'><?= $bt; ?></a></td>
    </tr>
<?php
  } else {
?>
    <tr class='w3-red'>
      <td><a onclick='showError()'>&#9888;&#65039;</a>&nbsp;<?= str_replace("protected/users/", "", $user); ?></td>
      <td>//GB</td>
      <td>//GB</td>
      <td><i><code>//</code><i></td>
      <td><a href='/admin/edit/user/<?= str_replace("protected/users/", "", $user); ?>/'><i class="fa-solid fa-pen-to-square"></i></a></td>
      <td><a href='/admin/delete/user/<?= str_replace("protected/users/", "", $user); ?>/'><i class="fa-solid fa-trash"></i></a></td>
      <td><a onclick='manageUser("<?= str_replace("protected/users/", "", $user); ?>")'><?= $bt; ?></a></td>
    </tr>
<?php
  }
}
?>
  </table>
  <div id='errors' class='w3-display-middle w3-gray w3-text-white' style='display: none'>
   <p style='margin: 5px'>
    <h2>L'utente non è caricato correttamente!</h2>
    Questo perché probabilmente i permessi non sono impostati correttamente (<a href='https://foxcloud.fcosma.it/docs/v1.0#preparazione-permessi'>reference</a>)<br>oppure il JSON di configurazione dell'utente non risulta valido.<br><br>
    <button onclick='close()' class='w3-button w3-white w3-text-black'>HO CAPITO</button><br><br>
   </p>
  </div>
  <div id='success' style='display: none; position: absolute; top: 50px; left: 40%; border: solid 4px gray; background-color: gray; color: white'>
   <p style='padding: 5px'>
    <h2 id='stat'></h2>
    <span id='mg'></span>
   </p>
  </div>
  <br><br><br><br>
 </body>
 <script src='/http.js'></script>
 <script>
 function showError() {
   document.getElementById('errors').style.display = "block";
 }

 function close() {
   document.getElementById('errors').style.display = "none";
 }

 function manageUser(user) {
   var res = JSON.parse(http_request('/admin?action=manage&user=' + user));
   document.getElementById('success').style.display = "block";
   if (res.status == 200) {
     if (res.action == "ban") {
       var cl = "fa-solid fa-circle-play";
     } else {
       var cl = "fa-solid fa-hammer";
     }
     document.getElementById(user).classList = cl;
     document.getElementById('stat').style.color = "green";
     document.getElementById('stat').innerHTML = "Successo!";
     document.getElementById('mg').innerHTML = res.message;
   } else {
     document.getElementById('stat').style.color = "red";
     document.getElementById('stat').innerHTML = "Errore!";
     document.getElementById('mg').innerHTML = res.message;
   }
 }
 </script>

