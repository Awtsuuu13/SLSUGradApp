<?php

session_start();
// Include config file
require_once "../includes/connection.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$firstname_err = $lastname_err = $middlename_err = $email_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Prepare a select statement
        $sql = "SELECT ACCOUNT_ID FROM useraccounts WHERE ACCOUNT_USERNAME = ?";
        
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["student_no"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This student number is already taken.";
                } else{
                    $username = trim($_POST["student_no"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
 

        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $fullname =$_POST["fname"].' '.$_POST["lname"];
        $middlename = $_POST["mname"];
        $address = $_POST['address'];
        $bday = $_POST['bday'];
        $bplace = $_POST['bplace']; 
        $status = $_POST['status'];
        $religion = $_POST['religion'];
        $gender = $_POST['gender'];
        $nationality = $_POST['nationality'];
        $contact = $_POST['contact'];

        //age
        $date = $_POST['bday'];
        $today = date("m-d-Y");
        $diff = date_diff(date_create($date), date_create($today));
        $age = $diff->format('%y');

        //educational background
        $preliminary = $_POST['preliminary'];
        $year1 = $_POST['year1']; 
        $secondary = $_POST['secondary'];
        $year2 = $_POST['year2'];
        $tertiary = $_POST['tertiary'];
        $year3 = $_POST['year3'];
        $post_grad = $_POST['post_grad'];
        $year4 = $_POST['year4'];

        //Course and Department
        $department = $_POST['department'];
        $course = $_POST['course'];


        $guardian = $_POST['guardian'];


    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_pass"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_pass"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($firstname_err) && empty($lastname_err) && empty($middlename_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement for useraccounts
        $sql = "INSERT INTO useraccounts (ACCOUNT_NAME, ACCOUNT_USERNAME, ACCOUNT_PASSWORD, ACCOUNT_TYPE) VALUES (?, ?, ?, ?)";


         
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss",$param_name,  $param_username, $param_password, $param_type);
            
            // Set parameters
            $param_name =  ucwords($fullname);
            $param_username =$username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_type = 'Student';
            
            
            if(mysqli_stmt_execute($stmt)){

              $sql1 = "INSERT INTO `tblstudent`(`IDNO`, `FNAME`, `LNAME`, `MNAME`, `SEX`, `BDAY`, `BPLACE`, 
              `STATUS`, `AGE`, `NATIONALITY`, `RELIGION`, `CONTACT_NO`, `HOME_ADD`, `ACC_USERNAME`, `ACC_PASSWORD`, 
              `COURSE_ID`, `elem`, `elem_yer`, `hs`, `hs_yer`, `col`, `col_yer`, `post`, `post_yer`, 
              `guardian`) VALUES ('$username', '$firstname', '$lastname', '$middlename', '$gender', '$bday', 
              '$bplace', '$status', '$age', '$nationality', '$religion', '$contact', '$address', '$username', 
              '$param_password', '$course', '$preliminary', '$year1', '$secondary', '$year2', '$tertiary', 
              '$year3', '$post_grad', '$year4', '$guardian')";

              $result1 = mysqli_query($db, $sql1);

              $sql2 = "SELECT * FROM subject WHERE COURSE_ID = '$course'";
              $result2 = mysqli_query($db, $sql2);

              while($mysubject = mysqli_fetch_array($result2)){
                    $std_no = $username;
                    $subj_id = $mysubject['SUBJ_ID'];
                    $sem = $mysubject['SEMESTER'];

                   $sql3 = "INSERT INTO `grades`(`IDNO`, `SUBJ_ID`, `SEMS`) VALUES ('$std_no', '$subj_id', '$sem')";

                    if ($result3 = mysqli_query($db, $sql3)) {
                      $_SESSION['message'] = "You Registered Successfully";
                      header("location:../login.php");
                    }else{
                      $_SESSION['error'] = "You Registered error";
                      header("location:../login.php");
                    }
              }

              if ($result2 = mysqli_query($db, $sql2)) {
                $_SESSION['message'] = "You Registered Successfully";
                header("location:../login.php");
              }
       
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);

        } // end ofPrepare an insert statement for useraccounts



      }
        
}

?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>
<!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/main.css" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

body {
 background:url(../assets/img/1.jpg) repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

#regForm {
  background-color: #f8f8f8;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center; 
  color: #013220;
}

