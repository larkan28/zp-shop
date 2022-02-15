<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "zp";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error($conn));
}

$table_users = "web_users";
$table_admins = "web_admins";
$table_buyeds = "web_buyeds";
$table_servers = "web_servers";
$table_products = "web_products";

$table_zp_accs = "accs";
$table_zp_buys = "buys";

?>