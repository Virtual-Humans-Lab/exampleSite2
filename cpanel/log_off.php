<?php
	
	// Start the session
	session_start();

	if( !isset($_SESSION["use_id"]) ){
		// Redirecionando...
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
	}

	include('panel_fragments/header.php');

	$active = "log_off";

	include('panel_fragments/navbar.php'); ?>

	<div role="main" class="col-md-9">

		<p>

			<?php

				echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=index.php'>";

			?>

		</p>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	</div>

	<?php
	include('panel_fragments/aside.php');

	include('panel_fragments/footer.php');

	session_unset();
	session_destroy();
	
?>