 <br>
 <?php
 if (empty($dd)) {
  $dd = "*";
  $replace = 'protected/disk/' . $user->dir. '/';
  $h = str_replace("*", "", $dd);
 } else {
  $replace = str_replace('*', '', 'protected/disk/' . $user->dir. '/' . $dd);
  $h = str_replace("*", "", $dd);
 }

 require_once("protected/components/files_header_shared.php");
?>
 <div style="position: absolute; left: 30%; text-align: left">
<?php
 foreach(glob("protected/disk/$user->dir/$dd") as $file) {
   if (is_dir($file)) {
     $f = str_replace($replace, "", $file);
     echo "<a href='/s/$link/$h$f'>$f/</a><br>";
   } else {
     $f = str_replace($replace, "", $file);
     echo "<a href='/s/$link/open/$h$f'>$f</a><a href='/download?url=/u/$pp[0]/files/$h$f' style='position: absolute; text-align: right; right: -35%'><i class='fa fa-cloud-download' aria-hidden='true'></i></a><br>";
   }
 }
 ?>
 </div>