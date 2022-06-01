  <h1>Utente: <?= $pp[0] ?></h1>
  <br><br>
  <b>Nome:</b> <?= $user->name; ?><br>
  <b>Membro dal:</b> <?= date("d/m/Y", $user->firstLogin); ?><br>
  <b>Ultimo accesso:</b> <?= date("d/m/Y - H:i", file_get_contents('protected/users/' .$pp[0]. '/lastaccess.conf')); ?>
  