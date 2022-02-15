<?php  

if (isset($_POST['singup-submit'])) {
	$username = $_POST['in_user'];
	$password = $_POST['in_pass'];
	$repass = $_POST['in_re-pass'];
	$email = $_POST['in_mail'];
	$fname = $_POST['in_fname'];
	$lname = $_POST['in_lname'];
	
	if (empty($username) || empty($email) || empty($repass) || empty($password) || empty($fname) || empty($lname)) {
		header("Location: ../singup.php?error=emptyfields");
		exit();
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../singup.php?error=invalidmail");
		exit();
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../singup.php?error=invaliduser");
		exit();
	}
	elseif (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
		header("Location: ../singup.php?error=invalidname");
		exit();
	}
	elseif ($password !== $repass) {
		header("Location: ../singup.php?error=passmatch");
		exit();
	}
	elseif (!isset($_POST['in_terms'])) {
		header("Location: ../singup.php?error=noterms");
		exit();
	}
	
	require('../include/db_connect.php');
	
	if (check_data($conn, $table_users, "Username", $username) > 0) {
		mysqli_close($conn);
		
		header("Location: ../singup.php?error=usertaken");
		exit();
	}
	
	if (check_data($conn, $table_users, "Email", $email) > 0) {
		mysqli_close($conn);
		
		header("Location: ../singup.php?error=mailtaken");
		exit();
	}
		
	$sql = "INSERT INTO " . $table_users . " (Username, Password, Email, FName, LName) VALUES (?, ?, ?, ?, ?);";
	$stm = mysqli_stmt_init($conn);
		
	if (!mysqli_stmt_prepare($stm, $sql)) {
		mysqli_close($conn);
		
		header("Location: ../singup.php?error=mysql");
		exit();
	}
	else {
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
			
		mysqli_stmt_bind_param($stm, "sssss", $username, $hashPassword, $email, $fname, $lname);
		mysqli_stmt_execute($stm);
		
		mysqli_stmt_close($stm);
		mysqli_close($conn);
			
		header("Location: ../singup.php?success=true");
		exit();
	}
	
	mysqli_stmt_close($stm);
	mysqli_close($conn);
}
else {
	header("Location: ../singup.php");
	exit();
}

function check_data ($conn, $table, $key, $value) {
	$sql = "SELECT " . $key . " FROM " . $table . " WHERE " . $key . "=?;";
	$stm = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stm, $sql)) {
		header("Location: ../singup.php?error=mysql");
		exit();
	}
	
	mysqli_stmt_bind_param($stm, "s", $value);
	mysqli_stmt_execute($stm);
	
	mysqli_stmt_store_result($stm);
	$result = mysqli_stmt_num_rows($stm);
	
	mysqli_stmt_close($stm);
	return $result;
}

?>