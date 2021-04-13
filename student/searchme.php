<?php include '../includes/connection.php';
    $x= $_POST['mcode'];
   $y=  mysqli_fetch_array(mysqli_query("SELECT * FROM `subject` where SUBJ_CODE = '$x'"));
    echo $y['SUBJ_DESCRIPTION']."|".$y['UNIT']."|".$y['SUBJ_ID'];
?>