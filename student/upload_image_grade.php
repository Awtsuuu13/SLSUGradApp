<?php 

if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
       header("location:../index.php");
     } ?><?php
session_start();
require_once ("../includes/connection.php");


$myerror = "";
$target_dir = "../file_upload/";
$target_file = $target_dir . $_SESSION['ACCOUNT_USERNAME'].".jpg";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
    $check = getimagesize($_FILES["imageGrade"]["tmp_name"]);
    if($check !== false) {
        $myerror =  "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $_SESSION['uploadError'] = "Sorry, your file was not uploaded.";
        $uploadOk = 0;
        header('Location: index.php');
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink($target_dir . $_SESSION['ACCOUNT_USERNAME'].".jpg" );
}
// Check file size
if ($_FILES["imageGrade"]["size"] > 50000000) {
    $myerror =  "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" ) {
    $myerror =  "Sorry, only JPG";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $_SESSION['uploadError'] = "Sorry, your file was not uploaded.";
    header('Location: index.php');
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["imageGrade"]["tmp_name"], $target_file)) {
        $_SESSION['uploadSuccess'] = "Image grade has been successfully uploaded!";
         header('Location: index.php');
    } else {
         $_SESSION['uploadError'] = "Sorry, your file was not uploaded.";
         header('Location: index.php');
    }
}
echo $myerror;
echo "<script>alert('$myerror');window.location.replace('../'); </script>"




?>
