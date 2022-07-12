<?php
function rrmdir($dir) { 
  if (is_dir($dir)) { 
    $objects = scandir($dir);
    foreach ($objects as $object) { 
      if ($object != "." && $object != "..") { 
        if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
          rrmdir($dir. DIRECTORY_SEPARATOR .$object);
        else
          unlink($dir. DIRECTORY_SEPARATOR .$object); 
      } 
    }
    rmdir($dir); 
  } 
}

$config = json_decode(file_get_contents('protected/users/' . $us . '/userinfo.conf'));
if (!empty($config->dir)) {
  rrmdir('protected/disk/' . $config->dir . '/');
}

header("Location: /admin/mep");
