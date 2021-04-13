<?php
$title = 'Chairman - Dashboard';
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


    <div id="content-wrapper">

        <div class="container-fluid">
        <?php 
        
        if (isset($_SESSION['update'])) {
            echo "<div class='alert alert-success'>
                    ".$_SESSION['update']."
                  </div>";
            unset($_SESSION['update']);
             }
        
        ?>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Student List</li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">

                <div id="card-header">
                    <h1 style="padding: 30px 0px 0px 20px"><i class="fas fa-table"></i>
                        List of Student <a href="index.php?add" class="btn btn-primary"> New<img
                                src="../assets/img/plus_30px.png" width="20px"> </a></h1>
                    <img width="100px" src="../assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead style="background-color: #4CAF50; color: white">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Contact No.</th>
                                    <th>Course</th>
                                    <th>Grade Image</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 

            $sql = "SELECT * FROM `tblstudent` t, `course` c WHERE t.COURSE_ID = c.COURSE_ID";
            $result = mysqli_query($db, $sql);

            mysqli_num_rows($result);

            while ($row = mysqli_fetch_array($result)) {
             ?>
                                <tr>

                                    <td width=""><?php echo $row['IDNO'] ?></td>
                                    <td> <?php echo $row['FNAME'].' '.$row['LNAME'].' '.$row['MNAME']; ?></td>
                                    <td><?php echo $row['SEX'] ?></td>
                                    <td align="center" width="5%"><?php echo $row['AGE'] ?></td>
                                    <td><?php echo $row['HOME_ADD'] ?></td>
                                    <td><?php echo $row['CONTACT_NO'] ?></td>
                                    <td><?php echo $row['COURSE_NAME'] ?></td>
                                    <td width="20%" align="center"><a href="" data-toggle="modal"
                                            data-target="#uploadedgrade" class="btn btn-warning"><i style="color: #fff"
                                                class="fa fa-print"> </i> View Uploaded Grade</a></td>
                                    <td width="10%" align="center">
                                        <a href="update_student.php?id=<?php echo $row['IDNO']?>"
                                            class="btn btn-primary btn-xs  "><span style="color:white"
                                                class="fa fa-edit fw-fa"></span></a>
                                        <a href="" class="btn btn-danger btn-xs  "><span style="color:white"
                                                class="fa fa-trash"></span></a>

                                    </td>
                                </tr>

                                <div class="modal fade" id="uploadedgrade" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document"
                                        style="width: auto; max-width: 622.222px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">View Uploaded Grade Image
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <a href="../file_upload/<?php echo $row['IDNO']?>.jpg"
                                                    class="btn btn-warning btn-sm " target="_blank"> VIEW FULL IMAGE</a>
                                                <img src="../file_upload/<?php echo $row['IDNO']?>.jpg" width="100%" />
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
            }
           ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
        <!-- /.container-fluid -->

    </div>

    <!-- /.content-wrapper -->
</div>


<?php include '../includes/footer.php' ?>