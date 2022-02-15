<?php

if (isset($_POST['login-submit'])) {
	$username = $_POST['user'];
	$password = $_POST['pass'];
	
	if (empty($username) || empty($password)) {
		header("Location: ../login.php?error=emptyfields");
		exit();
	}
	else {
		require('../include/db_connect.php');
		
		$sql = "SELECT * FROM " . $table_users . " WHERE Username=?;";
		$stm = mysqli_stmt_init($conn);
		
		if (!mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../login.php?error=mysql");
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
					
					header("Location: ../login.php?error=wrongpass");
					exit();
				}
				
				session_start();
				
				$_SESSION['userID'] = $row['ID'];
				$_SESSION['userName'] = $row['Username'];
				
				mysqli_stmt_close($stm);
				mysqli_close($conn);
				
				header("Location: ../login.php");
				exit();
			}
			else {
				mysqli_stmt_close($stm);
				mysqli_close($conn);
				
				header("Location: ../login.php?error=wronguser");
				exit();
			}
		}
		
		mysqli_stmt_close($stm);
		mysqli_close($conn);
	}
}
else {
	header("Location: ../login.php");
	exit();
}

?>