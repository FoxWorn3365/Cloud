<?php
foreach($song->sing as $songname) {
   $othercanzonebella = json_decode(file_get_contents("protected/disk/diskOfMusic/info/$songname->url"));
   echo "<a href='https://cloud.fcosma.it/m/$songname->url' style='text-decoration: none'><span style='font-size: 25px'>$songname->name</span><span style='font-size: 15px'> - $othercanzonebella->author</span></a><br>";
}