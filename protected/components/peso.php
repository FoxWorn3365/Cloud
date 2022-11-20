<?php
// +-----------------------------------+
// |             FoxCloud              |
// +-----------------------------------+
// | Questo file fa parte del progetto |
// | di Cloud Open Source "FoxCloud",  |
// | realizzato da FoxWorn.            |
// +-----------------------------------+
// | Web: https://foxcloud.fcosma.it   |
// | GH: github.com/FoxWorn3365/Cloud  |
// | License: GNU GPL 3.0              |
// +-----------------------------------+
// | You can write me an email at:     |
// | foxworn3365@gmail.com, also for   |
// | talk!                             |
// +-----------------------------------+

// Fonte: https://mrw.it
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
