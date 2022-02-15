<?php
session_start();

if (!isset($_SESSION['userID'])) {
	header("Location: ../index.php");
	exit();
}

if (isset($_POST['active-submit'])) {
	require('../include/db_connect.php');
	
	// Chequear vinculacion de cuenta
	$sql = "SELECT Player FROM " . $table_users . " WHERE ID=? AND Linked=1;";
	$stm = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stm, $sql)) {
		mysqli_close($conn);
		
		header("Location: ../panel.php?page=cart&error=mysql");
		exit();
	}
	
	mysqli_stmt_bind_param($stm, "s", $_SESSION['userID']);
	mysqli_stmt_execute($stm);
	
	$result = mysqli_stmt_get_result($stm);
			
	if ($row = mysqli_fetch_assoc($result)) {
		$player = $row['Player'];
		
		if (empty($player)) {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=cart&error=notlinked");
			exit();
		}
		
		// Verificamos que exista el personaje ingresado y no este en linea
		$sql = "SELECT IsOnline FROM " . $table_zp_accs . " WHERE Name=? AND IsOnline=0;";
		$stm = mysqli_stmt_init($conn);
		
		if (!mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=link&error=mysql");
			exit();
		}
		
		mysqli_stmt_bind_param($stm, "s", $player);
		mysqli_stmt_execute($stm);
		
		mysqli_stmt_store_result($stm);
		$result = mysqli_stmt_num_rows($stm);
		
		if ($result < 1) {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=cart&error=invalidchar");
			exit();
		}
		
		// Chequear compra valida/Existe el producto comprado
		$buy_id = $_POST['buy_id'];
	
		$sql = "SELECT Prod_Code, Buy_Date FROM " . $table_buyeds . " WHERE ID=?;";
		$stm = mysqli_stmt_init($conn);
		
		if (!mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=cart&error=mysql");
			exit();
		}
		
		mysqli_stmt_bind_param($stm, "s", $buy_id);
		mysqli_stmt_execute($stm);
		
		$result = mysqli_stmt_get_result($stm);
				
		if ($row = mysqli_fetch_assoc($result)) {
			$buy_date = $row['Buy_Date'];
			$prod_code = $row['Prod_Code'];
			$active_status = $row['Active_Status'];
			
			if ($active_status > 1) {
				mysqli_stmt_close($stm);
				mysqli_close($conn);
			
				header("Location: ../panel.php?page=cart&error=buyinvalid");
				exit();
			}
				
			// Actualizar compra
			$sql = "UPDATE " . $table_buyeds . " SET Active_Status=2 WHERE ID=?;";
			$stm = mysqli_stmt_init($conn);
			
			// Insertar producto en el zp
			$sql_zp = "INSERT INTO " . $table_zp_buys . " (Name, Prod_ID, Prod_Code, Prod_Date) VALUES (?, ?, ?, ?)";
			$stm_zp = mysqli_stmt_init($conn);
			
			if (!mysqli_stmt_prepare($stm, $sql) || !mysqli_stmt_prepare($stm_zp, $sql_zp)) {
				mysqli_close($conn);
			
				header("Location: ../panel.php?page=cart&error=mysql");
				exit();
			}
			
			// Ejecutar insertar zp
			mysqli_stmt_bind_param($stm_zp, "ssss", $player, $buy_id, $prod_code, $buy_date);
			mysqli_stmt_execute($stm_zp);
			
			if (mysqli_stmt_affected_rows($stm_zp) < 1) {
				mysqli_stmt_close($stm_zp);
				mysqli_stmt_close($stm);
				
				mysqli_close($conn);
			
				header("Location: ../panel.php?page=cart&activation=failed");
				exit();
			}
			
			// Ejecutar actualizar web
			mysqli_stmt_bind_param($stm, "s", $buy_id);
			mysqli_stmt_execute($stm);
			
			if (mysqli_stmt_affected_rows($stm) > 0) {
				mysqli_stmt_close($stm_zp);
				mysqli_stmt_close($stm);
				
				mysqli_close($conn);
			
				header("Location: ../panel.php?page=cart&activation=success");
				exit();
			}
			else {
				mysqli_stmt_close($stm_zp);
				mysqli_stmt_close($stm);
				
				mysqli_close($conn);
			
				header("Location: ../panel.php?page=cart&activation=failed");
				exit();
			}
		}
		else {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../panel.php?page=cart&error=notfound");
			exit();
		}
	}
	else {
		mysqli_stmt_close($stm);
		mysqli_close($conn);
			
		header("Location: ../panel.php?page=cart&error=notlinked");
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