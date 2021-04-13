<?php
$title = 'Chairman';
include '../includes/header.php'; 
include '../includes/connection.php';
session_start();

if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
  header("location:../index.php");
}
if($_SESSION['ACCOUNT_TYPE'] == 'Student'){
header("location:../student/index.php");
}elseif($_SESSION['ACCOUNT_TYPE'] == 'Administrator'){
header("location:../admin/index.php");
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
        <a class="nav-link" href="student.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Student</span>
        </a>
      </li>
    </ul>

   
</div>


<?php include '../includes/footer.php' ?>