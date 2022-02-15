<?php
	require "header.php";
?>

<main>

<section class="header1 cid-r9hYfl02Zb" id="img-slider">
    <div class="mbr-overlay"></div>
    <div class="container">
        <div class="mbr-row align-center">
            <div class="title-block mbr-col-sm-12 mbr-col-md-12 mbr-col-lg-12">
                <h1 class="mbr-section-title mbr-bold display-1">ZOMBIE DESTROYER<br></h1>
                <h2 class="mbr-section-subtitle mbr-pt-3 display-2">IP: 131.255.6.115:27015<br></h2>
                
                <div class="mbr-section-btn mbr-pt-4"><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div><div style="position: absolute; left: -100000px; opacity: 0;" contenteditable="true"></div>
					<a class="btn btn-white display-4" href="index.php#servers">VER SERVIDORES</a>
				</div>
            </div>
        </div>
    </div>
</section>

<section class="header2 cid-r9hYIlJB38" id="about">
    <div class="container">
        <div class="mbr-row mbr-black mbr-row-reverse">
            <div class="title-wrap mbr-col-md-12 mbr-col-sm-12 mbr-col-lg-6 align-left mbr-flex">
                <div class="title-block mbr-col-sm-12 mbr-col-md-12">
                    <h1 class="mbr-section-title mbr-white display-2">Sunrise Community</h1>
                    
					<div class="mbrb-text mbr-fonts-style mbr-black mbr-pt-2 display-7">
						<br>Somos una comunidad de juegos online, donde nos centramos principalmente en el juego Counter Strike 1.6.
						<br><br>Aquí podras encontrar la información de nuestros servidores, recursos para descargar y mucho más.
					</div>
					
                    <div class="mbr-section-btn mbr-pt-4">
						<a class="btn btn-info display-7" href="https://discord.gg/gv647Em" target="_blank">Servidor de Discord</a> 
						<a class="btn btn-primary display-7" href="https://www.facebook.com/groups/comunidad.sunrise" target="_blank">Grupo de Facebook</a>
					</div>
                </div>
            </div>
            <div class="image-wrap mbr-col-md-12 mbr-col-sm-12 mbr-col-lg-6 mbr-flex">
                <div class="image-block mbr-col-md-12 mbr-col-sm-12 mbr-m-auto">
                    <amp-img src="images/bg_cs.jpg" layout="responsive" width="522" height="495" alt="" class="placeholder-loader">
                        <div placeholder="" class="placeholder">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300">
                                    <circle class="big" fill="none" stroke="#c2e0e0" stroke-width="3" stroke-dasharray="230" stroke-dashoffset="230" cx="150" cy="150" r="145"></circle>
                                    <circle class="small" fill="none" stroke="#c2e0e0" stroke-width="3" stroke-dasharray="212" cx="150" cy="150" r="135"></circle>
                                </svg></div>
                        
                    </amp-img>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cid-rydBbXv1Q6" id="servers">
	<div class="mbr-overlay"></div>
	<div class="container">
		<div class="title mbr-pb-4 align-center">
			<h3 class="mbr-section-title display-2">SERVIDORES</h3>
		</div>
			
		<div class="mbr-row mbr-jc-c">
			<?php
				require "include/inc_servers.php";
			?>
		</div>
	</div>
</section>

<section class="cid-r9mAPRRSAP" id="downloads">
    <div class="container">
        <div class="title mbr-pb-4 align-center">
            <h3 class="mbr-section-title display-2">DESCARGAS</h3>
        </div>
		
        <div class="mbr-row mbr-jc-c">
            <div class="card mbr-col-sm-12 mbr-col-md-8 mbr-col-lg-4 md-pb">
                <div class="card-wrapper mbr-column">
                    <div class="card-box mbr-m-auto mbr-pt-3 mbr-pb-3 mbr-px-4">
                        <h3 class="card-title display-5">Counter Stirke 1.6</h3>
                        <p class="card-text mbr-pt-2 display-7">Descargar el cliente de counter strike 1.6 no-steam.</p>
                        <div class="card-btn mbr-section-btn mbr-pt-2"><a class="btn btn-primary-outline display-4" href="https://mega.nz/#!AUYmSaoD!Cw3LUqCkhljEliN5Hcu7SI1YvVTjkQTq0laCnJIIya8" target="_blank">Descargar</a></div>
                    </div>
                </div>
            </div>

			<div class="card mbr-col-sm-12 mbr-col-md-8 mbr-col-lg-4 md-pb">
                <div class="card-wrapper mbr-column">
                    <div class="card-box mbr-m-auto mbr-pt-3 mbr-pb-3 mbr-px-4">
                        <h3 class="card-title display-5">Parche v23</h3>
                        <p class="card-text mbr-pt-2 display-7">Descargar el parche para poder jugar on-line.</p>
                        <div class="card-btn mbr-section-btn mbr-pt-2"><a class="btn btn-primary-outline display-4" href="https://mega.nz/#!BFwUCDKJ!_bYhqBda8QEfayBFXuqvngRwU57muljBQNnZvgZhyXM" target="_blank">Descargar</a></div>
                    </div>
                </div>
            </div>
			
			<div class="card mbr-col-sm-12 mbr-col-md-8 mbr-col-lg-4 md-pb">
                <div class="card-wrapper mbr-column">
                    <div class="card-box mbr-m-auto mbr-pt-3 mbr-pb-3 mbr-px-4">
                        <h3 class="card-title display-5">Recursos ZD</h3>
                        <p class="card-text mbr-pt-2 display-7">Descargar los recursos para el servidor zombie destroyer.</p>
                        <div class="card-btn mbr-section-btn mbr-pt-2"><a class="btn btn-primary-outline display-4" href="#" target="_blank">Descargar</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

<?php
	require "footer.php";
?>