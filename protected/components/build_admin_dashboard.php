<?php require_once("protected/components/header.php"); require_once("protected/components/peso.php"); ?>
  <h1>Benvenuto nel pannello Admin</h1>
  Da qua potai gestire tutti gli utenti del Cloud!<br>
  <br><br>
  <a href='/admin/new'><button class='w3-button w3-text-white w3-green'><i class="fa-solid fa-circle-plus"></i></button></a><br>
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
  $size = dirsize('protected/disk/' . $conf->dir . '/');
  $mb = round($size / 1000000, 2);
  $gb = round($mb / 1000, 2);

  if (file_exists($user . '/banned')) {
    $bt = '<i class="fa-solid fa-circle-play"></i>';
  } else {
    $bt = '<i class="fa-solid fa-hammer"></i>';
  }

  if (!empty($conf->dir)) {
?>
    <tr>
      <td><?= str_replace("protected/users/", "", $user); ?></td>
      <td><?= $conf->diskSpace; ?>GB</td>
      <td><?= $gb; ?>GB</td>
      <td><i><code><?= $conf->dir; ?></code><i></td>
      <td><a href='/admin/edit/user/<?= str_replace("protected/users/", "", $user); ?>/'><i class="fa-solid fa-pen-to-square"></i></a></td>
      <td><a href='/admin/delete/user/<?= str_replace("protected/users/", "", $user); ?>/'><i class="fa-solid fa-trash"></i></a></td>
      <td><a href='/admin/manager/user/<?= str_replace("protected/users/", "", $user); ?>/'><?= $bt; ?></a></td>
    </tr>
<?php
  }
}
?>
  </table>
  <br><br><br><br>
