<?php
	require "header.php";
	
	if (!isset($_SESSION['userID'])) {
		header("Location: ../index.php");
		exit();
	}
	
	if (!isset($_GET['page'])) {
		header("Location: ../panel.php?page=info");
		exit();
	}
?>

<main>

<section>
    <div class="container">
        <div class="title mbr-pb-4 align-center">
			<?php
				echo '<h3 class="mbr-section-title mbr-fonts-style display-2">Bienvenido: "' . $_SESSION['userName'] . '"</h3>';
			?>
        </div>
		
        <div class="panel-user">
			<div class="panel-opts">
				<button class="panel-button" onclick="window.location.href='panel.php?page=info';">» Información</button><br>
				<button class="panel-button" onclick="window.location.href='panel.php?page=link';">» Vincular Cuenta</button><br>
				<button class="panel-button" onclick="window.location.href='panel.php?page=cart';">» Compras Realizadas</button><br>

				<form action="../include/inc_logout.php" method="post">
					<button type="submit" name="logout-submit" class="panel-button">» Cerrar Sesión</button>
				</form>
				
			</div>
			
			<div class="panel-content" name="div_opts" id="opt_0">
				<div class="panel-title">
					» Cambiar información personal/cuenta
				</div>
				
				<div class="panel-subtitle">
					<?php
						if (isset($_GET['save'])) {
							if ($_GET['save'] == "true") {
								echo '<div class="content-box-green disp-in">Los datos se guardaron correctamente.</div>';
							}
							else if ($_GET['save'] == "false") {
								echo '<div class="content-box-red disp-in">Error: No se pudo guardar los cambios.</div>';
							}
						}
						else if (isset($_GET['error'])) {
							if ($_GET['error'] == "emptyfields") {
								echo '<div class="content-box-red disp-in">Error: Completa todos los campos.</div>';
							}
							elseif ($_GET['error'] == "mysql") {
								echo '<div class="content-box-red disp-in">Error: Ocurrio un error, intente nuevamente.</div>';
							}
							elseif ($_GET['error'] == "invalidmail") {
								echo '<div class="content-box-red disp-in">Error: El e-mail es invalido.</div>';
							}
							elseif ($_GET['error'] == "invalidname") {
								echo '<div class="content-box-red disp-in">Error: El nombre/apellido solo puede contener letras.</div>';
							}
							elseif ($_GET['error'] == "passmatch") {
								echo '<div class="content-box-red disp-in">Error: Las contraseñas no coinciden.</div>';
							}
							elseif ($_GET['error'] == "nochanges") {
								echo '<div class="content-box-red disp-in">Error: No haz realizado ningun cambio para guardar.</div>';
							}
						}
						
						require('include/db_connect.php');
						
						// Obtenemos los datos personales de la cuenta
						$sql = "SELECT FName, LName, Email FROM " . $table_users . " WHERE Username=?;";
						$stm = mysqli_stmt_init($conn);
						
						if (!mysqli_stmt_prepare($stm, $sql)) {
							echo '<div class="content-box-red disp-in">Error: Ocurrio un error al cargar los datos.</div><br>';
							echo '<a class="btn btn-md mbr-bold btn-primary display-7" href="panel.php?page=info">Reintentar</a>';
						}
						else {
							$username = $_SESSION['userName'];
							
							mysqli_stmt_bind_param($stm, "s", $username);
							mysqli_stmt_execute($stm);
					
							$result = mysqli_stmt_get_result($stm);
							
							// Si hay resultados...
							if ($row = mysqli_fetch_assoc($result)) {
								$fname = $row['FName'];
								$lname = $row['LName'];
								$email = $row['Email'];
								
								// Mostramos los resultados en los inputs
								echo '<form action="../include/inc_saveuser.php" method="post" class="panel-form">';
								
								echo 'Nombre:';
								echo '<input class="panel-input text-field" type="text" name="in_fname"	value="' . $fname . '" placeholder="Escribe tu nombre..."/>';
											
								echo 'Apellido:';
								echo '<input class="panel-input text-field" type="text" name="in_lname"	value="' . $lname . '" placeholder="Escribe tu contraseña..." />';
								
								echo 'E-mail:';
								echo '<input class="panel-input text-field" type="text" name="in_mail"	value="' . $email . '" placeholder="Escribe tu contraseña..." />';
								
								echo 'Nueva Contraseña:';
								echo '<input class="panel-input text-field" type="password" name="in_newpass" value="" placeholder="Escribe una nueva contraseña..." />';
								
								echo 'Confirmar Contraseña:';
								echo '<input class="panel-input text-field" type="password" name="in_renewpass" value="" placeholder="Escribe nuevamente tu nueva contraseña..." />';
								
								echo '<input type="hidden" name="inh_fname" value="' . $fname . '"/>';
								echo '<input type="hidden" name="inh_lname" value="' . $lname . '"/>';
								echo '<input type="hidden" name="inh_email" value="' . $email . '"/>';
								
								echo '<button type="submit" name="saveuser-submit" class="btn btn-pf btn-primary btn-form display-7">Guardar Cambios</button>';
								echo '</form>';
							}
							else {
								echo '<div class="content-box-red disp-in">Error: Ocurrio un error al cargar los datos.</div><br>';
								echo '<a class="btn btn-md mbr-bold btn-primary display-7" href="panel.php?page=info">Reintentar</a>';
							}
							
							mysqli_stmt_close($stm);
						}
						
						mysqli_close($conn);
					?>
				</div>
			</div>
			
			<div class="panel-content" name="div_opts" id="opt_1">
				<div class="panel-title">
					» Vincular cuenta con el juego
				</div>
				
				<div class="panel-subtitle">
					Aquí podrás vincular la cuenta registrada dentro del juego.<br>
					Esto te permitirá realizar compras y activarlas dentro del mismo.<br><br>
					
					<?php
						require('include/db_connect.php');
						
						// Verificar si la cuenta esta vinculada o no
						$sql = "SELECT Player, Linked FROM " . $table_users . " WHERE Username=? AND ID=?";
						$stm = mysqli_stmt_init($conn);
						
						if (!mysqli_stmt_prepare($stm, $sql))
							echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div>';
						else {
							mysqli_stmt_bind_param($stm, "ss", $_SESSION['userName'], $_SESSION['userID']);
							mysqli_stmt_execute($stm);
							
							$res = mysqli_stmt_get_result($stm);
							$row = mysqli_fetch_assoc($res);
							
							$nick = $row['Player'];
							
							// Si esta vinculada...
							if (!empty($nick)) {
								echo '
									<font color="yellow">Nota:</font>
									Para completar la vinculación con tu cuenta deberás ingresar al juego y aceptar la solicitud de vinculación que se ha enviado en el menú de administrar personaje / extras.<br><br>';
										
								if (isset($_GET['unlink'])) {
									if ($_GET['unlink'] == "false")
										echo '<div class="content-box-red">Error: No pudimos desvincular la cuenta.</div>';
								}
								
								if (isset($_GET['error'])) {
									if ($_GET['error'] == "nonick") {
										echo '<div class="content-box-red">Error: Ocurrio un error, intenta nuevamente.</div>';
									}
									else if ($_GET['error'] == "charonline") {
										echo '<div class="content-box-red">Error: Cuenta en línea, debes salirte del juego.</div>';
									}
								}
								
								$active = $row['Linked'];
								
								// Vinculacion confirmada...
								if ($active != 0) {
									echo '
										<form action="../include/inc_unlinkchar.php" method="post" class="panel-form">
											<div class="content-box-green">Cuenta vinculada: ' . 	$nick . '.</div>' . '
											<input type="hidden" name="in_nick" value="' . 			$nick . '"/>

											<button type="submit" name="unlinkacc-submit" class="btn btn-pf btn-primary btn-form display-7">Desvincular Cuenta</button>
										</form>';
								}
								else {
									echo '
										<form action="../include/inc_unlinkchar.php" method="post" class="panel-form">
											<div class="content-box-yellow">Cuenta vinculada (Sin confirmar): ' . 	$nick . '.</div>' . '
											<input type="hidden" name="in_nick" value="' . 			$nick . '"/>
											
											<button type="submit" name="unlinkacc-submit" class="btn btn-pf btn-primary btn-form display-7">Desvincular Cuenta</button>
										</form>';
								}
							}
							else {
								echo '<form action="../include/inc_linkchar.php" method="post" class="panel-form">';
								
								if (isset($_GET['unlink'])) {
									if ($_GET['unlink'] == "true")
										echo '<div class="content-box-green">La cuenta fue desvinculada correctamente.</div>';
								}
								
								if (isset($_GET['error'])) {
									if ($_GET['error'] == "emptyfields") {
										echo '<div class="content-box-red">Error: Completa todos los campos.</div>';
									}
									elseif ($_GET['error'] == "mysql") {
										echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div>';
									}
									elseif ($_GET['error'] == "charinvalid") {
										echo '<div class="content-box-red">Error: Esta cuenta no existe o ya esta vinculada.</div>';
									}
									elseif ($_GET['error'] == "charonline") {
										echo '<div class="content-box-red">Error: Cuenta en línea, debes salirte del juego.</div>';
									}
									elseif ($_GET['error'] == "errorlink") {
										echo '<div class="content-box-red">Error: No pudimos vincular la cuenta ingresada, intenta nuevamente.</div>';
									}
								}
								
								echo '
										Nickname/Tag:
										<input class="panel-input text-field" type="text" name="in_nick"	placeholder="Escribe tu nombre dentro del juego..."/>
										
										<button type="submit" name="linkacc-submit" class="btn btn-pf btn-primary btn-form display-7">Vincular Cuenta</button>
									</form>';
							}
							
							mysqli_stmt_close($stm);
						}
								
						mysqli_close($conn);
					?>
				</div>
			</div>
			
			<div class="panel-content" name="div_opts" id="opt_2">
				<div class="panel-title">
					» Mis compras
				</div>
				
				<div class="panel-subtitle">
					Aquí podrás activar los productos que hayas comprado.<br>
					Recuerda que primero debes vincular una cuenta con el servidor.<br><br>
					
					<font color="yellow">Nota:</font> La habilitación de los productos para su activación tarda 24 horas (como máximo) desde el momento en el que se efectuo el pago.
					Este proceso puede acelerarse poniendose en <a href="contact.php" class="contact">Contacto</a> con nosotros y proporcionando la información que le solicitemos.<br><br>
					
					<?php
						if (isset($_GET['activation'])) {
							if ($_GET['activation'] == "success") {
								echo '<div class="content-box-green">El producto fue activado exitosamente.</div><br>';
							}
							else if ($_GET['activation'] == "failed") {
								echo '<div class="content-box-red">Error: No se pudo activar el producto, intenta nuevamente.</div><br>';
							}
						}
						
						if (isset($_GET['error'])) {
							if ($_GET['error'] == "mysql") {
								echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div><br>';
							}
							elseif ($_GET['error'] == "notlinked") {
								echo '<div class="content-box-red">Error: Primero debes vincular tu cuenta con el servidor.</div><br>';
							}
							elseif ($_GET['error'] == "notfound") {
								echo '<div class="content-box-red">Error: El producto/compra no fue encontrado.</div><br>';
							}
							elseif ($_GET['error'] == "buyinvalid") {
								echo '<div class="content-box-red">Error: El producto/compra seleccionado es invalido o ya fue activado.</div><br>';
							}
							elseif ($_GET['error'] == "invalidchar") {
								echo '<div class="content-box-red">Error: La cuenta vinculada es incorrecta o esta en línea.</div><br>';
							}
						}
								
						require('include/db_connect.php');
						
						// Obtenemos todos los productos comprados
						$sql = "SELECT ID, Prod_ID, Prod_Code, Buy_Date, Pay_Status, Active_Status FROM " . $table_buyeds . " WHERE User_ID=?;";
						$stm = mysqli_stmt_init($conn);
						
						if (!mysqli_stmt_prepare($stm, $sql))
							echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div>';
						else {
							mysqli_stmt_bind_param($stm, "s", $_SESSION['userID']);
							mysqli_stmt_execute($stm);
							
							mysqli_stmt_store_result($stm);
							$rows = mysqli_stmt_num_rows($stm);
							
							// Verificamos que haya productos comprados
							if ($rows < 1)
								echo '<div class="content-box-yellow">Aviso: No hay compras registradas.</div>';
							else {
								require('include/inc_cacheprods.php');
								
								echo '<div class="mbr-row mbr-jc-c">
										<table>
											<tr>
												<th>ID</th>
												<th>Producto</th>
												<th>Estado del Pago</th>
												<th>Fecha</th>
												<th>Activación</th>
											</tr>';
								
								mysqli_stmt_bind_result($stm, $buy_id, $prod_id, $prod_code, $buy_date, $pay_status, $active_status);
							
								// Entablamos los productos comprados...
								while (mysqli_stmt_fetch($stm)) {
									echo '<tr>';
										// Producto ID
										echo '<td>' . $buy_id . '</td>';
										
										// Producto Name
										for ($i = 0; $i < $prods_count; $i++) {
											if ($prod_id == $array_prods[$i][$PROD_ID]) {
												echo '<td>' . $array_prods[$i][$PROD_FULLNAME] . '</td>';
												break;
											}
										}
										
										// Estado del Pago
										switch ($pay_status) {
											case 1:
												echo '<td>Hecho</td>';
												break;
											case 2:
												echo '<td>Pendiente</td>';
												break;
											default:
												echo '<td>Indefinido</td>';
												break;
											
										}
										
										// Fecha de Compra
										echo '<td>' . $buy_date . '</td>';
										
										// Estado de Activacion
										if ($active_status > 1)
											echo '<td>Activado</td>';
										else {
											echo '<td>';
											echo '<form action="../include/inc_activeproduct.php" method="post">';
											echo '<input type="hidden" name="buy_id" value="' . $buy_id . '"/>';
											
											if ($active_status > 0)
												echo '<button type="submit" name="active-submit" class="button-link pts">Activar</button>';
											else
												echo '<button type="submit" name="active-submit" class="button-link pts" disabled>Activar</button>';
											
											echo '</form>';
											echo '</td>';
										}
										
									echo '</tr>';
								}
								
								echo '</table></div>';
							}
						}
						
						mysqli_stmt_close($stm);
						mysqli_close($conn);
					?>
				</div>
			</div>
			
			<?php
				if ($_GET['page'] == "link") {
					echo '<script type="text/javascript">	optionsPanel("opt_1");	</script>';
				}
				else if ($_GET['page'] == "cart") {
					echo '<script type="text/javascript">	optionsPanel("opt_2");	</script>';
				}
				else {
					echo '<script type="text/javascript">	optionsPanel("opt_0");	</script>';
				}
			?>
        </div>
    </div>
</section>

</main>

<?php
	require "footer.php";
?>