<?php
// +-----------------------------------+
// |             FoxCloud              |
// +-----------------------------------+
// | Questo file fa parte del progetto |
// | di Cloud Open Source "FoxCloud",  |
// | realizzato da FoxWorn.            |
// +-----------------------------------+
// | Web: https://foxcloud.fcosma.it   |
// | GH: github.com/FoxWorn3365/Cloud  |
// | License: GNU GPL 3.0              |
// +-----------------------------------+
// | You can write me an email at:     |
// | foxworn3365@gmail.com, also for   |
// | talk!                             |
// +-----------------------------------+
?>
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
