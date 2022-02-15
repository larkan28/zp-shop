<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<meta name="description" content="">
<title>Sunrise Community</title>
  
<link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />

<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
 
<script async  src="https://cdn.ampproject.org/v0.js"></script>
<script src="js/userpanel.js"></script>

<script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		
</head>
<body>

<div id="page-container"><div id="content-wrap">
<header>

<section class="menu1 menu horizontal-menu cid-r9hYnpdbBm" id="menu1-1">
	<nav class="navbar navbar-dropdown navbar-expand-lg navbar-fixed-top">
		<div class="menu-container container">
			<!-- SHOW LOGO -->
			<div class="navbar-brand">
				<span class="navbar-caption-wrap"><a class="navbar-caption mbr-bold text-black display-5" href="/index.php">Sunrise-Community</a></span>
			</div>
			<!-- SHOW LOGO END -->
			<!-- COLLAPSED MENU -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- NAVBAR ITEMS -->
				<ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
					<li class="nav-item"><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div>
						<a class="nav-link mbr-bold link text-black display-7" href="/index.php">Inicio</a>
					</li>
					<li class="nav-item"><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div>
						<a class="nav-link mbr-bold link text-black display-7" href="/index.php#servers">Servidores</a>
					</li>
					<li class="nav-item"><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div>
						<a class="nav-link mbr-bold link text-black display-7" href="/index.php#downloads">Descargas</a>
					</li>
					
					<?php
						if (isset($_SESSION['userID'])) {
							echo '<li class="nav-item"><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div>';
							echo '<a class="nav-link mbr-bold link text-black display-7" href="/shop.php">Tienda</a>';
							echo '</li>';
						}
					?>
					
					<li class="nav-item"><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div>
						<a class="nav-link mbr-bold link text-black display-7" href="contact.php">Contacto</a>
					</li>
				</ul>
				<!-- NAVBAR ITEMS END -->
				<!-- SHOW BUTTON -->
				<div class="navbar-buttons mbr-section-btn"><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div>
					<?php
						if (isset($_SESSION['userID'])) {
							echo '<a class="btn btn-md mbr-bold btn-primary-outline display-7" href="/panel.php?page=info">Panel de Usuario</a>';
						}
						else {
							echo '<a class="btn btn-md mbr-bold btn-primary-outline display-7" href="/login.php">Iniciar Sesión</a>';
							echo '<a class="btn btn-md mbr-bold btn-primary-outline display-7" href="/singup.php">Registrarse</a>';
						}
					?>
				</div>
				<!-- SHOW BUTTON END -->
			</div>
			<!-- COLLAPSED MENU END -->
			
			<button on="tap:sidebar.toggle" class="ampstart-btn hamburger">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
	</nav>
	<!-- AMP plug -->
</section>

</header>