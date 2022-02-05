<?php
function richiestaConURL($url) {
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        return curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);    
}

$info = json_decode(file_get_contents("protected/disk/diskOfMusic/info/$music"));
?>
<br>
 <h1>Fcosma Cloud - Music</h1>
 <hr>
 <h3>Correlato al brano <?= $music; ?></h3>
 <?php
  $possible_related = array("sing", "youtube", "spotify", "google", "website", "author");
  $names_related = array("Canzoni", "YouTube", "Spotify", "Google", "Sito Web", "Autore");

  for ($a = 0; $a < count($possible_related); $a++) {
    echo "<h2>$names_related[$a]</h2>";
    echo richiestaConURL("https://cloud.fcosma.it/q/music/$music/$possible_related[$a]");
    echo "<hr width='75%' color='black'>";
  }

 ?>