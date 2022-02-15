<?php

session_start();

if (!isset($_SESSION['userID'])) {
	header("Location: ../index.php");
	exit();
}

if (isset($_POST['linkacc-submit'])) {
	$nick = $_POST['in_nick'];
	
	if (empty($nick)) {
		header("Location: ../panel.php?page=link&error=emptyfields");
		exit();
	}
	
	require('../include/db_connect.php');
	
	// Verificamos que exista el personaje ingresado y no este linkeado
	$sql = "SELECT IsOnline FROM " . $table_zp_accs . " WHERE Name=? AND WActive=0;";
	$stm = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stm, $sql)) {
		mysqli_close($conn);
		
		header("Location: ../panel.php?page=link&error=mysql");
		exit();
	}
	
	mysqli_stmt_bind_param($stm, "s", $nick);
	mysqli_stmt_execute($stm);
	
	$result = mysqli_stmt_get_result($stm);
			
	if ($row = mysqli_fetch_assoc($result)) {
		if ($row['IsOnline'] != 0) {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=link&error=charonline");
			exit();
		}
		
		// Actualizar personaje en el zp
		$sql_zp = "UPDATE " . $table_zp_accs . " SET WUser=?, WActive=0 WHERE Name=?;";
		$stm_zp = mysqli_stmt_init($conn);
		
		// Actualizar cuenta en la web
		$sql = "UPDATE " . $table_users . " SET Player=?, Linked=0 WHERE Username=?;";
		$stm = mysqli_stmt_init($conn);
			
		if (!mysqli_stmt_prepare($stm_zp, $sql_zp) || !mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=link&error=mysql");
			exit();
		}
			
		$username = $_SESSION['userName'];
			
		// Ejectuar actualizar zp
		mysqli_stmt_bind_param($stm_zp, "ss", $username, $nick);
		mysqli_stmt_execute($stm_zp);
		
		// Ejectura actualizar web
		mysqli_stmt_bind_param($stm, "ss", $nick, $username);
		mysqli_stmt_execute($stm);
			
		if (mysqli_stmt_affected_rows($stm_zp) > 0 && mysqli_stmt_affected_rows($stm) > 0) {
			mysqli_stmt_close($stm_zp);
			mysqli_stmt_close($stm);
			
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=link");
			exit();
		}
		else {
			mysqli_stmt_close($stm_zp);
			mysqli_stmt_close($stm);
			
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=link&error=errorlink");
			exit();
		}
	}
	else {
		mysqli_stmt_close($stm);
		mysqli_close($conn);
			
		header("Location: ../panel.php?page=link&error=charinvalid");
		exit();
	}

	mysqli_stmt_close($stm);
	mysqli_close($conn);
}
else {
	header("Location: ../panel.php?page=link");
	exit();
}

?>