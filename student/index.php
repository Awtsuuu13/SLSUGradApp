<?php
$title = 'Student';
include '../includes/header.php'; 
include '../includes/connection.php';
session_start();
if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
       header("location:../index.php");
     }

      if($_SESSION['ACCOUNT_TYPE'] == 'Administrator'){
          header("location:../admin/index.php");
       }elseif($_SESSION['ACCOUNT_TYPE'] == 'Instructor'){
          header("location:../instructor/index.php");
       }

      $username = $_SESSION['ACCOUNT_USERNAME'];


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $FNAME = $_POST['FNAME'];
      $LNAME = $_POST['LNAME'];
      $MI = $_POST['MI'];
      $PADDRESS = $_POST['PADDRESS'];
      $BIRTHDATE = $_POST['BIRTHDATE'];
      $BIRTHPLACE = $_POST['BIRTHPLACE'];
      $NATIONALITY = $_POST['NATIONALITY'];
      $RELIGION = $_POST['RELIGION'];
      $CONTACT = $_POST['CONTACT'];
      $CIVILSTATUS = $_POST['CIVILSTATUS'];
      $GUARDIAN = $_POST['GUARDIAN'];
      $GCONTACT = $_POST['GCONTACT'];

      $sql = "UPDATE tblstudent SET FNAME='$FNAME', LNAME='$LNAME', MNAME='$MI', HOME_ADD = '$PADDRESS', BDAY = '$BIRTHDATE', BPLACE = '$BIRTHPLACE', NATIONALITY = '$NATIONALITY', RELIGION = '$RELIGION', CONTACT_NO = '$CONTACT', STATUS = '$CIVILSTATUS', guardian = '$GUARDIAN', guardian_contact = '$GCONTACT' WHERE IDNO = '$username'";
      if ($result = mysqli_query($db, $sql)) {
          $_SESSION['update'] = "You Updated Successful!";
      }

    }

