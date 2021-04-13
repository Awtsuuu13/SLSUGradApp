<?php 

if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
       header("location:../index.php");
     } ?><div>Third Year | First Semester</div>
  <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <th width="20%">COURSE CODE</th>
      <th width="50%">COURSE TITLE</th>
      <th width="10%">UNITS</th>
       <th width="15%">PRE-REQ.</th>
        <th width="5%">RATING</th>
    </thead>
    <tbody>
      <?php
          $level = "Third Year";
          $semester ="First";
           $sql ="SELECT * FROM `subject` inner join grades on subject.SUBJ_ID=grades.SUBJ_ID where IDNO='$IDNO' and YEARLEVEL = '$level' and SEMESTER = '$semester'";
          $result = mysqli_query($db, $sql);

          while ($row = mysqli_fetch_array($result)) {
           ?>
           <tr>
             <td><?php echo $row['SUBJ_CODE']?></td>
             <td><?php echo $row['SUBJ_DESCRIPTION']?></td>
             <td><?php echo $row['UNIT']?></td>
             <td><?php echo $row['PRE_REQUISITE']?></td>
             <td><?php echo $row['AVE']?></td>
           </tr>
           <?php
          }

      ?>
    </tbody>
  </table>



  <div>Third Year | Second Semester</div>
  <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <th width="20%">COURSE CODE</th>
      <th width="50%">COURSE TITLE</th>
      <th width="10%">UNITS</th>
       <th width="15%">PRE-REQ.</th>
        <th width="5%">RATING</th>
    </thead>
    <tbody>
      <?php
          $level = "Third Year";
          $semester ="Second";
           $sql ="SELECT * FROM `subject` inner join grades on subject.SUBJ_ID=grades.SUBJ_ID where IDNO='$IDNO' and YEARLEVEL = '$level' and SEMESTER = '$semester'";
          $result = mysqli_query($db, $sql);

          while ($row = mysqli_fetch_array($result)) {
           ?>
           <tr>
             <td><?php echo $row['SUBJ_CODE']?></td>
             <td><?php echo $row['SUBJ_DESCRIPTION']?></td>
             <td><?php echo $row['UNIT']?></td>
             <td><?php echo $row['PRE_REQUISITE']?></td>
             <td><?php echo $row['AVE']?></td>
           </tr>
           <?php
          }

      ?>
    </tbody>
  </table>