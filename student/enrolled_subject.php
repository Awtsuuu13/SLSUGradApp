<?php 
$title = "Enrolled Subject";
include '../includes/header.php'; 
include '../includes/connection.php';
session_start();
if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
      header("location:../index.php");
    }

     $username = $_SESSION['ACCOUNT_USERNAME'];

     if(isset($_GET['delete'])){
         $id = $_GET['delete'];
         $sql = "DELETE FROM `tbl_enrolled_subject` WHERE e_id = '$id'";
         if ($result = mysqli_query($db, $sql)) {
            $_SESSION['delete'] = "You deleted Successful!";
          
        }
     }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM `tbl_enrolled_subject` WHERE e_id = '$id'";
        $result = mysqli_query($db, $sql);
    
        mysqli_num_rows($result);
    
        while($row = mysqli_fetch_array($result)){
            $subject_code = $row['e_sub_id'];
            $prof_name = $row['e_prof'];
        }
    
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $subject_code = $_POST['subject'];
        $prof_name = $_POST['prof_name'];

        $sql = "UPDATE tbl_enrolled_subject SET e_sub_id='$subject_code', e_prof='$prof_name' WHERE e_id='$id'";
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
            <?php 
            if (isset($_SESSION['update'])) {
                echo "<div class='alert alert-success'>
                        ".$_SESSION['update']."
                      </div>";
                unset($_SESSION['update']);
                 }

            if (isset($_SESSION['delete'])) {
                echo "<div class='alert alert-success'>
                            ".$_SESSION['delete']."
                          </div>";
                unset($_SESSION['delete']);
                 }
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-success'>
                                ".$_SESSION['message']."
                              </div>";
                unset($_SESSION['message']);
                 }
            ?>
            <?php if (isset($_GET['id'])): ?>
            <?php include 'update_enrolled_subject.php'; ?>
            <?php else: ?>

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active">Enrolled Subject</li>
            </ol>

            <div class="col-lg-12">
                <div>
                    <a href="add_enrolled.php" id="add_enrolled" class="btn btn-success">Add Enrolled Subject</a>
                </div>
                <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%"
                    cellspacing="0">
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Description</th>
                        <th>Unit</th>
                        <th>Professor Name</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                    $username = $_SESSION['ACCOUNT_USERNAME'];
                    $sql = "SELECT * FROM `tbl_enrolled_subject` e, `subject` s WHERE e.e_std_id = '$username' AND e.e_sub_id = s.SUBJ_CODE";
                    $result = mysqli_query($db, $sql);

                    mysqli_num_rows($result);

                    while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['SUBJ_CODE'] ?></td>
                        <td><?php echo $row['SUBJ_DESCRIPTION'] ?></td>
                        <td><?php echo $row['UNIT'] ?></td>
                        <td><?php echo $row['e_prof'] ?></td>
                        <td>
                            <a href="enrolled_subject.php?id=<?php echo $row['e_id']?>" class="btn btn-info"><span
                                    style="color:white" class="fa fa-edit"></span></a>
                            <a href="enrolled_subject.php?delete=<?php echo $row['e_id']?>" class="btn btn-danger"><span style="color:white" class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php
                }

               ?>
                </table>

            </div>
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

<?php include '../includes/footer.php' ?>


<script>
$(document).ready(function() {
    $('.search-box input[type="text"]').on("keyup input", function() {
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("backend-search.php", {
                term: inputVal
            }).done(function(data) {
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function() {
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>