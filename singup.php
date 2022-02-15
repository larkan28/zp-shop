<?php
	require "header.php";
	
	if (isset($_SESSION['userID'])) {
		header("Location: ../index.php");
		exit();
	}
?>

<main>

<section class="cid-ry6TQQwIzT">
    <div class="container">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title mbr-fonts-style display-2">Registrarse</h3>
        </div>
		
        <div class="form-block mbr-col-lg-6 mbr-m-auto">
			<?php
				if (isset($_GET['success'])) {
					if ($_GET['success'] == "true") {
						echo '<div class="content-box-green">Registro completado correctamente.</div>';
						echo '
							<form action="../login.php" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
								<div class="mbr-overlay"></div>
								<div class="mbr-sectionu-btn align-center">
									<button type="submit" class="btn btn-lk btn-primary btn-form display-7">Continuar</button>
								</div>
							</form>';
					}
				}
				else {
					if (isset($_GET['error'])) {
						if ($_GET['error'] == "emptyfields") {
							echo '<div class="content-box-red">Error: Completa todos los campos.</div>';
						}
						elseif ($_GET['error'] == "mysql") {
							echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div>';
						}
						elseif ($_GET['error'] == "invaliduser") {
							echo '<div class="content-box-red">Error: El usuario solo puede contener letras y numeros.</div>';
						}
						elseif ($_GET['error'] == "invalidname") {
							echo '<div class="content-box-red">Error: El nombre/apellido solo puede contener letras.</div>';
						}
						elseif ($_GET['error'] == "invalidmail") {
							echo '<div class="content-box-red">Error: El e-mail es invalido.</div>';
						}
						elseif ($_GET['error'] == "passmatch") {
							echo '<div class="content-box-red">Error: Las contraseñas no coinciden.</div>';
						}
						elseif ($_GET['error'] == "usertaken") {
							echo '<div class="content-box-red">Error: El usuario ya existe.</div>';
						}
						elseif ($_GET['error'] == "mailtaken") {
							echo '<div class="content-box-red">Error: El e-mail esta en uso.</div>';
						}
						elseif ($_GET['error'] == "noterms") {
							echo '<div class="content-box-red">Error: Debes aceptar los términos y condiciones.</div>';
						}
					}
					
					echo '
						<form action="../include/inc_singup.php" method="post" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
							<div class="mbr-overlay"></div>
							<div class="fieldset">
								<p class="mbr-textw mbr-pt-2 display-7">Usuario:</p>
								<div class="text-field"><input type="text" 		name="in_user"		placeholder="Escribe un usuario..."/></div>
									
								<p class="mbr-textw mbr-pt-2 display-7">Contraseña:</p>
								<div class="text-field"><input type="password" 	name="in_pass"		placeholder="Escribe una contraseña..." /></div>
									
								<p class="mbr-textw mbr-pt-2 display-7">Repetir Contraseña:</p>
								<div class="text-field"><input type="password" 	name="in_re-pass"	placeholder="Escribe nuevamente tu contraseña..." /></div>
									
								<p class="mbr-textw mbr-pt-2 display-7">E-mail:</p>
								<div class="text-field"><input type="text" 		name="in_mail"		placeholder="Escribe un correo electronico..." /></div>
									
								<p class="mbr-textw mbr-pt-2 display-7">Nombre:</p>
								<div class="text-field"><input type="text" 		name="in_fname"		placeholder="Escribe tu nombre..." /></div>
									
								<p class="mbr-textw mbr-pt-2 display-7">Apellido:</p>
								<div class="text-field"><input type="text" 		name="in_lname"		placeholder="Escribe tu apellido..." /></div>
							</div>

							<label class="container-check">
								<p class="mbr-textw display-7">Acepto que los datos ingresados son validos y correctos.</p>
								<input type="checkbox" name="in_terms">
								<span class="checkmark-check"></span>
							</label>
								
							<div class="mbr-sectionu-btn align-center">
								<button type="submit" name="singup-submit" class="btn btn-lk btn-primary btn-form display-7">Registrarse</button>
							</div>
						</form>';
				}
			?>
        </div>
    </div>
</section>

</main>

<?php
	require "footer.php";
?>