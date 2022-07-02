<?php
$bb = str_replace("%20", " ", $bb);

if (!file_exists($bb)) {
  die(json_encode(array('status' => 400, 'message' => 'Il file non esiste!')));
}

// Ok, ora sistemiamo tutto evidenziando il file
file_put_contents('protected/sys/fileEvidenziati.array', file_get_contents('protected/sys/fileEvidenziati.array') . $bb . '//!!\\(())(())(())((((()()()()()(()()984984578475987357/////(/&&\\'));

// Ok, tutto apposto, ritorno con un 200
die(json_encode(array('status' => 200, 'message' => 'File evidenziato!')));