?>
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="index.php?id=<?php echo $username ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Update Details</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="enrolled_subject.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Enrolled Subject</span></a>
      </li>
      
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
        <?php if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>
                    ".$_SESSION['success']."
                  </div>";
            unset($_SESSION['success']);
             }if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger'>
                    ".$_SESSION['error']."
                  </div>";
            unset($_SESSION['error']);
             }if (isset($_SESSION['update'])) {
            echo "<div class='alert alert-success'>
                    ".$_SESSION['update']."
                  </div>";
            unset($_SESSION['update']);
             }if (isset($_SESSION['uploadSuccess'])) {
            echo "<div class='alert alert-success'>
                    ".$_SESSION['uploadSuccess']."
                  </div>";
            unset($_SESSION['uploadSuccess']);
             }if (isset($_SESSION['uploadError'])) {
            echo "<div class='alert alert-danger'>
                    ".$_SESSION['uploadError']."
                  </div>";
            unset($_SESSION['uploadError']);
             }
        ?>
        <?php if (!isset($_GET['id'])): ?>
          
       
      	<!-- DataTables Example -->
        <div class="col-lg-12" class="card mb-3">
          <div id="card-header">
            Dashboard</div>
            <div class="col-lg-12" id="page-header">
            Student Subjects 
            	<a class="btn btn-primary btn-sm" target="_blank" href="print_curriculum.php" style="color: #fff;background-color: #0069d9; border-color: #0062cc;"><i style="color: #fff" class="fa fa-print"> </i> Print Curriculum</a>

            	<a class="btn btn-primary btn-sm" href="" data-toggle="modal" data-target="#uploadImage" style="color: #fff;background-color: #0069d9; border-color: #0062cc;"><i style="color: #fff" class="fa fa-print"> </i> UPLOAD GRADES</a>

            	<a class="btn btn-warning btn-sm" href="" data-toggle="modal" data-target="#viewImage" style="color: #fff;background-color: #f0ad4e; border-color: #eea236;"><i style="color: #fff" class="fa fa-print"> </i> VIEW UPLOADED GRADES IMAGE</a>

            	<a class="btn btn-success btn-sm" target="_blank" href="print_application.php" style="color: #fff;background-color: #5cb85c; border-color: #4cae4c;"><i style="color: #fff" class="fa fa-print"> </i> PRINT APPLICATION FORM</a>
        	</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Grade</th>
                    <th>Remarks</th>
                    <th>Year Level</th>
                    <th>Semester</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                
                <tbody>
                  <?php 
                  	$IDNO = $_SESSION['ACCOUNT_USERNAME'];
                  	
                  	$sql = "SELECT * FROM `grades` g, `subject` s WHERE g.SUBJ_ID = s.SUBJ_ID AND IDNO = '$IDNO' group by SUBJ_CODE order by YEARLEVEL ASC";
                  	$result = mysqli_query($db, $sql);

                  	if(mysqli_num_rows($result)){

                  	while($row = mysqli_fetch_array($result)){
                  		?>
                  		<tr>
                  			<td><?php echo $row['SUBJ_CODE'] ?></td>
                  			<td><?php echo $row['SUBJ_DESCRIPTION'] ?></td>
                  			<td><?php echo $row['UNIT'] ?></td>
                  			<td><?php echo $row['AVE'] ?></td>
                  			<?php if ($row['REMARKS'] == 'Passed'): ?>
                          <td class="text-success"><strong><?php echo $row['REMARKS'] ?></strong></td>
                        <?php else: ?>
                          <td class="text-danger"><strong><?php echo $row['REMARKS'] ?></strong></td>
                        <?php endif ?>
                  			<td><?php echo $row['YEARLEVEL'] ?></td>
                  			<td><?php echo $row['SEMESTER'] ?></td>
                  			<td><a href="" data-toggle="modal" data-target="#addGrade<?php echo $row['SUBJ_ID'] ?>">Add Grades</a></td>

                  		</tr>
                      <!-- Add Grade Modal-->
                      <div class="modal fade" id="addGrade<?php echo $row['SUBJ_ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add Grade</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="addGrade.php?grade_id=<?php echo $row['SUBJ_ID'] ?>">
                         <label>Subject</label>
                         <textarea name="SUBJ_CODE" readonly="true" rows="2" class="form-control"><?php echo $row['SUBJ_DESCRIPTION'] ?></textarea>
                         <br />
                         
                         <label>Pre-Requisite</label>
                         <input type="text" name="requisite" id="designation" class="form-control" readonly="true" value="<?php echo $row['PRE_REQUISITE'] ?>" />
                         <br />  
                         <label>Grade</label>
                         <input type="text" name="grade" id="age" class="form-control" value="<?php echo $row['AVE'] ?>"/>
                         <br />
                         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />

                        </form>
                            </div>

                          </div>
                        </div>
                      </div>
                  		<?php
                  		}
                  	}else{

                  		echo "<tr class'odd'> 
                  				<td colspan='8' class='dataTables_empty text-center'> No Data Available! </td>
                  			 </tr>";
                  	}


                   ?>
                
              </table>

            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <?php else: ?>
          <?php include 'update_details.php'; ?>
         <?php endif ?>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>




                        <!-- Modal-->
                      <div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="upload_image_grade.php" enctype="multipart/form-data">

                               <input type="file" class="form-control form-height-custom" required="required" name="imageGrade"><br>
                              
                              <input type="submit" name="upload" id="insert" value="Upload Image" class="btn btn-success" />

                             </form>
                            </div>

                          </div>
                        </div>
                      </div>


                      <!--view Image Modal-->
                      <div class="modal fade" id="viewImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">View Uploaded Grade Image</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                
                                <a href="../file_upload/<?php echo $IDNO?>.jpg" class="btn btn-warning btn-sm " target="_blank"> VIEW FULL IMAGE</a>
                                <img src="../file_upload/<?php echo $IDNO?>.jpg" width="100%"/>
                             </form>
                            </div>

                          </div>
                        </div>
                      </div>


<?php include '../includes/footer.php' ?>