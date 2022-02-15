<?php
	require "header.php";

	if (!isset($_SESSION['userID'])) {
		header("Location: ../login.php?error=firstlogin");
		exit();
	}
?>

<script type="text/javascript">
(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
</script>

<main>

<section class="cid-ry6TQQwIzT">
    <div class="container">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title mbr-fonts-style display-2">Tienda</h3>
        </div>
		
<div class="form-block mbr-col-lg-8 mbr-m-auto">
	<div class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
		<div class="mbr-overlay"></div>
		
		<div class="shop">
			Los precios mostrados se encuentran en <font color="yellow">Pesos Argentinos (ARS)</font>, en caso de que seas de otro pais deberas <a href="contact.php" class="contact">Contactarnos</a> para realizar una compra.<br><br>
			
			<?php
				if (isset($_GET['error'])) {
					if ($_GET['error'] == "mysql") {
						echo '<div class="content-box-red">Error: Ocurrio un error, intente nuevamente.</div>';
					}
				}
				
				require "include/inc_products.php";
			?>

			<br><font color="yellow">> Procedimiento de Pago:</font><br>
			Una vez hayas realizado el pago, deberas ponerte en <a href="contact.php" class="contact">Contacto</a> con nosotros para la activación de tu compra en el servidor.<br><br>
			Ten en cuenta que deberas proporcionarnos la siguiente información:<br><br>
			<font color="cyan">- Tag/Nickname (Nombre en el juego)</font><br>
			<font color="cyan">- Foto de comprobante del pago (Sí hubiera)</font><br><br>
			Esto es para la corroboración de la compra.<br>
			Si tienes alguna pregunta, no dudes en consultarnos.
		</div>
	</div>
</div>

	</div>
</section>

</main>

<?php
	require "footer.php";
?>