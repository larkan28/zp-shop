<?php

if (!isset($_SESSION['userAdmin'])) {
	header("Location: ../index.php");
	exit();
}

$show_pay = isset($_GET['pay']) ? ($_GET['pay'] == "yes") : false;
$show_info = isset($_GET['info']) ? ($_GET['info'] == "yes") : false;
$show_delete = isset($_GET['delete']) ? ($_GET['delete'] == "yes") : false;

echo '
	<table class="full-table">
		<tr>';
		
if ($show_info) {
	echo '<th>ID</th>';
	echo '<th>Operacion</th>';
}

echo '
		<th>Producto</th>
		<th>Costo</th>
		<th>Nombre/Apellido</th>
		<th>E-mail</th>
		<th>Fecha</th>';
			
if ($show_pay) {
	echo '<th>Pago</th>';
}

echo '<th>Activar</th>';

if ($show_delete) {
	echo '<th>Borrar</th>';
}

echo '</tr>';
		
require('../include/db_connect.php');
require('../include/inc_cacheprods.php');

$sql = "SELECT * FROM " . $table_buyeds . " WHERE Active_Status=0 ORDER BY ID DESC;";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
	while ($row = mysqli_fetch_assoc($res)) {
		echo '<tr>';
		$prod_id = $row['ID'];
			
		if ($show_info) {
			echo '<td>' 	. $prod_id . '</td>';
			echo '<td>' 	. $row['Operation'] . '</td>';
		}
			
		for ($i = 0; $i < $prods_count; $i++) {
			if ($array_prods[$i][$PROD_ID] == $row['Prod_ID']) {
				echo '<td>' 	. $array_prods[$i][$PROD_FULLNAME] . '</td>';
				echo '<td>$' 	. $array_prods[$i][$PROD_PRICE_ARS] . '</td>';
			
				break;
			}
		}
			
		$fname = ucfirst($row['FName']);
		$lname = ucfirst($row['LName']);
			
		echo '<td>' 	. $fname . ' ' . $lname . '</td>';
		echo '<td>' 	. $row['Email'] . '</td>';
		echo '<td>' 	. $row['Buy_Date'] . '</td>';
			
		if ($show_pay) {
			switch ($row['Pay_Status']) {
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
		}
			
		echo '<td>';	
		echo '<form action="/admincp/include/inc_admactivate.php" method="post">';
		echo '<input type="hidden" name="id_prod" value="' . $prod_id . '"/>';
		echo '<button type="submit" name="admset-submit" class="button-link pts">Set</button></form>';
		echo '</td>';
			
		if ($show_delete) {
			echo '<td>';	
			echo '<form action="/admincp/include/inc_admdelete.php" method="post">';
			echo '<input type="hidden" name="id_prod" value="' . $prod_id . '"/>';
			echo '<button type="submit" name="admdel-submit" class="button-link pts">Del</button></form>';
			echo '</td>';
		}
			
		echo '</tr>';
	}
}

mysqli_close($conn);
echo '</table>';

?>