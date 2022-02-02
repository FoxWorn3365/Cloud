  <h1>Benvenuto, <?= $pp[0]; ?></h1>
  <br><br>
  <h3>Informazioni sull'utente</h3>
  <b>Nome:</b> <?= $user->name; ?> | <b>Cognome:</b> <?= $user->surname; ?> | <b>Email:</b> <?= $user->email; ?><br><br>
  <br>
  <h3>Opzioni</h3>
  <a href="file"><button class="w3-button w3-orange w3-text-white">Vai ai tuoi File</button></a>
  <br>
  <h3>Gestione dello Spazio</h3>
  <b>Il tuo spazio totale:</b> <?= $user->diskSpace; ?>GB
  <br>
<?php
require_once("protected/components/pesoUser.php");
?>

  <b>Spazio usato:</b> <?= $gb; ?>GB (<?= $mb; ?>MB)<br>
  <b>Spazio libero:</b> <?= $free ?>GB (<?= $freeMB ?>MB )

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Libero',     <?= $free; ?>],
          ['Usato',      <?= $used; ?>]
        ]);

        var options = {
          title: 'Il tuo Spazio (GB)'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <center><div id="piechart" style="width: 900px; height: 500px; background-color: #f8f8f8"></div></center>