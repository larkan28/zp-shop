<?php
	require "header.php";

	if (!isset($_SESSION['userID'])) {
		header("Location: ../login.php?error=firstlogin");
		exit();
	}
	
	if (!isset($_GET['collection_id']) || !isset($_GET['collection_status']) || !isset($_GET['external_reference'])) {
		header("Location: ../index.php");
		exit();
	}
?>

<main>

<section class="cid-ry6TQQwIzT">
    <div class="container">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title mbr-fonts-style display-2">Tienda</h3>
        </div>
		
        <div class="form-block mbr-col-lg-6 mbr-m-auto">
			<div class="title mbr-pb-4 align-center">
				<h3 class="mbr-section-title mbr-fonts-style display-2"><font color="white">¡Gracias por tu Compra!</font></h3>
			</div>
		
			<form action="../shop.php" class="mbr-form mbr-jc-c mbr-flex mbr-m-auto mbr-column">
				<div class="mbr-overlay"></div>
						
			<?php
				require('include/db_connect.php');
				
				$user_id = $_SESSION['userID'];
				$prod_id = $_GET['external_reference'];
				
				$ope_id = $_GET['collection_id'];
				$status = $_GET['collection_status'];
				
				// Actualizar compra
				$sql = "UPDATE " . $table_buyeds . " SET Operation=?, Pay_Status=? WHERE User_ID=? AND Prod_ID=? AND Operation=-1 AND Active_Status=0;";
				$stm = mysqli_stmt_init($conn);
					
				if (mysqli_stmt_prepare($stm, $sql)) {
					$pay_status = ($status == "pending") ? 2 : 1;
						
					mysqli_stmt_bind_param($stm, "ssss", $ope_id, $pay_status, $user_id, $prod_id);
					mysqli_stmt_execute($stm);
				}
				
				mysqli_stmt_close($stm);
				mysqli_close($conn);
				
				if ($status == "success")
					echo '<p class="mbr-textw mbr-pt-2 display-7"><font color="yellow">Nota:</font> Pago completado, dentro de las proximas 24 horas podras activar tu producto desde el panel de usuario.</p>';
				else
					echo '<p class="mbr-textw mbr-pt-2 display-7"><font color="yellow">Nota:</font> Pago pendiente, cuando lo realices, pasadas las 24 horas podras activar tu producto desde el panel de usuario.</p>';
				
				echo '
						<div class="mbr-sectionu-btn align-center">
							<button type="submit" class="btn btn-pf btn-primary btn-form display-7">Continuar</button>
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