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
 <div style="position: absolute; left: 30%; text-align: left">
<?php
 foreach(glob("protected/disk/$user->dir/$bb") as $file) {
   if (is_dir($file)) {
     $f = str_replace(str_replace("%20", " ", $replace), "", $file);
     echo "<a href='/u/$pp[0]/files/$h$f/'>$f/</a><a href='/u/$pp[0]/deleteDirectory/$h$f' style='position: absolute; text-align: right; right: -50%'><i class='fa fa-trash' aria-hidden='true'></i></a><br>";
   } else {
     $f = str_replace(str_replace("%20", " ", $replace), "", $file);
     echo "<a href='/u/$pp[0]/fileopen/$h$f'>$f</a><a href='/download?url=/u/$pp[0]/files/$h$f' style='position: absolute; text-align: right; right: -40%'><i class='fa fa-cloud-download' aria-hidden='true'></i></a> <a href='/u/$pp[0]/deleteFile/$h$f' style='position: absolute; text-align: right; right: -50%'><i class='fa fa-trash' aria-hidden='true'></i></a><a href='/u/$pp[0]/share/$h$f' style='position: absolute; text-align: right; right: -60%'><i class='fa fa-share-alt-square' aria-hidden='true'></i></a><br>";
   }
 }
 ?>
 </div>