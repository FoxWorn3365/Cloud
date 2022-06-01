<br>
 <h1>I tuoi file Condivisi - Fox Cloud</h1>
 <br><br><br>
 <div style="text-align: left; position: absolute; left: 50px; width: 50%;">
<?php
 foreach(glob("protected/shared/*") as $filename) {
    $sc = explode("{}", file_get_contents($filename));
    $file = str_replace("protected/shared/", "", $filename);
    if ($sc[0] == $pp[0]) {
      echo "<a href='/s/$file'>$file</a> <span style='font-size: 10px'>FILE: (" . str_replace("%20", " ", $sc[2]) . ")</span><a href='/u/$pp[0]/removeShared/$file' style='position: absolute; text-align: right; right: -50%'><i class='fa fa-trash' aria-hidden='true'></i></i></a><br>";
    }
 }
?>
 <br><br><br><br><br><br><br><br>
 </div>