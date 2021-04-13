<?php 
$title = "Enrolled Subject";
include '../includes/header.php'; 
include '../includes/connection.php';
session_start();
if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
      header("location:../index.php");
    }

     $username = $_SESSION['ACCOUNT_USERNAME'];

     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $subject_code = $_POST['subject'];
        $prof_name = $_POST['prof_name'];

        $sql = "INSERT INTO tbl_enrolled_subject (e_sub_id, e_std_id, e_prof) VALUES ('$subject_code', '$username', '$prof_name')";
        if(mysqli_query($db, $sql)){
            $_SESSION['message'] = "Subject added to enrolled subject";
            header("location:enrolled_subject.php");
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
            

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active">Add Enrolled Subject</li>
            </ol>

            <div class="card mb-3">

                <div id="card-header">
                    <h2 style="padding: 30px 0px 0px 20px">
                        Add Enrolled Subject</h2>
                    <img width="100px" src="../assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

                        <div class="form-group">
                            <div class="col-md-9">
                                <label class="col-md-4 control-label" for="DEPARTMENT_NAME"><strong>Subject
                                        Code:</strong></label>

                                <div class="col-md-9 search-box">
                    
                                    <input type="text" class="form-control input-sm" id="DEPARTMENT_NAME" name="subject"
                                        placeholder="Subject Code" type="text" autocomplete="off" required="">
                                        <div class="result"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9">
                                <label class="col-md-4 control-label" for="DEPARTMENT_NAME"><strong>
                                        Professor Name:</strong></label>

                                <div class="col-md-9">

                                    <input type="text" class="form-control input-sm" id="DEPARTMENT_NAME"
                                        name="prof_name" placeholder="Professor Name" type="text" value="" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9">
                                <div class="col-md-9">
                                    <button class="btn btn-primary" name="save" type="submit"><span style="color:white"
                                            class="fa fa-save fw-fa"></span> Save</button>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
              
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