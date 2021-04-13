<?php


  include '../includes/connection.php';


   $sql = "SELECT * FROM course
         WHERE DEPT_ID LIKE '%".$_GET['DEPT_ID']."%'"; 


   $result = mysqli_query($db, $sql);
 

   $json = [];
   while($row = $result->fetch_assoc()){
        $json[$row['COURSE_ID']] = $row['COURSE_NAME'];
   }


   echo json_encode($json);
?>