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
 <style>
 a {
  text-decoration: none;
 }
 </style>
 <?php
 if (empty($bb)) {
  $replace = 'protected/disk/' . $user->dir. '/';
  $h = str_replace("*", "", $bb);
 } else {
  $replace = str_replace('*', '', 'protected/disk/' . $user->dir. '/' . $bb);
  $h = str_replace("*", "", $bb);
 }

 $bb = str_replace("%20", " ", $bb) . '*';

 require_once("protected/components/files_header.php");
 $count = 0;
 foreach(glob("protected/disk/$user->dir/$bb") as $file) {
   if (is_dir($file)) {
     $f = str_replace(str_replace("%20", " ", $replace), "", $file);
?>
   <div id='<?= $f . $h; ?>' class='foxcloud-filelist-file w3-display-container'>
    <a onclick='evidenziaFile("<?= $f . $h; ?>")'><i class="fa fa-folder" aria-hidden="true"></i></a> <a href='/u/<?= $pp[0]; ?>/files/<?= $h.$f; ?>/'><b><?= $f; ?>/</b></a>
    <a onclick='showSettingsFor(this, "folder");' class='foxcloud-filelist-fileSettings w3-right'><i class="fa fa-bars" aria-hidden="true"></i></a>
   </div>
<?php

     // echo "<a onclick=\"evidenziaFile($count)\"><i class='fa-solid fa-folder'></i></a> <a href='/u/$pp[0]/files/$h$f/'><b>$f/</b></a><a href='/u/$pp[0]/deleteDirectory/$h$f' style='position: absolute; text-align: right; right: -80%'><i class='fa fa-trash' aria-hidden='true'></i></a><a style='position: absolute; text-align: right; right: -90%' href='/u/$pp[0]/rename/$h$f'><i class='fa-solid fa-pen-to-square'></i></a><br>";
   } else {
     $f = str_replace(str_replace("%20", " ", $replace), "", $file);

     $ext = end(explode('.', $f));

     if ($ext == "png" || $ext == "jpg" || $ext == "jpeg"  || $ext == "gif") {
       $icona = '<i class="fa-solid fa-file-image"></i>';
     } elseif ($ext == "txt" || $ext == "md" || $ext == "fox") {
       $icona = '<i class="fa-solid fa-file-lines"></i>';
     } elseif ($ext == "ogg" || $ext == "mp3" || $ext == "m4a" || $ext == "wav") {
       $icona = '<i class="fa-solid fa-file-audio"></i>';
     } elseif ($ext == "zip" || $ext == "gz") {
       $icona = '<i class="fa-solid fa-file-zipper"></i>';
     } elseif ($ext == "html" || $ext == "htm" || $ext == "js" || $ext == "css" || $ext == "php" || $ext == "c") {
       $icona = '<i class="fa-solid fa-file-zipper"></i>';
     } elseif ($ext == "mp4" || $ext == "mkv" || $ext == "webm") {
       $icona = '<i class="fa-solid fa-file-video"></i>';
     } else {
       $icona = '<i class="fa-solid fa-file"></i>';
     }
?>
   <div id='<?= $f . $h; ?>' class='foxcloud-filelist-file w3-display-container'>
    <a onclick='evidenziaFile("<?= $f . $h; ?>")'><?= $icona; ?></a> <a href='/u/<?= $pp[0]; ?>/fileopen/<?= $h.$f; ?>'><?= $f; ?></a>
    <a onclick='showSettingsFor(this, "file");' class='foxcloud-filelist-fileSettings w3-right'><i class="fa fa-bars" aria-hidden="true"></i></a>
   </div>
<?php
     // echo "<a onclick=\"evidenziaFile($count)\">$icona</a> <u><a href='/u/$pp[0]/fileopen/$h$f'>$f</a> <span style='position: absolute; text-align: right; right: -50%'>". filesize($file)/1000 . "</span><a href='/download?url=$h$f' style='position: absolute; text-align: right; right: -75%'><i class='fa fa-cloud-download' aria-hidden='true'></i></a> <a style='position: absolute; text-align: right; right: -80%' href='/u/$pp[0]/deleteFile/$h$f'><i class='fa fa-trash' aria-hidden='true'></i></a><a style='position: absolute; text-align: right; right: -85%' href='/u/$pp[0]/share/$h$f'><i class='fa-solid fa-share-from-square'></i></i></a><a style='position: absolute; text-align: right; right: -90%' href='/u/$pp[0]/rename/$h$f'><i class='fa-solid fa-pen-to-square'></i></a></u><br>";
   }
   $count++;
 }
 ?>
 <br><br>
 <div id='hudden_fileMenu' class='foxcloud-popup'> 
  <a class='foxcloud-popupbutton'><i class='fa fa-cloud-download' aria-hidden='true'></i> Scarica</a><br>
  <a class='foxcloud-popupbutton'><i class='fa-solid fa-share-from-square'></i> Condividi</a><br>
  <a class='foxcloud-popupbutton'><i class='fa-solid fa-pen-to-square'></i> Rinomina</a><br>
  <a class='foxcloud-popupbutton'><i class='fa fa-trash' aria-hidden='true'></i>Elimina</a>
 </div>
 <div id='hudden_folderMenu' class='foxcloud-popup'>
  <a class='foxcloud-popupbuttonFolder'><i class='fa-solid fa-pen-to-square'></i> Rinomina</a><br>
  <a class='foxcloud-popupbuttonFolder'><i class='fa fa-trash' aria-hidden='true'></i> Elimina</a>
 </div>

 <script src='/http.js'></script>
 <script>
 let showed = false;
 let last = null;

 const folder = document.getElementById('hudden_folderMenu');
 const file = document.getElementById('hudden_fileMenu');

 function showSettingsFor(el, type) {
   if (showed) {
     folder.style.display = "none";
     file.style.display = "none";
     showed = false;
   }
 
   if (last == el) {
     folder.style.display = "none";
     file.style.display = "none";
     last = null;
     showed = false;
     return;
   }

   let rect = el.getBoundingClientRect();
   var name = el.parentElement.id;
   showed = true;
   last = el;
   if (type == "folder") {
     var load = document.getElementsByClassName('foxcloud-popupbuttonFolder');
     folder.style.top = rect.bottom + document.documentElement.scrollTop + 'px';
     folder.style.left = rect.left + 'px';
     folder.style.display = "block";
     load[0].href = '/u/<?= $pp[0]; ?>/rename/' + name;
     load[1].href = '/u/<?= $pp[0]; ?>/deleteDirectory/' + name;
   } else {
     var load = document.getElementsByClassName('foxcloud-popupbutton');
     file.style.top = rect.bottom + document.documentElement.scrollTop + 'px';
     file.style.left = rect.left + 'px';
     load[0].href = '/download?url=' + name;
     load[1].href = '/u/<?= $pp[0]; ?>/share/' + name;
     load[2].href = '/u/<?= $pp[0]; ?>/rename/' + name;
     if (name == '' || name == '/') {
       alert("INVALID INPUT!");
       return;
     }
     load[3].href = '/u/<?= $pp[0]; ?>/deleteFile/' + name;
     file.style.display = "block";
   }
 }

 function evidenziaFile(number) {
    var res = JSON.parse(http_request('/evidenziaFile?file=' + number));
    alert(res.message);
    location.reload(); 
 }

 document.getElementById('body').addEventListener('load', loadFileEvidenziati());

 function loadFileEvidenziati() {
   var res = JSON.parse(http_request('/getEvidenziati'));
   if (res.presence == true) {
     for (let a = 0; a < 250; a++) {
       if (res.evidenziati[a] != "" && document.getElementById(res.evidenziati[a]) != null) {
         document.getElementById(res.evidenziati[a]).style.backgroundColor = "yellow";
         if (isInDarkMode()) {
           document.getElementById(res.evidenziati[a]).style.color = "white";
         }
       }
     }
   }
 }
 </script>
