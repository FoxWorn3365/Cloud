<?php
$textAbout = explode('/', $bb);
for ($a = 0; $a < count($textAbout)-2; $a++) {
  $list = $list . '/' . $textAbout[$a];
}
?>
 <br>
 <a href="/u/<?= $pp[0]; ?>/uploadFile/<?= str_replace("*", "", $bb); ?>"><i class="fa fa-cloud-upload" aria-hidden="true"></i></i></a> | <a href="/u/<?= $pp[0]; ?>/createDir/<?= str_replace("*", "", $bb); ?>"><i class="fa fa-folder" aria-hidden="true"></i></a> | <a href="/u/<?= $pp[0]; ?>/new/<?= str_replace("*", "", $bb); ?>"><i class="fa-solid fa-circle-plus"></i></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Directory: <b>/<?= $bb; ?></b><?php if ($dd != "*") { ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/u/<?= $pp[0]; ?>/files<?= $list; ?>/"><i class="fa fa-level-up" aria-hidden="true"></i></a> <?php } ?>
 <hr>
 <br>
 <table style='width: 100%; border: none; position: absolute; left: 25px;' id='mytable'>
  <tr>
   <th><!-- filename --></th>
   <th><!-- peso --></th>
   <th><!-- scarica --></th>
   <th><!-- elimina --></th>
   <th><!-- condividi --></th>
   <th><!-- rinomina --></th>
  </tr>
