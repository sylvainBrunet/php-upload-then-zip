<?php
/**
 * Created by PhpStorm.
 * User: Brunet Sylvain
 * Date: 16/11/2019
 * Time: 12:26
 */
session_start();

$zip = new ZipArchive();
$zipname = $_POST['zipname'];
echo $zipname;
$filename = "./".$zipname.".zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}

foreach ($_SESSION["files"] as $files)
{
    $zip->addFile($files);
}


echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();
?>