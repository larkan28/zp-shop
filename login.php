<?php
	require "header.php";
?>

<main>

<section class="cid-ry6TQQwIzT">
    <div class="container">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title mbr-fonts-style display-2">Iniciar Sesión</h3>
        </div>
		
        <div class="form-block mbr-col-lg-4 mbr-m-auto">
			<?php
				if (isset($_SESSION['userID'])) {
					echo '<div class="content-box-green">Iniciaste sesión correctamente.</div>';
					echo '
						<form action="../index.php" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
							<div class="mbr-overlay"></div>
							<div class="mbr-sectionu-btn align-center">
								<button type="submit" class="btn btn-lk btn-primary btn-form display-7">Continuar</button>
							</div>
						</form>';
				}
				else {
					if (isset($_GET['error'])) {
						if ($_GET['error'] == "emptyfields") {
							echo '<div class="content-box-red">Error: Completa todos los campos.</div>';
						}
						else if ($_GET['error'] == "mysql") {
							echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div>';
						}
						else if ($_GET['error'] == "wrongpass") {
							echo '<div class="content-box-red">Error: Contraseña incorrecta.</div>';
						}
						else if ($_GET['error'] == "wronguser") {
							echo '<div class="content-box-red">Error: Usuario incorrecto.</div>';
						}
						else if ($_GET['error'] == "firstlogin") {
							echo '<div class="content-box-yellow">Aviso: Primero debes iniciar sesión.</div>';
						}
					}
					
					echo '
						<form action="../include/inc_login.php" method="post" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
							<div class="mbr-overlay"></div>
							<div class="fieldset">
								<p class="mbr-textw mbr-pt-2 display-7">Usuario:</p>
								<div class="text-field"><input type="text" 		name="user"		placeholder="Escribe tu usuario..."/></div>
								
								<p class="mbr-textw mbr-pt-2 display-7">Contraseña:</p>
								<div class="text-field"><input type="password" 	name="pass"		placeholder="Escribe tu contraseña..." /></div>
							</div>
							
							<div class="mbr-sectionu-btn align-center">
								<button type="submit" name="login-submit" class="btn btn-lk btn-primary btn-form display-7">Iniciar Sesión</button>
							</div>
						</form>';
						
					echo '
						<form action="../recovery.php" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
							<div class="mbr-section-btn align-center">
								<button type="submit" class="btn btn-lk btn-primary btn-form display-7">Recuperar Contraseña</button>
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