<?php
	require "header.php";
	
	if (isset($_SESSION['userAdmin'])) {
		header("Location: ../admincp/panel.php");
		exit();
	}
?>

<main>

<section class="cid-ry6TQQwIzT">
    <div class="container">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title mbr-fonts-style display-2">Panel de Control</h3>
        </div>
		
        <div class="form-block mbr-col-lg-4 mbr-m-auto">
			<?php
				if (isset($_GET['error'])) {
					if ($_GET['error'] == "emptyfields") {
						echo '<div class="content-box-red">Error: Completa todos los campos.</div>';
					}
					else if ($_GET['error'] == "mysql") {
						echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div>';
					}
					else if ($_GET['error'] == "wrongaccount") {
						echo '<div class="content-box-red">Error: Credenciales incorrectos.</div>';
					}
					else if ($_GET['error'] == "firstlogin") {
						echo '<div class="content-box-yellow">Aviso: Primero debes iniciar sesión.</div>';
					}
				}
					
				echo '
					<form action="../admincp/include/inc_admlogin.php" method="post" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
						<div class="mbr-overlay"></div>
						<div class="fieldset">
							<p class="mbr-textw mbr-pt-2 display-7">Usuario:</p>
							<div class="text-field"><input type="text" 		name="adm_user"		placeholder="Escribe tu usuario..."/></div>
								
							<p class="mbr-textw mbr-pt-2 display-7">Contraseña:</p>
							<div class="text-field"><input type="password" 	name="adm_pass"		placeholder="Escribe tu contraseña..." /></div>
						</div>
							
						<div class="mbr-sectionu-btn align-center">
							<button type="submit" name="admlogin-submit" class="btn btn-lk btn-primary btn-form display-7">Iniciar Sesión</button>
						</div>
					</form>';
			?>
        </div>
    </div>
</section>

</main>

<?php
	require "footer.php";
?>