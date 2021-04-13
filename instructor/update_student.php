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

if(!isset($_GET['id'])){
    header("location:student.php");
}



    $id = $_GET['id'];
    $sql = "SELECT * FROM tblstudent s, course c WHERE s.IDNO = '$id' AND s.COURSE_ID = c.COURSE_ID";
    $res = mysqli_query($db, $sql);

    while($row = mysqli_fetch_array($res)){
        $student_name = $row['FNAME'] ." ".$row['LNAME'];
        $course = $row['COURSE_NAME'] ." | ". $row['COURSE_DESC'];

    $id = $row['IDNO'];
    $fname = $row['FNAME'];
    $lname = $row['LNAME'];
    $mname = $row['MNAME'];
    $address = $row['HOME_ADD'];
    $gender = $row['SEX'];
    $bday = $row['BDAY'];
    $bplace = $row['BPLACE'];
    $status = $row['STATUS'];
    $contact = $row['CONTACT_NO'];
    $religion = $row['RELIGION'];
    $nationality = $row['NATIONALITY'];
    $guardian = $row['guardian'];
    $guardian_contact = $row['guardian_contact'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
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

        $sql = "UPDATE tblstudent SET FNAME='$FNAME', LNAME='$LNAME', MNAME='$MI', SEX='$GENDER', HOME_ADD = '$PADDRESS', BDAY = '$BIRTHDATE', BPLACE = '$BIRTHPLACE', NATIONALITY = '$NATIONALITY', RELIGION = '$RELIGION', CONTACT_NO = '$CONTACT', `STATUS` = '$CIVILSTATUS', guardian = '$GUARDIAN', guardian_contact = '$GCONTACT' WHERE IDNO = '$id'";
        if ($result = mysqli_query($db, $sql)) {
            
            $update_user = "UPDATE useraccounts SET ACCOUNT_NAME='$FULLNAME' WHERE ACCOUNT_USERNAME = '$id'";

            if ($result = mysqli_query($db, $update_user)) {
                $_SESSION['update'] = "You Updated Successful!";
                header("location:student.php");
            }
           
        }

    }
?>

<style>
    .error {border: 1px red solid;}
</style>
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

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Update Student</li>
            </ol>


            <div class="student_details">
                <div class="col-sm-3">
                    <div class="panel">
                        <ul class="list-group">
                            <li class="list-group-items text-right">
                                <span class="pull-left"><strong>Name:</strong></span>
                                <?php echo $student_name ; ?>
                            </li>
                            <li class="list-group-items text-right">
                                <span class="pull-left"><strong>Course:</strong></span>
                                <?php echo $course ; ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <h2>Student Information</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?php echo $id ; ?>"
                        method="POST" onsubmit="return checkforblank()">
                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Student ID:</label>
                                        <input class="form-control input-md " readonly="" name="IDNO"
                                            placeholder="Student Id" type="text" value="<?php echo $id ; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label id="label" class="text-right"> First Name:</label>
                                        <input class="form-control input-md" name="fname" placeholder="First Name"
                                            type="text" value="<?php echo $fname ; ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Last Name:</label>
                                        <input class="form-control input-md" name="lname" placeholder="Last Name"
                                            type="text" value="<?php echo $lname ; ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Middle Name:</label>
                                        <input class="form-control input-md" name="mname" placeholder="Middle Name"
                                            type="text" value="<?php echo $mname ; ?>">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label id="label" class="text-right"> Address:</label>
                                        <input class="form-control input-md" name="address" placeholder="Address"
                                            type="text" value="<?php echo $address ; ?>">
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label id="label" class="text-right"> Gender:</label>
                                        <select type="text" name="gender" onchange="checkforblank()"
                                            class="form-control" id="gender">
                                            <option value="Please Select">
                                                Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Date of Birth:</label>
                                        <input class="form-control input-md" name="bday" placeholder="" type="date"
                                            value="<?php echo $bday ; ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right"> Contact Number:</label>
                                        <input class="form-control input-md" name="contact" placeholder="Contact Number"
                                            type="text" value="<?php echo $contact ; ?>">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label id="label" class="text-right"> Place of Birth:</label>
                                        <input class="form-control input-md" name="bplace" placeholder="Place of Birth"
                                            type="text" value="<?php echo $bplace ; ?>">
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label id="label" class="text-right"> Nationality:</label>
                                        <input class="form-control input-md" name="nationality"
                                            placeholder="Nationality" type="text" value="<?php echo $nationality ; ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Religion:</label>
                                        <input class="form-control input-md" name="religion" placeholder="Religion"
                                            type="text" value="<?php echo $religion ; ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Civil Status:</label>
                                        <select class="form-control" onchange="checkforblank()" name="civilstatus"
                                            id="status">
                                            <option value="Please Select">Select Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow">Widow</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label id="label" class="text-right"> Guardian Name:</label>
                                        <input class="form-control input-md" name="guardian" placeholder="Guardian Name"
                                            type="text" value="<?php echo $guardian ; ?>">
                                    </div>

                                    <div class="col-md-6">
                                        <label id="label" class="text-right">Contact No. of Guardian:</label>
                                        <input class="form-control input-md" name="contact_guardian"
                                            placeholder="Contact No. of Guardian" type="text"
                                            value="<?php echo $guardian_contact ; ?>">
                                    </div>

                                </div>
                            </div>


                        </div>

                        <br>
                        <div class="form-student1">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-success btn-lg" value="Save">
                                        <a href="student.php" class="btn btn-danger btn-lg">Cancel</a>
                                    </div>


                                </div>
                            </div>


                        </div>
                    </form>

                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->
</div>

<?php include "../includes/footer.php" ; ?>

<script>
function checkforblank() {

    var location = document.getElementById('gender');

    var status = document.getElementById('status');

    var invalid = location.value == "Please Select";

    var invalid1 = status.value == "Please Select";

    if (invalid) {
        alert('Please select gender.');
        location.className = 'form-control error';
    } else if (invalid1) {
        alert('Please select status.');
        status.className = 'form-control error';
    } else {
        location.className = 'form-control';
        status.className = 'form-control';
    }

    return !invalid;
    return !invalid1;

}
</script>

</script>