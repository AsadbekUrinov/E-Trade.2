<?php

$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage/photos';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/photos';
$f =  $_SERVER['DOCUMENT_ROOT'].'/symlink.php';
symlink($targetFolder,$linkFolder);

unlink($f);
echo 'Symlink process successfully completed';

?>