<?php

if (isset($_SESSION['userAdmin'])) {
	header("Location: ../panel.php");
	exit();
}

if (isset($_POST['admlogin-submit'])) {
	$username = $_POST['adm_user'];
	$password = $_POST['adm_pass'];
	
	if (empty($username) || empty($password)) {
		header("Location: ../index.php?error=emptyfields");
		exit();
	}
	else {
		require('../../include/db_connect.php');
		
		$sql = "SELECT * FROM " . $table_admins . " WHERE Username=?;";
		$stm = mysqli_stmt_init($conn);
		
		if (!mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../index.php?error=mysql");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stm, "s", $username);
			mysqli_stmt_execute($stm);
	
			$result = mysqli_stmt_get_result($stm);
			
			if ($row = mysqli_fetch_assoc($result)) {
				$passCheck = password_verify($password, $row['Password']);
				
				if ($passCheck == false) {
					mysqli_stmt_close($stm);
					mysqli_close($conn);
				
					header("Location: ../index.php?error=wrongaccount");
					exit();
				}
				
				session_start();
				$_SESSION['userAdmin'] = $username;
				
				mysqli_stmt_close($stm);
				mysqli_close($conn);
				
				header("Location: ../panel.php");
				exit();
			}
			else {
				mysqli_stmt_close($stm);
				mysqli_close($conn);
		
				header("Location: ../index.php?error=wrongaccount");
				exit();
			}
		}
		
		mysqli_stmt_close($stm);
		mysqli_close($conn);
	}
}
else {
	header("Location: ../index.php");
	exit();
}

?>