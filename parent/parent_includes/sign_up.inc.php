<?php
if (isset($_POST['signup'])) {
	
	require "../../includes/db.inc.php";

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$phoneNumber = $_POST['phoneNumber'];
	$pwd = $_POST['pwd'];
	$pwd2 = $_POST['pwd2'];

// form validation

	if (!filter_var($email,FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/",$firstName)&&!preg_match("/^[a-zA-Z0-9]*$/",$lastName)) {
		header("Location:../sign_up.php? error=Invalid Fields");
	    exit();
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/",$firstName)) {
		header("Location:../sign_up.php? error=Invalid firstName");
	    exit();
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/",$lastName)) {
		header("Location:../sign_up.php? error=Invalid lastName");
	    exit();
	}
	elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		header("Location:../sign_up.php? error=Invalid Email");
	    exit();
	}
	elseif ($pwd !== $pwd2) {
		header("Location:../sign_up.php? error=Wrong password");
	    exit();
	}
	else{

		// checking if phone number already exist in database

		$sql1 = "SELECT phoneNumber FROM parents WHERE phoneNumber = ?";
		$stmtt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmtt,$sql1)) {
			header("Location:../sign_up.php?error=wrong phoneNumber");
		    exit();
		}
		else{
			mysqli_stmt_bind_param($stmtt,"s",$phoneNumber);
			mysqli_execute($stmtt);
			mysqli_stmt_store_result($stmtt);
			$resultcheck = mysqli_stmt_num_rows($stmtt);

				if ($resultcheck > 0) {
				header("Location:../sign_up.php?error=PhoneNumber already exist");
		        exit();
			}
			else{

				// inserting user into database
				
				$sql = "INSERT INTO parents (firstName,lastName,email,phoneNumber,password) VALUES (?,?,?,?,?)";
				$stmt = mysqli_stmt_init($conn);
				 if (!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location:../sign_up.php?error=sql error");
				    exit();
				}
					else{
					$hashedpassword = password_hash($pwd, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt,"sssss",$firstName,$lastName,$email,$phoneNumber,$hashedpassword);
					mysqli_stmt_execute($stmt);
					header("Location:../sign_up.php?signup=SignUp Successful");
		            exit();
				}
			}
		}

		
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else{
	header("Location:../sign_up.php");
    exit();
}