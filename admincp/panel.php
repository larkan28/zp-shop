<?php
	require "header.php";
	
	if (!isset($_SESSION['userAdmin'])) {
		header("Location: ../admincp/index.php?error=firstlogin");
		exit();
	}
?>

<main>

<section class="cid-ry6TQQwIzT">
    <div class="container-panel">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title mbr-fonts-style display-2">Panel de Control</h3>
        </div>
		
		<div class="form-block mbr-col-lg-14 mbr-m-auto">
			<div class="mbr-form">
				<div class="mbr-overlay"></div>
				
				<label class="container-check">
					<p class="mbr-textw display-7">Mostrar borrar</p>
					<input type="checkbox" id="show_delete" onclick="changeVars()"><span class="checkmark-check"></span>
				</label>
				
				<label class="container-check">
					<p class="mbr-textw display-7">Mostrar pago</p>
					<input type="checkbox" id="show_pay" onclick="changeVars()"><span class="checkmark-check"></span>
				</label>
				
				<label class="container-check">
					<p class="mbr-textw display-7">Mostrar info.</p>
					<input type="checkbox" id="show_info" onclick="changeVars()"><span class="checkmark-check"></span>
				</label><br>
				
				<?php
					if (isset($_GET['activate'])) {
						if ($_GET['activate'] == "success") {
							echo '<div class="content-box-green disp-in">El producto fue habilitado exitosamente.</div>';
						}
						else if ($_GET['activate'] == "fail") {
							echo '<div class="content-box-red disp-in">Error: No se pudo habilitar el producto.</div>';
						}
					}
					
					if (isset($_GET['delete'])) {
						if ($_GET['delete'] == "success") {
							echo '<div class="content-box-green disp-in">El producto fue eliminado exitosamente.</div>';
						}
						else if ($_GET['delete'] == "fail") {
							echo '<div class="content-box-red disp-in">Error: No se pudo eliminar el producto.</div>';
						}
					}
					
					if (isset($_GET['error'])) {
						if ($_GET['error'] == "mysql") {
							echo '<div class="content-box-red disp-in">Error: Ocurrio un error, intente nuevamente.</div>';
						}
					}
					
					require "include/inc_admbuys.php";
				?>
			</div>
		</div>
		
		<br>
		<br>
		
		<div class="title mbr-pb-4 align-center">
            <form action="/admincp/include/inc_admlogout.php" method="post">';
				<button type="submit" name="admlogout-submit" class="btn btn-md btn-primary btn-form display-7">Cerrar Sesión</button>
			</form>
        </div>
	</div>
</section>

</main>

<?php
	require "footer.php";
?>