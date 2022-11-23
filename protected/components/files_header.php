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
for ($a = 0; $a < count($textAbout)-2; $a++) {
  $list = $list . '/' . $textAbout[$a];
}

$localS = json_decode(file_get_contents('protected/sys/.' . $_SESSION["user"] . '_preferences.sys'));
?>
 <div id='fileList' style='text-align: left'>
  <div id='fileList_menu' class='foxcloud-filemenu w3-display-container'>
   <a href="/u/<?= $pp[0]; ?>/uploadFile/<?= str_replace("*", "", $bb); ?>"><i class="fa fa-cloud-upload" aria-hidden="true"></i></i></a> | <a href="/u/<?= $pp[0]; ?>/createDir/<?= str_replace("*", "", $bb); ?>"><i class="fa fa-folder" aria-hidden="true"></i></a> | <a href="/u/<?= $pp[0]; ?>/new/<?= str_replace("*", "", $bb); ?>"><i class="fa-solid fa-circle-plus"></i></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Directory: <b>/<?= $bb; ?></b><?php if ($dd != "*") { ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/u/<?= $pp[0]; ?>/files<?= $list; ?>/"><i class="fa fa-level-up" aria-hidden="true"></i></a> <?php } ?> <?php if ($localS->searchBar == "true") { ?><input type='text' class='foxcloud-fileheader-input w3-right' placeholder='banana.txt' id='fileSearchTerm'> <?php } ?>
  </div>
  <br>
  <div id='fileList_list' class='foxcloud-filelist'>
