<?php

session_start();

if (!isset($_SESSION['userID'])) {
	header("Location: ../index.php");
	exit();
}

if (isset($_POST['saveuser-submit'])) {
	$fname = $_POST['in_fname'];
	$lname = $_POST['in_lname'];
	$email = $_POST['in_mail'];
	$newpass = $_POST['in_newpass'];
	$renewpass = $_POST['in_renewpass'];
	
	if (empty($fname) || empty($lname) || empty($email)) {
		header("Location: ../panel.php?page=info&error=emptyfields");
		exit();
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../panel.php?page=info&error=invalidmail");
		exit();
	}
	elseif (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
		header("Location: ../panel.php?page=info&error=invalidname");
		exit();
	}
	
	// Si cambio la contraseña...
	if (!empty($newpass)) {
		if (empty($renewpass) || $newpass !== $renewpass) {
			header("Location: ../panel.php?page=info&error=passmatch");
			exit();
		}
		
		require('../include/db_connect.php');
		
		// Actualizamos los datos personales y la contraseña de la cuenta
		$sql = "UPDATE " . $table_users . " SET FName=?, LName=?, Email=?, Password=? WHERE ID=?;";
		$stm = mysqli_stmt_init($conn);
	
		if (!mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=info&error=mysql");
			exit();
		}
		
		$hashPassword = password_hash($newpass, PASSWORD_DEFAULT);
		
		// Ejecutamos el actualizar
		mysqli_stmt_bind_param($stm, "sssss", $fname, $lname, $email, $hashPassword, $_SESSION['userID']);
		mysqli_stmt_execute($stm);
		
		if (mysqli_stmt_affected_rows($stm) > 0) {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=info&save=true");
			exit();
		}
		else {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=info&save=false");
			exit();
		}
	}
	else {
		$real_fname = $_POST['inh_fname'];
		$real_lname = $_POST['inh_lname'];
		$real_email = $_POST['inh_email'];
		
		if ($real_fname == $fname && $real_lname == $lname && $real_email == $email) {
			header("Location: ../panel.php?page=info&error=nochanges");
			exit();
		}
		
		require('../include/db_connect.php');
	
		// Actualizamos los datos personales de la cuenta
		$sql = "UPDATE " . $table_users . " SET FName=?, LName=?, Email=? WHERE ID=?;";
		$stm = mysqli_stmt_init($conn);
	
		if (!mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=info&error=mysql");
			exit();
		}
	
		// Ejecutamos el actualizar
		mysqli_stmt_bind_param($stm, "ssss", $fname, $lname, $email, $_SESSION['userID']);
		mysqli_stmt_execute($stm);
		
		if (mysqli_stmt_affected_rows($stm) > 0) {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=info&save=true");
			exit();
		}
		else {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=info&save=false" . $conn -> error);
			exit();
		}
	}
	
	mysqli_stmt_close($stm);
	mysqli_close($conn);
}
else {
	header("Location: ../panel.php");
	exit();
}

?>