h2 {
  color: #003366;
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
h3 .login{
  margin-left: 20px;
  text-decoration: none;
}
</style>
<body>

<form id="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="row">
      <h3>Register</h3>
      <h3><a class="login" href="../index.php">Login</a></h3>
    </div>
	<h1>SLSU GRADUATION APPLICATION</h1>
    <!-- student_no  -->
  <!-- One "tab" for each step in the form: -->
  		<div class="tab">
  		  <h2>PERSONAL INFORMATION</h2>
	      <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="inputId" class="form-control" placeholder="Student Number" required="required" name="student_no">
                  <label for="inputId">Student Number / ID Number</label>
                  <span class="text-danger"><?php echo $username_err; ?></span>
                </div>
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-4 form-group">
                <div class="form-label-group">
                  <input type="text" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus" name="fname">
                  <label for="firstName">First name</label>
                </div>
              </div>

              <div class="col-sm-4 form-group">
                <div class="form-label-group">
                  <input type="text" id="lastname" class="form-control" placeholder="First name" required="required" autofocus="autofocus" name="lname">
                  <label for="lastname">Last name</label>
                </div>
              </div>

              <div class="col-sm-4 form-group">
                <div class="form-label-group">
                  <input type="text" id="middlename" class="form-control" placeholder="First name" required="required" autofocus="autofocus" name="mname">
                  <label for="middlename">Middle name</label>
                </div>
              </div>
            </div>
          </div>
      
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="password">
                  <label for="inputPassword">Password</label>
                  <span class="text-danger"><?php echo $password_err; ?></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required" name="confirm_pass">
                  <label for="confirmPassword">Confirm password</label>
                  <span class="text-danger"><?php echo $confirm_password_err; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="address" class="form-control" placeholder="Address" required="required" name="address">
              <label for="address">Address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="BDAY" class="form-control" placeholder="Birthdate" required="required" name="bday">
                  <label for="BDAY">Birthdate</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="BPLACE" class="form-control" placeholder="Place of Birth" required="required" name="bplace">
                  <label for="BPLACE">Place of Birth</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-3 form-group">
                <div class="form-label-group">
                  <select ctype="text" name="status" required oninput="setCustomValidity('')" oninvalid="setCustomValidity('Must pick status.')" class="form-control">
                    <option disabled="disabled" selected="selected">Select Status</option>
                    <option value="Single">Single</option>
                    <option value="Maried">Maried</option>
                    <option value="Widow">Widow</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-3 form-group">
                <div class="form-label-group">
                  <input type="text" id="religion" class="form-control" placeholder="Religion" required="required" autofocus="autofocus" name="religion">
                  <label for="religion">Religion</label>
                </div>
              </div>

              <div class="col-sm-3 form-group">
                <div class="form-label-group">
                  <select class="form-control" required="required" autofocus="autofocus" name="gender">
                    <option disabled="disabled" selected="selected">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-3 form-group">
                <div class="form-label-group">
                  <input type="text" id="nationality" class="form-control" placeholder="Nationality" required="required" autofocus="autofocus" name="nationality">
                  <label for="nationality">Nationality</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-4 form-group">
                <div class="form-label-group">
                  <input type="text" id="contact" class="form-control" placeholder="Contact Number" required="required" autofocus="autofocus" name="contact">
                  <label for="contact">Contact Number</label>
                </div>
              </div>

              <div class="col-sm-8 form-group">
                <div class="form-label-group">
                  <input type="text" id="guardian" class="form-control" placeholder="Guardian/Parent" required="required" autofocus="autofocus" name="guardian">
                  <label for="guardian">Guardian/Parent</label>
                </div>
              </div>
            </div>
          </div>
       </div>

    <div class="tab">
      <h2>EDUCATIONAL BACKGROUND</h2>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="PRELIMINARY" class="form-control" placeholder="PRELIMINARY" required="required" name="preliminary">
                  <label for="PRELIMINARY">PRELIMINARY</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="Year1" class="form-control" placeholder="Year Graduated" required="required" name="year1">
                  <label for="Year1">Year Graduated</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="SECONDARY" class="form-control" placeholder="SECONDARY" required="required" name="secondary">
                  <label for="SECONDARY">SECONDARY</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="Year2" class="form-control" placeholder="Year Graduated" required="required" name="year2">
                  <label for="Year2">Year Graduated</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="TERTIARY" class="form-control" placeholder="TERTIARY" required="required" name="tertiary">
                  <label for="TERTIARY">TERTIARY</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="Year3" class="form-control" placeholder="Year Graduated" required="required" name="year3">
                  <label for="Year3">Year Graduated</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="POSTGRADUATE" class="form-control" placeholder="POSTGRADUATE" required="required" value="..." name="post_grad">
                  <label for="POSTGRADUATE">POST GRADUATE</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="Year4" class="form-control" placeholder="Year Graduated" required="required" value="..." name="year4">
                  <label for="Year4">Year Graduated</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <select required="required" autofocus="autofocus" class="form-control" name="department">
                    <option disabled="disabled" selected="selected">Select Department</option>
                    <?php 

                        $mydepartment = "SELECT * FROM department";
                        $result = mysqli_query($db, $mydepartment);

                        mysqli_num_rows($result);

                        while($row = $result->fetch_assoc()){
                         ?>
                          <option value="<?php echo $row['DEPT_ID'] ?>"><?php echo $row['DEPARTMENT_NAME'].' ('.$row['DEPARTMENT_DESC'].')'?></option>
                         <?php
                        }

                     ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select required="required" autofocus="autofocus" class="form-control" name="course">
                    <option disabled="disabled" selected="selected">Select Course</option>
                      
                  </select>
                </div>
              </div>
            </div>
          </div>
    </div>
 		
 		
 		<div class="tab">
 			<br>
 			<h2>VERIFY all the details if it is correct and accurate before submitting this form.</h2>
 		</div>

   <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>


</form>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script>
$( "select[name='department']" ).change(function () {
    var stateID = $(this).val();


    if(stateID) {


        $.ajax({
            url: "ajaxpro.php",
            dataType: 'Json',
            data: {'DEPT_ID':stateID},
            success: function(data) {
                $('select[name="course"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="course"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });


    }else{
        $('select[name="course"]').empty();
    }
});
</script>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

</body>
</html>
