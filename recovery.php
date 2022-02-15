<?php
	require "header.php";
?>

<main>

<section class="cid-ry6TQQwIzT">
    <div class="container">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title mbr-fonts-style display-2">Recuperar Contraseña</h3>
        </div>
		
		<div class="form-block mbr-col-lg-4 mbr-m-auto">
			<?php
				if (isset($_GET['success'])) {
					if ($_GET['success'] == "true") {
						echo '<div class="content-box-green">Correo de recuperación enviado correctamente.</div>';
						echo '
							<form action="../login.php" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
								<div class="mbr-overlay"></div>
								<div class="mbr-sectionu-btn align-center">
									<button type="submit" class="btn btn-lk btn-primary btn-form display-7">Continuar</button>
								</div>
							</form>';
					}
					else if ($_GET['success'] == "false") {
						echo '<div class="content-box-red">Error: No pudimos enviar el correo de recuperacion.</div>';
						echo '
							<form action="../include/inc_recovery.php" method="post" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
								<div class="mbr-overlay"></div>
								<div class="fieldset">
									<p class="mbr-textw mbr-pt-2 display-7">Usuario:</p>
									<div class="text-field"><input type="text" 	name="in_user"	placeholder="Escriba su usuario..."/></div>
												
									<p class="mbr-textw mbr-pt-2 display-7">E-mail:</p>
									<div class="text-field"><input type="text" 	name="in_mail"	placeholder="Escriba su correo electronico..." /></div>
								</div>
											
								<div class="mbr-sectionu-btn align-center">
									<button type="submit" name="recovery-submit" class="btn btn-lk btn-primary btn-form display-7">Recuperar Contraseña</button>
								</div>
							</form>';
					}
				}
				else {
					if (isset($_GET['error'])) {
						if ($_GET['error'] == "emptyfields") {
							echo '<div class="content-box-red">Error: Completa todos los campos.</div>';
						}
						else if ($_GET['error'] == "mysql") {
							echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div>';
						}
						else if ($_GET['error'] == "invaliduser") {
							echo '<div class="content-box-red">Error: El usuario solo puede contener letras y numeros.</div>';
						}
						else if ($_GET['error'] == "invalidmail") {
							echo '<div class="content-box-red">Error: El e-mail es invalido.</div>';
						}
						else if ($_GET['error'] == "invalidacc") {
							echo '<div class="content-box-red">Error: El usuario/e-mail no pertenecen a ninguna cuenta.</div>';
						}
						else if ($_GET['error'] == "nosend") {
							echo '<div class="content-box-red">Error: No pudimos enviar el correo de recuperación.</div>';
						}
					}
					
					echo '
						<form action="../include/inc_recovery.php" method="post" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
							<div class="mbr-overlay"></div>
							<div class="fieldset">
								<p class="mbr-textw mbr-pt-2 display-7">Usuario:</p>
								<div class="text-field"><input type="text" 	name="in_user"	placeholder="Escriba su usuario..."/></div>
											
								<p class="mbr-textw mbr-pt-2 display-7">E-mail:</p>
								<div class="text-field"><input type="text" 	name="in_mail"	placeholder="Escriba su correo electronico..." /></div>
							</div>
										
							<div class="mbr-sectionu-btn align-center">
								<button type="submit" name="recovery-submit" class="btn btn-lk btn-primary btn-form display-7">Recuperar Contraseña</button>
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