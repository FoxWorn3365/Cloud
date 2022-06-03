<?php
$textAbout = explode('/', $bb);
for ($a = 0; $a < count($textAbout)-1; $a++) {
  $list = $list . $textAbout[$a] . '/';
}
if (!empty($link)) {
  $download = '/download?file=' . $bb . '&type=shared&shared=' . $link;
} else {
  $download = $bb;
}
?>
<br>
  <?php if ($ext[$cc-1] == "txt" || $ext[$cc-1] == "md" || $ext[$cc-1] == "text" || $ext[$cc-1] == "wrf") {?>  <a href="/u/<?= $pp[0]; ?>/editfile/<?= $bb; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a> | <?php } ?><a href="/u/<?= $pp[0]; ?>/deleteFile/<?= $bb; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a> | <a href='/u/<?= $pp[0]; ?>/share/<?= $bb; ?>'><i class="fa-solid fa-share-from-square"></i></a> | <a href="<?= $download; ?>"><i class="fa fa-cloud-download" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; File: <b>/<?= $bb; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/u/<?= $pp[0]; ?>/files/<?= $list; ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
  <br>
  <hr>
  <br>
