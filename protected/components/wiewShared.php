<br>
 <h1>I tuoi file Condivisi - Fox Cloud</h1>
 <br><br><br>
 <div style="text-align: left; position: absolute; left: 30%">
<?php
 foreach(glob("protected/shared/*") as $filename) {
    $sc = explode("{}", file_get_contents($filename));
    $file = str_replace("protected/shared/", "", $filename);
    if ($sc[0] == $pp[0]) {
      echo "$file <a href='/s/$file' style='position: absolute; text-align: right; right: -40%'><i class='fa fa-arrow-circle-o-right' aria-hidden='true'></i></a><a href='/u/$pp[0]/removeShared/$file' style='position: absolute; text-align: right; right: -50%'><i class='fa fa-trash' aria-hidden='true'></i></i></a><br>";
    }
 }
?>
 </div>