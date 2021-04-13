<?php
include '../includes/connection.php';
session_start();

if (!isset($_SESSION['ACCOUNT_USERNAME'])) {
       header("location:../index.php");
     }

if (isset($_POST['insert'])) {
	$IDNO = $_SESSION['ACCOUNT_USERNAME'];
	$grade_id = $_GET['grade_id'];
	$grade = $_POST['grade'];

	if($grade <= 3 ){
		$sql = "UPDATE grades SET AVE='$grade', REMARKS='Passed' WHERE SUBJ_ID = '$grade_id' AND IDNO = '$IDNO'";
		if (mysqli_query($db, $sql)) {
			$_SESSION['success'] = "Inserted Successful!";
	   		 header('Location: index.php');
		}
	}elseif($grade <= 5){
		$sql = "UPDATE grades SET AVE='$grade', REMARKS='Failed' WHERE SUBJ_ID = '$grade_id' AND IDNO = '$IDNO'";
		if (mysqli_query($db, $sql)) {
			$_SESSION['success'] = "Inserted Successful!";
	   		 header('Location: index.php');
		}
	}elseif($grade > 5 || $grade = 0){
			$_SESSION['error'] = "Wrong Input. Please! Try Again.";
	   		 header('Location: index.php');
	}
}


 ?>