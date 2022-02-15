<?php
	require "header.php";
?>

<main>

<section class="cid-ry6TQQwIzT">
    <div class="container">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title mbr-fonts-style display-2">Cerrar Sesión</h3>
        </div>
		
        <div class="form-block mbr-col-lg-4 mbr-m-auto">
			<?php
				if (isset($_SESSION['userID'])) {
					echo '<div class="content-box-red">Error: No se pudo cerrar la sesion.</div>';
					echo '
						<form action="../include/inc_logout.php" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column" method="post">
							<div class="mbr-overlay"></div>
							<div class="mbr-section-btn align-center">
								<button type="submit" name="logout-submit" class="btn btn-lk btn-primary btn-form display-7">Reintentar</button>
							</div>
						</form>';
				}
				else {
					echo '<div class="content-box-green">Cerraste sesión correctamente.</div>';
					echo '
						<form action="../index.php" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
							<div class="mbr-overlay"></div>
							<div class="mbr-section-btn align-center">
								<button type="submit" class="btn btn-lk btn-primary btn-form display-7">Continuar</button>
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