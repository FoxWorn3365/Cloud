<?php
require_once("protected/components/editfile_header.php");

$bb = str_replace("%20", " ", $bb);
?>
  <textarea name="contenuto" style="width: 80%; height: 500px"><?= file_get_contents("protected/disk/$user->dir/$bb"); ?></textarea>
</form>
