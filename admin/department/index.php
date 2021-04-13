<?php 
require '../includes/connection.php';
require '../includes/header.php'; ?>

<?php 

  

  if(isset($_GET['update'])){
    $dept_id = $_GET['update'];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $DEPARTMENT_NAME = $_POST['DEPARTMENT_NAME'];
        $DEPARTMENT_DESC = $_POST['DEPARTMENT_DESC'];

        $sql = "UPDATE department SET DEPARTMENT_NAME='$DEPARTMENT_NAME', DEPARTMENT_DESC='$DEPARTMENT_DESC' WHERE DEPT_ID='$dept_id'";
        if(mysqli_query($db, $sql)){
          $_SESSION['addSuccess'] = "You updated Successfully!";
        }
    }
  } 
  
  elseif(isset($_GET['delete'])){
    $dept_id = $_GET['delete'];
    
    $sql = "DELETE FROM `department` WHERE DEPT_ID='$dept_id'";
    if(mysqli_query($db, $sql)){
      $_SESSION['addSuccess'] = "You deleted Successfully!";
    }

  }else{
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $DEPARTMENT_NAME = $_POST['DEPARTMENT_NAME'];
        $DEPARTMENT_DESC = $_POST['DEPARTMENT_DESC'];
        $sql = "INSERT INTO department(DEPARTMENT_NAME, DEPARTMENT_DESC) VALUES ('$DEPARTMENT_NAME', '$DEPARTMENT_DESC')";
        if(mysqli_query($db, $sql)){
          $_SESSION['addSuccess'] = "You added Successfully!";
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
        <a class="nav-link" href="../student/index.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Students</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Input</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="nav-link" href="../semester/index.php">
          <i class="fas fa-fw fa-circle"></i>
          <span>Set Semester</span></a>

          <a class="nav-link" href="index.php">
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

        <?php if(isset($_SESSION['addSuccess'])){
                echo "<div class='alert alert-success'>".$_SESSION['addSuccess']."</div>";
                unset($_SESSION['addSuccess']);
        } ?>
        <?php if (isset($_GET['add'])): ?>
           <?php include 'add.php'; ?>
        <?php elseif (isset($_GET['update'])): ?>
           <?php include 'list.php'; ?>
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