<?php 
require '../includes/connection.php';
require '../includes/header.php'; 


if(isset($_GET['update'])){
  $id = $_GET['update'];
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

    $FULLNAME = $FNAME ." ". $LNAME;

    $sql = "UPDATE tblstudent SET FNAME='$FNAME', LNAME='$LNAME', MNAME='$MI', HOME_ADD = '$PADDRESS',
     BDAY = '$BIRTHDATE', BPLACE = '$BIRTHPLACE', NATIONALITY = '$NATIONALITY', RELIGION = '$RELIGION', CONTACT_NO = '$CONTACT', STATUS = '$CIVILSTATUS', guardian = '$GUARDIAN', guardian_contact = '$GCONTACT' WHERE IDNO = '$id'";
    if ($result = mysqli_query($db, $sql)) {
        $update_user = "UPDATE useraccounts SET ACCOUNT_NAME='$FULLNAME' WHERE ACCOUNT_USERNAME = '$id'";

        if ($result = mysqli_query($db, $update_user)) {
        $_SESSION['update'] = "You Updated Successful!";
        }
    }
   } 
  }elseif(isset($_GET['add'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
     
        $IDNO = $_POST['IDNO'];
        $FNAME = $_POST['fname'];
        $LNAME = $_POST['lname'];
        $MI = $_POST['mname'];
        $PADDRESS = $_POST['address'];
        $BIRTHDATE = $_POST['bday'];
        $BIRTHPLACE = $_POST['bplace'];
        $NATIONALITY = $_POST['nationality'];
        $RELIGION = $_POST['religion'];
        $CONTACT = $_POST['contact'];
        $CIVILSTATUS = $_POST['civilstatus'];
        $GUARDIAN = $_POST['guardian'];
        $GCONTACT = $_POST['contact_guardian'];
        $GENDER = $_POST['gender'];

        $FULLNAME = $FNAME ." ". $LNAME;

        //age
        $date = $_POST['bday'];
        $today = date("m-d-Y");
        $diff = date_diff(date_create($date), date_create($today));
        $age = $diff->format('%y');

        //educational background
        $preliminary = $_POST['elem'];
        $year1 = $_POST['elem_year']; 
        $secondary = $_POST['hs'];
        $year2 = $_POST['hs_year'];
        $tertiary = $_POST['col'];
        $year3 = $_POST['col_year'];
        $param_password = "$2y$10$26zFqcv6bRrBoKfcatpa6erbTHQBPYVFYnEKjrVxIkm45YBW4XRTS";

         //Course and Department
        $course = $_POST['course'];

        $insert_std = "INSERT INTO `tblstudent`(`IDNO`, `FNAME`, `LNAME`, `MNAME`, `SEX`, `BDAY`, `BPLACE`, 
        `STATUS`, `AGE`, `NATIONALITY`, `RELIGION`, `CONTACT_NO`, `HOME_ADD`, `ACC_USERNAME`, `ACC_PASSWORD`, 
        `COURSE_ID`, `elem`, `elem_yer`, `hs`, `hs_yer`, `col`, `col_yer`, `guardian`, `guardian_contact`) VALUES ('$IDNO', '$FNAME', '$LNAME', '$MI', '$GENDER', '$BIRTHDATE', 
        '$BIRTHPLACE', '$CIVILSTATUS', '$age', '$NATIONALITY', '$RELIGION', '$CONTACT', '$PADDRESS', '$IDNO', 
        '$param_password', '$course', '$preliminary', '$year1', '$secondary', '$year2', '$tertiary', 
        '$year3', '$GUARDIAN', '$GCONTACT')";
        
        if(mysqli_query($db, $insert_std)){
            $fetch_subject = "SELECT * FROM `subject` WHERE COURSE_ID='$course'";
            $result_subject = mysqli_query($db, $fetch_subject);

            while($my_subject = mysqli_fetch_array($result_subject)){

                $std_no = $IDNO;
                $subj_id = $my_subject['SUBJ_ID'];
                $sem = $my_subject['SEMESTER'];

                $insert_grade = "INSERT INTO grades (IDNO, SUBJ_ID, SEMS) VALUES ('$std_no', '$subj_id', '$sem')";
                
                if(mysqli_query($db, $insert_grade)){
                    
                   $insert_user = "INSERT INTO useraccounts (ACCOUNT_NAME, ACCOUNT_USERNAME, ACCOUNT_PASSWORD, ACCOUNT_TYPE) VALUES ('$FULLNAME', '$IDNO', '$param_password', 'Student')";

                   if(mysqli_query($db, $insert_user)){
                    $_SESSION['update'] = "You Added Student Successful!";
                   }
                }
            }
        }
    }
  }

?>

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="../index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Students</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Input</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="nav-link" href="../semester/index.php">
                    <i class="fas fa-fw fa-circle"></i>
                    <span>Set Semester</span></a>

                <a class="nav-link" href="../department/index.php">
                    <i class="fas fa-fw fa-circle"></i>
                    <span>Department</span></a>

                <a class="nav-link" href="../course/index.php">
                    <i class="fas fa-fw fa-circle"></i>
                    <span>Courses</span></a>

                <a class="nav-link" href="../subject/index.php">
                    <i class="fas fa-fw fa-circle"></i>
                    <span>Curriculum</span></a>

                <a class="nav-link" href="../schoolyear/index.php">
                    <i class="fas fa-fw fa-circle"></i>
                    <span>School Year</span></a>

                <a class="nav-link" href="../yearlevel/index.php">
                    <i class="fas fa-fw fa-circle"></i>
                    <span>Year Level</span></a>

                <a class="nav-link" href="../section/index.php">
                    <i class="fas fa-fw fa-circle"></i>
                    <span>Section</span></a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../user/index.php">
                <i class="fas fa-fw fa-user"></i>
                <span>Users</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../backup/backup.php">
                <i class="fa fa-database fa-fw"></i>
                <span>Back-Up and Restore</span></a>
        </li>
    </ul>
    <div id="content-wrapper">

        <div class="container-fluid">
        <?php if (isset($_SESSION['update'])) {
            echo "<div class='alert alert-success'>
                    ".$_SESSION['update']."
                  </div>";
            unset($_SESSION['update']);
             } ?>
            <?php if (isset($_GET['add'])): ?>
            <?php include 'add.php'; ?>
            
            <?php elseif (isset($_GET['update'])): ?>
            <?php include 'update.php'; ?>

            <?php else: ?>
            <?php include 'list.php'; ?>
            <?php endif ?>

        </div>

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php require '../includes/footer.php'; ?>