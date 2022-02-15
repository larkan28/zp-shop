<?php  

require('db_connect.php');
$array_prods = [];

$sql = "SELECT * FROM " . $table_products . ";";
$res = mysqli_query($conn, $sql);

$PROD_ID			= 0;
$PROD_NAME			= 1;
$PROD_FULLNAME		= 2;
$PROD_TYPE			= 3;
$PROD_QUANTITY		= 4;
$PROD_PRICE_ARS		= 5;
$PROD_PRICE_USD		= 6;
$PROD_MP_LINK		= 7;
$PROD_CSS_CLASS		= 8;
$PROD_PRODUCT_CODE	= 9;

if (mysqli_num_rows($res) > 0) {
	$i = 0;
	
	while ($row = mysqli_fetch_assoc($res)) {
		$array_prods[$i][$PROD_ID] = $row['ID'];
		$array_prods[$i][$PROD_NAME] = $row['Name'];
		$array_prods[$i][$PROD_FULLNAME] = $row['FullName'];
		$array_prods[$i][$PROD_TYPE] = $row['Type'];
		$array_prods[$i][$PROD_QUANTITY] = $row['Quantity'];
		$array_prods[$i][$PROD_PRICE_ARS] = $row['Price_ARS'];
		$array_prods[$i][$PROD_PRICE_USD] = $row['Price_USD'];
		$array_prods[$i][$PROD_MP_LINK] = $row['MP_Link'];
		$array_prods[$i][$PROD_CSS_CLASS] = $row['CSS_Class'];
		$array_prods[$i][$PROD_PRODUCT_CODE] = $row['Product_Code'];
		
		$i++;
	}
}

$prods_count = count($array_prods);

?>