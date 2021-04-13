<?php 
session_start();

if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
       header("location:../index.php");
     }

$IDNO = $_SESSION['ACCOUNT_USERNAME'];

include '../includes/connection.php';
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SLSU GRADUATION APPLICATION</title>

    <style type="text/css">
        #header, #nav, .noprint
{
display: none;
}
@page { margin: 0; }
@media print {
  @page { margin: 0; }
  body { margin: 1.6cm; }
}
    </style>
</head>
<body onload="window.print();">
  <div class="print_head">

  </div>


<?php include 'firstyearsubject.php';?>
<?php include 'firstsummer.php';?>
<?php include 'secondyearsubject.php';?>
<?php include 'secondsummer.php';?>
<?php include 'thirdyearsubject.php';?>
<?php include 'thirdsummer.php';?>
<?php include 'fourthyearsubject.php';?>





</body>
</html>
