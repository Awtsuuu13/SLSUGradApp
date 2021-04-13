<?php 
session_start();

if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
       header("location:../index.php");
     }


$IDNO = $_SESSION['ACCOUNT_USERNAME'];
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SLSU GRADUATION APPLICATION</title>

    <style type="text/css">
    .SLSU{
      margin-top: -20px;
    }
      .tbl {
        width: 100%;
        border: .5px solid #ddd;
      }
      .tbl > thead  ,
      .tbl > tbody > tr{
        border: .5px solid #ddd;
      }

        #header, #nav, .noprint
{
display: none;
}
@page { margin: 0; }
@media print {
  @page { margin: 0; }
  body { margin: 1.6cm; }
}
.ed tr,.ed{
width:  100%;
  border: 1px solid black;
}
.ed td{
  border: 1px solid black;
}
table, th,tr{
  width:  100%;
  border: none;
  text-align: left;
}
    </style>
</head>
<body onload="window.print();">

    <center>  <h5>Republic of the Philippines</h5>
      <h5 class="SLSU">SOUTHERN LUZON STATE UNIVERSITY</h5>
      <h5 class="SLSU">Lucban, Quezon</h5>
     <label>APPLICATION FOR GRADUATION</h4> </label> </center>

      <table >
         <?php 
         include '../includes/connection.php';
          $sql = "SELECT * FROM `tblstudent` t,  `course` c WHERE t.COURSE_ID = c.COURSE_ID AND IDNO = '$IDNO'";

          $result = mysqli_query($db, $sql);

          mysqli_num_rows($result);

          while($row = mysqli_fetch_array($result)){

            ?>
                    <tr>
            <td align="left">Student Number: <strong><?php echo $IDNO ?></strong></td>

        </tr>
        <tr>
            <td align="left">NAME: <strong><?php echo $row['FNAME'].' '.$row['MNAME'].' '.$row['LNAME']?></strong></td>

        </tr>
        <tr>
            <td align="left">COURSE: <?php echo $row['COURSE_NAME'] ?> <strong></strong></td>

        </tr>
        <tr>
            <td align="left">DATE OF BIRTH: <?php echo $row['BDAY'] ?><strong></strong></td>
            <td align="left"> PLACE OF BIRTH:  <?php echo $row['BPLACE'] ?><strong></strong></td>
        </tr>
        <tr>
            <td align="left">PAERNT/GUARDIAN: <?php echo $row['guardian'] ?><strong></strong></td>
            <td align="left"> OCCUPATION: <strong></strong></td>
        </tr>
        <tr>
            <td align="left">HOME ADDRESS: <?php echo $row['HOME_ADD'] ?><strong></strong></td>
            <td align="left"> CONTACT: <?php echo $row['CONTACT_NO'] ?><strong></strong></td>
        </tr>
    </table><BR>
     <label>EDUCATIONAL BACKGROUND:</label><br>
     <table class=ed>
     <tr>
      <td>  </td>
      <td> SCHOOL/COURSE </td>
      <td> YEAR GRADUATED </td>
     </tr>
     <tr>
      <td> PRELIMINARY </td>
      <td><?php echo $row['elem'] ?></td>
      <td><?php echo $row['elem_yer'] ?></td>
     </tr>
     <tr>
      <td> SECONDARY </td>
      <td><?php echo $row['hs'] ?></td>
      <td><?php echo $row['hs_yer'] ?></td>
     </tr>
     <tr>
      <td> TERTIARY </td>
      <td><?php echo $row['col'] ?></td>
      <td><?php echo $row['col_yer'] ?></td>
     </tr>
     <tr>
      <td> POST GRADUATE </td>
      <td></td>
      <td></td>
     </tr>
            <?php
          }

          ?> </table><br>
          <label>Iam Presently Enroled in the following Subjects:</label>
           <table CLASS="ed">

            <tr>
              <td align="left">SUBJECT CODE:  </td>
              <td align="left"> SUBJECT DESCRIPTION: </td>
              <td align="left"> UNITS: </td>
              <td align="left"> PROFESORS'S NAME <BR> & SIGNATURE: </td>
          </tr>


          <?php 

          $sql = "SELECT * FROM `tbl_enrolled_subject` e, `subject` s WHERE e.e_std_id = '$IDNO' AND e.e_sub_id = s.SUBJ_ID";
          $result = mysqli_query($db, $sql);

          mysqli_num_rows($result);

          while($row = mysqli_fetch_array($result)){
            ?>

            <tr>
              <td align="left"><?php echo $row['SUBJ_CODE'] ?></td>
              <td align="left"><?php echo $row['SUBJ_DESCRIPTION'] ?></td>
              <td align="left"><?php echo $row['UNIT'] ?></td>
              <td align="left"><?php echo $row['e_prof']; ?></td>
          </tr>
            <?php
          }

           ?>
    
      
     
          

          <tr>
              <td align="left"></td>
              <td align="left"> </td>
              <td align="left"></td>
              <td align="left"></td>
          </tr>
        
        </table>
        <br>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        I understand that I will not be allowed to join the Commencement Exercise if I am not able to Comply with all program requirements




</body>
</html>
