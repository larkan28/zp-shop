<?php

if (isset($_POST['recovery-submit'])) {
	$user = $_POST['in_user'];
	$mail = $_POST['in_mail'];
	
	if (empty($user) || empty($mail)) {
		header("Location: ../recovery.php?error=emptyfields");
		exit();
	}
	
	if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../singup.php?error=invalidmail");
		exit();
	}
	
	if (!preg_match("/^[a-zA-Z0-9]*$/", $user)) {
		header("Location: ../singup.php?error=invaliduser");
		exit();
	}
	
	require('../include/db_connect.php');
	
	// Verificamos que exista la cuenta con el email ingresado
	$sql = "SELECT * FROM " . $table_users . " WHERE Username=? AND Email=?;";
	$stm = mysqli_stmt_init($conn);
		
	if (!mysqli_stmt_prepare($stm, $sql)) {
		mysqli_close($conn);
		
		header("Location: ../recovery.php?error=mysql");
		exit();
	}
	else {
		mysqli_stmt_bind_param($stm, "ss", $user, $mail);
		mysqli_stmt_execute($stm);
	
		$result = mysqli_stmt_get_result($stm);
			
		if ($row = mysqli_fetch_assoc($result)) {
			mysqli_stmt_close($stm);
			$new_password = generate_password(7);
			
			// Actualizamos la nueva contraseña
			$sql = "UPDATE " . $table_users . " SET Password=? WHERE Username=?;";
			$stm = mysqli_stmt_init($conn);
			
			if (!mysqli_stmt_prepare($stm, $sql)) {
				mysqli_close($conn);
				
				header("Location: ../recovery.php?error=mysql");
				exit();
			}
			
			$hashPassword = password_hash($new_password, PASSWORD_DEFAULT);
		
			// Ejecutamos el actualizar
			mysqli_stmt_bind_param($stm, "ss", $hashPassword, $user);
			mysqli_stmt_execute($stm);
			
			if (send_password($mail, $new_password) && mysqli_stmt_affected_rows($stm) > 0) {
				mysqli_stmt_close($stm);
				mysqli_close($conn);
				
				header("Location: ../recovery.php?success=true");
				exit();
			}
			else {
				mysqli_stmt_close($stm);
				mysqli_close($conn);
				
				header("Location: ../recovery.php?success=false");
				exit();
			}
		}
		else {
			mysqli_stmt_close($stm);
			mysqli_close($conn);
			
			header("Location: ../recovery.php?error=invalidacc");
			exit();
		}
	}
	
	mysqli_stmt_close($stm);
	mysqli_close($conn);
}
else {
	header("Location: ../recovery.php");
	exit();
}

function generate_password ($password_length) {
	$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
	return substr(str_shuffle($data), 0, $password_length);
}

function send_password ($email, $new_password) {
	require '../phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->isSMTP();

	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "faculobo0098@gmail.com";
	$mail->Password = "zcsbverzjqhfmrht";

	$mail->setFrom('faculobo0098@gmail.com', 'Sunrise Community');
	$mail->addAddress($email);
	$mail->Subject = 'SC - Recuperacion de Contraseña';

	$mail->Body = 'Tu nueva contraseña es: ' . $new_password;

	if ($mail->send())
		return true;
	
	return false;
}

?>