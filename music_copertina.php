<?php
$music = filter_var(str_replace("%20", " ", $_GET["track"]), FILTER_SANITIZE_STRING);

$dir = "protected/music/copertine/$music.png";
if (file_exists($dir)) {
   header("Content-Type: image/png");
   header("Content-Length: " . filesize($dir));
   readfile($dir);
} else {
   $dir = "protected/music/copertine/.png";
   header("Content-Type: image/png");
   header("Content-Length: " . filesize($dir));
   readfile($dir);
}
?>
