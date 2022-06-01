<?php
// mrw.it
function dirsize($dir)
{
  // apro la cartella
  @$dh = opendir($dir);
  // creo una variabile
  $size = 0;
  // ciclo il contenuto della cartella
  while ($file = @readdir($dh))
  {
    // verifico che si tratti di file o cartelle
    if ($file != "." and $file != "..") 
    {
      // percorso della risorsa
      $path = $dir."/".$file;
      
      // se è una cartella...
      if (is_dir($path))
      {
        // richiamo la funzione in modo ricorsivo
        $size += dirsize($path);
      }
      // se è un file
      elseif (is_file($path))
      {
        // incremento col peso del file
        $size += filesize($path);
      }
    }
  }
  // chiudo
  @closedir($dh);
  // restituisco la dimensione in termini di bytes
  return $size;
}