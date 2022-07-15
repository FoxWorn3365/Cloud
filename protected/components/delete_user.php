<?php
require_once("protected/components/header.php");
?>
  <h1>Eliminazione di un Utente</h1>
  <br><br>
  <b>Sei veramente sicuro di voler eliminare l'utente <?= $us; ?>?</b>
  Ricordiamo che eliminando l'utente si andranno anche ad eliminare tutti i suoi file in modo IRREVERSIBILE!
  <br><br>
  <button class='w3-button w3-text-white w3-red' onclick='deleteUser()'>Procedi</button>&nbsp;&nbsp;&nbsp;<button class='w3-button w3-text-white w3-green' onclick='returnBack()'>Annulla</button><br><br>
  <br><br><br><br>
  <div id='result' class='w3-gray w3-text-white w3-display-middle' style='display: none'>
    <h2 id='tit'>Codice di stato: <span id='statCode'></span></h2>
    <span id='message'></span><br><br>
    <button onclick='returnBack()' class='w3-button w3-orange w3-text-white'>Torna alla Dashboard</button><br><br>
  </div>
  <script src='/http.js'></script>
  <script>
  function deleteUser() {
    var user = "<?= $us; ?>";
    var res = JSON.parse(http_request('/admin.php?action=delete&user=' + user));
    if (res.status == 200) {
      document.getElementById('result').style.display = "block";
      document.getElementById('statCode').innerHTML = res.status;
      document.getElementById('message').innerHTML = res.message;
      document.getElementById('tit').classList.add('w3-green');
    } else {
      document.getElementById('result').style.display = "block";
      document.getElementById('statCode').innerHTML = res.status;
      document.getElementById('message').innerHTML = res.message;
      document.getElementById('tit').classList.add('w3-red');
    }
  }

  function returnBack() {
    window.location.href = '/admin/mep';
  }
  </script>
