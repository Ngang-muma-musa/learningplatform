
<?php
require "../includes/db.inc.php";
session_start();
 $email =  $_SESSION['email'];
$phoneNumber =  $_SESSION['phoneNumber'];
if (!isset($email)&&!isset($phoneNumber)) {
	header("Location:index.php");
	exit();
}
else {
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Parent</title>
</head>
<body>
	<form method="post" action="parent_includes/logout.inc.php">
		<button type="submit" name="logout">Logout</button>
	</form>
<?php
$sql = "SELECT * FROM parents WHERE email = '$email'";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($result)) {
	$firstName = $row['firstName'];
	$lastName = $row['lastName'];
}
?>
<a href="question_upload.php">Question_upload</a><br>
<a href="lesson_upload.php">lesson_upload</a><br>
<a href="results.php">view results</a>
</body>
</html>


<?php
}
?>

