<?php

if (isset($_POST['admlogout-submit'])) {
	session_start();
	session_unset();

	session_destroy();
	header("Location: ../index.php");
}
else {
	header("Location: ../index.php");
	exit();
}

?>