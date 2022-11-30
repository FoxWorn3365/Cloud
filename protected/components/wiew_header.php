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

$textAbout = explode('/', $bb);
for ($a = 0; $a < count($textAbout)-1; $a++) {
  $list = $list . $textAbout[$a] . '/';
}
if (!empty($link)) {
  $download = '/download?url=' . $bb . '&type=shared&shared=' . $link;
} else {
  $download = '/download?url=' . $bb;
}
?>
<br>
 <div id='fileList' style='text-align: center'>
  <div id='fileList_menu' class='foxcloud-filemenu' style='text-align: left'>
   <?php if ($ext[$cc-1] == "txt" || $ext[$cc-1] == "md" || $ext[$cc-1] == "text" || $ext[$cc-1] == "wrf") {?>  <a href="/u/<?= $pp[0]; ?>/editfile/<?= $bb; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a> | <?php } ?><a href="/u/<?= $pp[0]; ?>/deleteFile/<?= $bb; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a> | <a href='/u/<?= $pp[0]; ?>/share/<?= $bb; ?>'><i class="fa-solid fa-share-from-square"></i></a> | <a href="<?= $download; ?>"><i class="fa fa-cloud-download" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; File: <b>/<?= $bb; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/u/<?= $pp[0]; ?>/files/<?= $list; ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
  </div>
  <br>
