<?php
session_start();
$user = $_SESSION["user"];

if (file_exists('protected/sys/' . $user. 'fileEvidenziati.array')) {
  die(json_encode(array('status' => 200, 'presence' => true, 'evidenziati' => explode('//!!\\(())(())(())((((()()()()()(()()984984578475987357/////(/&&\\', file_get_contents('protected/sys/' . $user . 'fileEvidenziati.array')))));
} else {
  die(json_encode(array('status' => 400, 'presence' => false)));
}
