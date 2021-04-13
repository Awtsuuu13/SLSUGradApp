<?php 
session_start();
include 'includes/connection.php';


if(isset($_SESSION['ACCOUNT_USERNAME'])){
  if ($_SESSION['ACCOUNT_TYPE'] == 'Student') {
    header("location:student/index.php");
  }elseif ($_SESSION['ACCOUNT_TYPE'] == 'Administrator') {
    header("location:admin/index.php");
  }else{
    header("location:instructor/index.php");
  }
}

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";
 
  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
   
      // Check if username is empty
      if(empty(trim($_POST["student_no"]))){
          $email_err = "Please enter student number.";
      } else{
          $email = trim($_POST["student_no"]);
      }
      
      // Check if password is empty
      if(empty(trim($_POST["password"]))){
          $password_err = "Please enter your password.";
      } else{
          $password = trim($_POST["password"]);
      }
      
      // Validate credentials
      if(empty($email_err) && empty($password_err)){
          // Prepare a select statement
          $sql = "SELECT ACCOUNT_ID, ACCOUNT_NAME, ACCOUNT_USERNAME, ACCOUNT_TYPE, ACCOUNT_PASSWORD FROM useraccounts WHERE ACCOUNT_USERNAME = ?";
          
          if($stmt = mysqli_prepare($db, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "s", $param_username);
              
              // Set parameters
              $param_username = $email;
              
              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  // Store result
                  mysqli_stmt_store_result($stmt);
                  
                  // Check if username exists, if yes then verify password
                  if(mysqli_stmt_num_rows($stmt) == 1){                    
                      // Bind result variables
                      mysqli_stmt_bind_result($stmt, $id, $name, $username, $role, $hashed_password);
                      if(mysqli_stmt_fetch($stmt)){
                          if(password_verify($password, $hashed_password)){
                              // Password is correct, so start a new session
                             
                              
                              // Store data in session variables
                              $_SESSION["loggedin"] = true;
                              $_SESSION["ACCOUNT_ID"] = $id;
                              $_SESSION["ACCOUNT_NAME"] = $name;
                              $_SESSION["ACCOUNT_USERNAME"] = $username;
                              $_SESSION['ACCOUNT_TYPE'] = $role;
                            if($_SESSION['ACCOUNT_TYPE'] == 'Administrator'){
                            	header('location:admin/index.php');
                            }elseif($_SESSION['ACCOUNT_TYPE'] == 'Instructor'){
                            	header('location:instructor/index.php');
                            }else{
                              header('location:student/index.php');
                            }

                          } else{
                              // Display an error message if password is not valid
                              $password_err = "The password you entered was not valid.";
                          }
                      }
                  } else{
                      // Display an error message if username doesn't exist
                      $email_err = "No account found with that student number.";
                  }
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }

              // Close statement
              mysqli_stmt_close($stmt);
          }
      }
      
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">

</head>

<style>
	body {
  background:url(assets/img/1.jpg) repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

</style>
<body>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <?php if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-info'><h5 align='center'>
                    ".$_SESSION['message']."</h5>
                  </div>";
            unset($_SESSION['message']);
             }if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-success'>
                    ".$_SESSION['error']."
                  </div>";
            unset($_SESSION['error']);
             } ?>
      <div class="card-header"><img src="assets/img/logo.png" class="center"></div>
      <div class="card-body">
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Student Number</label>
                <input type="text" name="student_no" class="form-control" value="<?php echo $email; ?>">
                <span class="text-danger"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="text-danger"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
            
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="student/register.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
