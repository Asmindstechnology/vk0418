<?php
$tmp =  addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
print_r($tmp);exit;
?>