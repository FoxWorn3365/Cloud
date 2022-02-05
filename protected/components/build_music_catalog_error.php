<br>
 <h1>Fcosma Cloud - Music</h1>
 <hr>
 <u><h2>La canzone che stavi cercando non esiste!</h2></u>
 <h3>Ecco il catalogo completo</h3>
 <div style="text-align: left">
  <?php
   foreach(glob("protected/music/*") as $file) {
     $filename = str_replace("protected/music/", "", $file);
     echo "<img src='/audioicon.php' height='64' width='64'><a href='https://cloud.fcosma.it/m/$filename' style='text-decoration: none; font-size: 25px'>$filename</a><br>";
   }
  ?>
 </div>