<?php include '../includes/connection.php';
    $x= $_POST['ido'];
     "SELECT * FROM `tblstudent ` where IDNO = '$x'";
  echo  mysql_num_rows(mysql_query("SELECT * FROM `tblstudent` where IDNO = '$x'"));

?>