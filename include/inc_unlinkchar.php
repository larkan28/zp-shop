<?php

session_start();

if (!isset($_SESSION['userID'])) {
	header("Location: ../index.php");
	exit();
}

if (isset($_POST['unlinkacc-submit'])) {
	$nick = $_POST['in_nick'];
	
	if (empty($nick)) {
		header("Location: ../panel.php?page=link&error=nonick");
		exit();
	}
	
	require('../include/db_connect.php');
	
	// Verificamos que exista el personaje ingresado y no este en linea
	$sql = "SELECT IsOnline FROM " . $table_zp_accs . " WHERE Name=? AND IsOnline=0;";
	$stm = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stm, $sql)) {
		mysqli_close($conn);
		
		header("Location: ../panel.php?page=link&error=mysql");
		exit();
	}
	
	mysqli_stmt_bind_param($stm, "s", $nick);
	mysqli_stmt_execute($stm);
	
	mysqli_stmt_store_result($stm);
	$result = mysqli_stmt_num_rows($stm);
	
	if ($result < 1) {
		mysqli_stmt_close($stm);
		mysqli_close($conn);
		
		header("Location: ../panel.php?page=link&error=charonline");
		exit();
	}
	
	// Actualizamos la desvinculacion en la web
	$sql = "UPDATE " . $table_users . " SET Player='', Linked=0 WHERE Username=? AND ID=?;";
	$stm = mysqli_stmt_init($conn);
	
	// Actualizamos la desvinculacion en el zp
	$sql_zp = "UPDATE " . $table_zp_accs . " SET WUser='', WActive='0' WHERE Name=?;";
	$stm_zp = mysqli_stmt_init($conn);
		
	if (!mysqli_stmt_prepare($stm, $sql) || !mysqli_stmt_prepare($stm_zp, $sql_zp)) {
		mysqli_close($conn);
		
		header("Location: ../panel.php?page=link&error=mysql");
		exit();
	}
		
	// Ejecutamos el actualizar web
	mysqli_stmt_bind_param($stm, "ss", $_SESSION['userName'], $_SESSION['userID']);
	mysqli_stmt_execute($stm);
	
	// Ejecutamos el actualizar zp
	mysqli_stmt_bind_param($stm_zp, "s", $nick);
	mysqli_stmt_execute($stm_zp);
		
	if (mysqli_stmt_affected_rows($stm) > 0 && mysqli_stmt_affected_rows($stm_zp) > 0) {
		mysqli_stmt_close($stm_zp);
		mysqli_stmt_close($stm);
		
		mysqli_close($conn);
		
		header("Location: ../panel.php?page=link&unlink=true");
		exit();
	}
	
	mysqli_stmt_close($stm_zp);
	mysqli_stmt_close($stm);
	
	mysqli_close($conn);
	
	header("Location: ../panel.php?page=link&unlink=false");
	exit();
}
else {
	header("Location: ../panel.php?page=link");
	exit();
}

?>