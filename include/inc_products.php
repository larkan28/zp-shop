<?php

require('include/db_connect.php');

// Cache Results
require('include/inc_cacheprods.php');

// Multiplicadores
echo '
	<font color="#2bff00">- Venta de Multiplicadores:</font><br>
	Los multiplicadores, como su nombre lo indica, multiplican la ganancia de Ammopacks (Aps) y Puntos (Humanos, Zombies, Survivors y Nemesis).<br><br>
	
	<div class="mbr-row mbr-jc-c">
		<table>
			<tr>
				<th>Multiplicador</th>
				<th>1 Mes</th>
				<th>2 Meses</th>
				<th>3 Meses</th>
			</tr>';
			
$multis = array("x2", "x3", "x4", "x5");

for ($i = 0; $i < count($multis); $i++) {
	echo '<tr>';
	echo '<td>' . $multis[$i] . '</td>';
	
	for ($j = 0; $j < $prods_count; $j++) {
		if ($array_prods[$j][$PROD_NAME] != $multis[$i] || $array_prods[$j][$PROD_TYPE] != 0)
			continue;
			
		echo '<td>';	
		echo '<form action="../include/inc_buyproduct.php" method="post">';
		echo '<input type="hidden" name="id_prod" value="' . $array_prods[$j][$PROD_ID] . '"/>';
		echo '<input type="hidden" name="mp_link" value="' . $array_prods[$j][$PROD_MP_LINK] . '"/>';
		echo '<input type="hidden" name="cd_prod" value="' . $array_prods[$j][$PROD_PRODUCT_CODE] . '"/>';
		echo '<button type="submit" name="buy-submit" class="button-link ' . $array_prods[$j][$PROD_CSS_CLASS] . '">$' . $array_prods[$j][$PROD_PRICE_ARS] . '</button></form>';
		echo '</td>';
	}
	
	echo '</tr>';
}

echo '</table></div>';

// Puntos
echo '<br>
	<font color="#2bff00">- Venta de Puntos:</font><br>
	Los puntos se utilizan para mejorar las habilidades de las clases (Humanas/Zombies), lo cual te permite realizar mas daño, tener mas vida, etc.<br><br>
	
	<div class="mbr-row mbr-jc-c">
		<table>
			<tr>
				<th>Puntos</th>
				<th>2.500</th>
				<th>5.000</th>
				<th>10.000</th>
			</tr>';
			
$points = array("Humanos", "Zombies");

for ($i = 0; $i < count($points); $i++) {
	echo '<tr>';
	echo '<td>' . $points[$i] . '</td>';
	
	for ($j = 0; $j < $prods_count; $j++) {
		if ($array_prods[$j][$PROD_NAME] != $points[$i] || $array_prods[$j][$PROD_TYPE] != 1)
			continue;
		
		echo '<td>';	
		echo '<form action="../include/inc_buyproduct.php" method="post">';
		echo '<input type="hidden" name="id_prod" value="' . $array_prods[$j][$PROD_ID] . '"/>';
		echo '<input type="hidden" name="mp_link" value="' . $array_prods[$j][$PROD_MP_LINK] . '"/>';
		echo '<input type="hidden" name="cd_prod" value="' . $array_prods[$j][$PROD_PRODUCT_CODE] . '"/>';
		echo '<button type="submit" name="buy-submit" class="button-link ' . $array_prods[$j][$PROD_CSS_CLASS] . '">$' . $array_prods[$j][$PROD_PRICE_ARS] . '</button></form>';
		echo '</td>';
	}
	
	echo '</tr>';
}
			
echo '</table></div>';

// Ancient Points
echo '<br>
	<font color="#2bff00">- Venta de Ancient Points:</font><br>
	Los Ancient Points se utilizan para mejorar el nivel del arma subiendola +50 Niveles por cada uno. Se ganan realizando 1 Reset Destroyer (100 Resets).<br><br>
	
	<div class="mbr-row mbr-jc-c">
		<table>
			<tr>
				<th>Cantidad</th>
				<th>Precios</th>
			</tr>';
			
for ($i = 1; $i <= 3; $i++) {
	echo '<tr>';
	echo '<td>' . $i . '</td>';
	
	for ($j = 0; $j < $prods_count; $j++) {
		if ($array_prods[$j][$PROD_TYPE] != 2 || $array_prods[$j][$PROD_QUANTITY] != $i)
			continue;
			
		echo '<td>';	
		echo '<form action="../include/inc_buyproduct.php" method="post">';
		echo '<input type="hidden" name="id_prod" value="' . $array_prods[$j][$PROD_ID] . '"/>';
		echo '<input type="hidden" name="mp_link" value="' . $array_prods[$j][$PROD_MP_LINK] . '"/>';
		echo '<input type="hidden" name="cd_prod" value="' . $array_prods[$j][$PROD_PRODUCT_CODE] . '"/>';
		echo '<button type="submit" name="buy-submit" class="button-link ' . $array_prods[$j][$PROD_CSS_CLASS] . '">$' . $array_prods[$j][$PROD_PRICE_ARS] . '</button></form>';
		echo '</td>';
	}
	
	echo '</tr>';
}
			
echo '</table></div>';
?>