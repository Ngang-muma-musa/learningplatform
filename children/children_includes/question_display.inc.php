<?php
session_start();
require "../../includes/db.inc.php";
 $id = $_SESSION['id'];
 $type = $_SESSION['type'];
 $question_id = $_SESSION['question_id']; 
 $question_content_id = $_SESSION['question_content_id'];
 $timestamp_id = $_SESSION['timestamp_id'];

if (isset($question_id)&&isset($question_content_id)) {
 	
 	if (isset($_POST['submit_ans'])) {

 		if ($type == "TEXT" || $type == "YOUTUBE") {
 			$answer = $_POST['answer'];
       // first of all check if child has already answerd

        $sqll = "SELECT * FROM answer WHERE  id = '$id'";
        $resullt = mysqli_query($conn,$sqll);
         if(mysqli_num_rows($resullt)==1){
           $sql4 = "UPDATE answer set answer = '$answer' WHERE id = '$id '";
           $result4 = mysqli_query($conn,$sql4);
	        }
	        else{
	        	$sql = "INSERT INTO answer (id,question_id,answer) VALUES(?,?,?)";
	        	  $stmt = mysqli_stmt_init($conn);
	        if (!mysqli_stmt_prepare($stmt,$sql)) {
	        	header("Location:../question_display.php?Error=please try again answer was not submitted succesfully");
	        	exit();
	        }
	        else{
	        	mysqli_stmt_bind_param($stmt,"ssss",$id,$question_id,$answer);
				mysqli_stmt_execute($stmt);
	        }

	        $sql2 = "UPDATE question_content set status = 'ANSWERED' WHERE id = '$id'";
            $result2 = mysqli_query($conn,$sql2);
        }
            $sql3 ="SELECT * FROM question_content WHERE status = 'UNANSWERED' AND question_id = '$question_content_id'";
            $result3 = mysqli_query($conn,$sql3);

	        if(mysqli_num_rows($result3)==0){
	           $sql4 = "UPDATE questions set status = 'ANSWERED' WHERE question_id = '$timestamp_id '";
	           $result4 = mysqli_query($conn,$sql4);
	        }
       

        header("Location:../question_display.php?succes=Answer was submitted succesfully");
        exit();
 		}
 		elseif($type == "IMAGE" || $type == "VIDEO"){


        $answer = $_POST['answer'];
        $Id = $_POST['id'];

        // first of all check if child has already answerd

        $sqll = "SELECT * FROM answer WHERE  id = '$Id'";
        $resullt = mysqli_query($conn,$sqll);
         if(mysqli_num_rows($resullt)==1){
           $sql4 = "UPDATE answer set answer = '$answer' WHERE id = '$Id' ";
           $result4 = mysqli_query($conn,$sql4);
	        }
	        else{
	        	$sql = "INSERT INTO answer (id,question_id,answer) VALUES(?,?,?)";
	        	  $stmt = mysqli_stmt_init($conn);
	        if (!mysqli_stmt_prepare($stmt,$sql)) {
	        	header("Location:../question_display.php?Error=please try again answer was not submitted succesfully");
	        	exit();
	        }
	        else{
	        	mysqli_stmt_bind_param($stmt,"sss",$Id,$question_id,$answer);
				mysqli_stmt_execute($stmt);
	        }

	        $sql2 = "UPDATE question_content set status = 'ANSWERED' WHERE id = '$Id'";
            $result2 = mysqli_query($conn,$sql2);
        }
            $sql3 ="SELECT * FROM question_content WHERE status = 'UNANSWERED' AND question_id = '$question_content_id'";
            $result3 = mysqli_query($conn,$sql3);

	        if(mysqli_num_rows($result3)==0){
	           $sql4 = "UPDATE questions set status = 'ANSWERED' WHERE question_id = '$timestamp_id '";
	           $result4 = mysqli_query($conn,$sql4);
	        }
        header("Location:../question_display.php?succes=Answer was submitted succesfully");
        exit();
 		}
 	}
 } 