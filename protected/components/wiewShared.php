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
 <h1>I tuoi file Condivisi</h1>
 <br><br><br>
 <div style="text-align: left; position: absolute; left: 50px; width: 100%;">
<?php
 foreach(glob("protected/shared/*") as $filename) {
    $sc = explode("{}", file_get_contents($filename));
    $file = str_replace("protected/shared/", "", $filename);
    if ($sc[0] == $pp[0]) {
?>
   <div class='foxcloud-filelist-file w3-display-container'>
    <i class="fa-solid fa-file"></i> <a href='/s/<?= $file ?>'><?= $file ?></a>
    <span style='font-size: 13px;' class='w3-display-middle'><?= $sc[2]; ?></span>
    <a title='Revoca la condivisione' href='/u/<?= USER; ?>/removeShared/$file' class='foxcloud-filelist-fileSettings w3-right'><i class="fa-solid fa-trash-can"></i></a>
   </div>
<?php
      // RICORDI    echo "<a href='/s/$file'>$file</a> <span style='font-size: 10px'>FILE: (" . str_replace("%20", " ", $sc[2]) . ")</span><a href='/u/$pp[0]/removeShared/$file' style='position: absolute; text-align: right; right: -50%'><i class='fa fa-trash' aria-hidden='true'></i></i></a><br>";
    }
 }
?>
 <br><br><br><br><br><br><br><br>
 </div>
