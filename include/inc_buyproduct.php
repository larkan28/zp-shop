<?php
session_start();

if (!isset($_SESSION['userID'])) {
	header("Location: ../index.php");
	exit();
}

if (isset($_POST['buy-submit'])) {
	require('../include/db_connect.php');
	$user_id = $_SESSION['userID'];
	
	// Obtenemos datos de la cuenta
	$sql = "SELECT Email, FName, LName FROM " . $table_users . " WHERE ID=?;";
	$stm = mysqli_stmt_init($conn);
		
	if (!mysqli_stmt_prepare($stm, $sql)) {
		mysqli_close($conn);
		
		header("Location: ../shop.php?error=mysql");
		exit();
	}
		
	mysqli_stmt_bind_param($stm, "s", $user_id);
	mysqli_stmt_execute($stm);
	
	$result = mysqli_stmt_get_result($stm);
		
	if ($row = mysqli_fetch_assoc($result)) {
		mysqli_stmt_close($stm);
		
		$email = $row['Email'];
		$fname = ucfirst($row['FName']);
		$lname = ucfirst($row['LName']);
		
		// Obtenemos los datos de la compra
		$mp_link = $_POST['mp_link'];
		$id_prod = $_POST['id_prod'];
		$cd_prod = $_POST['cd_prod'];
		
		// Verificamos si existe la compra
		$sql = "SELECT * FROM " . $table_buyeds . " WHERE Prod_ID=? AND Prod_Code=? AND User_ID=? AND Active_Status=0;";
		$stm = mysqli_stmt_init($conn);
			
		if (!mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../shop.php?error=mysql");
			exit();
		}
			
		mysqli_stmt_bind_param($stm, "sss", $id_prod, $cd_prod, $user_id);
		mysqli_stmt_execute($stm);
		
		$result = mysqli_stmt_get_result($stm);
		
		if ($row = mysqli_fetch_assoc($result)) {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
				
			header("Location: https://www.mercadopago.com.ar/checkout/v1/redirect?pref_id=226292973-" . $mp_link);
			exit();
		}
		
		// Insertamos la nueva compra
		$sql = "INSERT INTO " . $table_buyeds . " (Prod_ID, Prod_Code, User_ID, Email, FName, LName, Operation, Buy_Date, Pay_Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stm = mysqli_stmt_init($conn);
			
		if (!mysqli_stmt_prepare($stm, $sql)) {
			mysqli_close($conn);
			
			header("Location: ../shop.php?error=mysql");
			exit();
		}
		else {
			date_default_timezone_set('America/Argentina/Buenos_Aires');
			$curr_date = date("d-m-Y - H:i");
			
			$oid = -1;
			$pay = -1;
			
			mysqli_stmt_bind_param($stm, "sssssssss", $id_prod, $cd_prod, $user_id, $email, $fname, $lname, $oid, $curr_date, $pay);
			mysqli_stmt_execute($stm);
			
			if (mysqli_stmt_affected_rows($stm) > 0) {
				mysqli_stmt_close($stm);
				mysqli_close($conn);
				
				header("Location: https://www.mercadopago.com.ar/checkout/v1/redirect?pref_id=226292973-" . $mp_link);
				exit();
			}
			else {
				mysqli_stmt_close($stm);
				mysqli_close($conn);
	
				header("Location: ../shop.php?error=mysql");
				exit();
			}
		}
	}
	else {
		mysqli_stmt_close($stm);
		mysqli_close($conn);
	
		header("Location: ../shop.php?error=mysql");
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