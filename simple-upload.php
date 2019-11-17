<?php
// SOURCE + DESTINATION
session_start();
include("ListBuilder.php");

$source = $_FILES["file-upload"]["tmp_name"];
$destination = $_FILES["file-upload"]["name"];
$error = "";

// CHECK IF FILE ALREADY EXIST
if (file_exists($destination)) {
  $error = $destination . " already exist.";
}

// ALLOWED FILE EXTENSIONS
if ($error == "") {
  $allowed = ["jpg", "jpeg", "png", "gif"];
  $ext = strtolower(pathinfo($_FILES["file-upload"]["name"], PATHINFO_EXTENSION));
  if (!in_array($ext, $allowed)) {
    $error = "$ext file type not allowed - " . $_FILES["file-upload"]["name"];
  }
}

// LEGIT IMAGE FILE CHECK
if ($error == "") {
  if (getimagesize($_FILES["file-upload"]["tmp_name"]) == false) {
    $error = $_FILES["file-upload"]["name"] . " is not a valid image file.";
  }
}

// FILE SIZE CHECK
if ($error == "") {
  // 1,000,000 = 1MB
  if ($_FILES["file-upload"]["size"] > 50000000) {
    $error = $_FILES["file-upload"]["name"] . " - file size too big!";
  }
}

// ALL CHECKS OK - MOVE FILE
if ($error == "") {
  if (!move_uploaded_file($source, $destination)) {
    $error = "Error moving $source to $destination";
  }
}

// ERROR OCCURED OR OK?
if ($error == "") {

    $list = new ListBuilder();
    $list->add($_FILES["file-upload"]["name"]);
    if (isset($_SESSION["files"])){
        foreach ($_SESSION["files"] as $files)
        {
            $list->add($files);
        }
    }



  echo $_FILES["file-upload"]["name"] . " upload OK";


    $_SESSION["files"] = $list->get();
    var_dump($list->get());
} else {
  echo $error;
}
?>