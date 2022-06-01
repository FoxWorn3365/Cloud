 <br>
 <?php
 if (empty($bb)) {
  $replace = 'protected/disk/' . $user->dir. '/';
  $h = str_replace("*", "", $bb);
 } else {
  $replace = str_replace('*', '', 'protected/disk/' . $user->dir. '/' . $bb);
  $h = str_replace("*", "", $bb);
 }

 $bb = str_replace("%20", " ", $bb) . '*';
 $bb = str_replace("%28", "(", $bb);
 $bb = str_replace("%29", ")", $bb);

 require_once("protected/components/files_header.php");
?>
 <div style="position: absolute; left: 50px; text-align: left; width: 50%">
<?php
 $count = 0;
 foreach(glob("protected/disk/$user->dir/$bb") as $file) {
   if (is_dir($file)) {
     $f = str_replace(str_replace("%20", " ", $replace), "", $file);
     echo "<i class='fa-solid fa-folder'></i> <a href='/u/$pp[0]/files/$h$f/'><b>$f/</b></a><a href='/u/$pp[0]/deleteDirectory/$h$f' style='position: absolute; text-align: right; right: -80%'><i class='fa fa-trash' aria-hidden='true'></i></a><a style='position: absolute; text-align: right; right: -90%' href='/u/$pp[0]/rename/$h$f'><i class='fa-solid fa-pen-to-square'></i></a><br>";
   } else {
     $f = str_replace(str_replace("%20", " ", $replace), "", $file);

     $ext = end(explode('.', $f));

     if ($ext == "png" || $ext == "jpg" || $ext == "jpeg"  || $ext == "gif") {
       $icona = '<i class="fa-solid fa-file-image"></i>';
     } elseif ($ext == "txt" || $ext == "md" || $ext == "fox") {
       $icona = '<i class="fa-solid fa-file-lines"></i>';
     } elseif ($ext == "ogg" || $ext == "mp3" || $ext == "m4a") {
       $icona = '<i class="fa-solid fa-file-video"></i>';
     } elseif ($ext == "zip" || $ext == "gz") {
       $icona = '<i class="fa-solid fa-file-zipper"></i>';
     } elseif ($ext == "html" || $ext == "htm" || $ext == "js" || $ext == "css" || $ext == "php" || $ext == "c") {
       $icona = '<i class="fa-solid fa-file-zipper"></i>';
     } elseif ($ext == "mp4" || $ext == "mkv" || $ext == "webm") {
       $icona = '<i class="fa-solid fa-file-video"></i>';
     } else {
       $icona = '<i class="fa-solid fa-file"></i>';
     }
     echo "$icona <u><a href='/u/$pp[0]/fileopen/$h$f'>$f</a> <span style='position: absolute; text-align: right; right: -50%'>". filesize($file)/1000 . "</span><a href='/download?url=/u/$pp[0]/files/$h$f' style='position: absolute; text-align: right; right: -75%'><i class='fa fa-cloud-download' aria-hidden='true'></i></a> <a style='position: absolute; text-align: right; right: -80%' href='/u/$pp[0]/deleteFile/$h$f'><i class='fa fa-trash' aria-hidden='true'></i></a><a style='position: absolute; text-align: right; right: -85%' href='/u/$pp[0]/share/$h$f'><i class='fa-solid fa-share-from-square'></i></i></a><a style='position: absolute; text-align: right; right: -90%' href='/u/$pp[0]/rename/$h$f'><i class='fa-solid fa-pen-to-square'></i></a></u><br>";
     $count++;
   }
 }
 ?>
 <br><br><br><br><br><br><br>
 </div>
