<?php
session_start();

if (!isset($_SESSION['userAdmin'])) {
	header("Location: ../admincp/index.php");
	exit();
}

if (isset($_POST['admdel-submit'])) {
	require('../../include/db_connect.php');
	$prod_id = $_POST['id_prod'];
	
	// Actualizamos el producto para que sea activable
	$sql = "DELETE FROM " . $table_buyeds . " WHERE ID=?;";
	$stm = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stm, $sql)) {
		mysqli_close($conn);
		
		header("Location: ../panel.php?error=mysql");
		exit();
	}
			
	// Ejecutar actualizar
	mysqli_stmt_bind_param($stm, "s", $prod_id);
	mysqli_stmt_execute($stm);
			
	if (mysqli_stmt_affected_rows($stm) > 0) {
		mysqli_stmt_close($stm);
		mysqli_close($conn);
		
		header("Location: ../panel.php?delete=success");
		exit();
	}
	else {
		mysqli_stmt_close($stm);
		mysqli_close($conn);
		
		header("Location: ../panel.php?delete=fail");
		exit();
	}
	
	mysqli_stmt_close($stm);
	mysqli_close($conn);
}
else {
	header("Location: ../index.php");
	exit();
}

?>