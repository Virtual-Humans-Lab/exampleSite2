<?php session_start();

	// Dados para a conexão com banco
	include("../db_connect.php");

	$show_alert = 0;
	$ok = 0;

	if ( isset( $_POST["login"] ) ){

		$show_alert = 1;
		
		$login = $_POST["login"];
		$senha = $_POST["password"];

		// Conecta com o banco de dados
		$conn = mysqli_connect($host, $user, $pass, $db);

		// Teste a conn
		if (!$conn) {
	    	die('Não foi possível conectar: ' . mysql_error());
		}

		// Query para buscar pelos dados do usuário
		$sql = "SELECT
					use_id, per_name as use_name, use_email, use_login, use_password, per_picture as use_img
				FROM
					users, team
				WHERE
					users.id_person = team.per_id AND
					use_login = '$login';";

		// Executa a consulta
		$res = mysqli_query($conn, $sql);

		// Número de retornos
		$rows_count = mysqli_num_rows($res);

		if ($rows_count < 1){

			$ok = 0;

		} else {

			$row = mysqli_fetch_array($res);

			if ( ($row["use_login"] == $login) && ($row["use_password"] == $senha) ){

				$ok = 1;

			} else {

				$ok = 0;

			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../imgs/vhlab.ico">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container" role="login">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-heading" align="center">
							<img src="../imgs/logo_vhlab_brand_b.png">
						</div>
						<div class="panel-body">
							<form role="form" action="index.php" method="POST">
								<fieldset>
									<div class="row">
										<div class="col-sm-12 col-md-10  col-md-offset-1 ">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="glyphicon glyphicon-user"></i>
													</span> 
													<input class="form-control" placeholder="Username" name="login" type="text" autofocus>
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="glyphicon glyphicon-lock"></i>
													</span>
													<input class="form-control" placeholder="Password" name="password" type="password" value="">
												</div>
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
											</div>
										</div>
									</div>
									<?php
										if ($show_alert == 1){
											if ($ok == 1){
												echo "<div class=\"alert alert-success\" role=\"alert\"><b>Well done!</b> Redirecting you...</div>";

												$_SESSION["use_id"] = $row["use_id"];
												$_SESSION["use_name"] = $row["use_name"];
												$_SESSION["use_email"] = $row["use_email"];
												$_SESSION["use_login"] = $row["use_login"];
												$_SESSION["use_password"] = $row["use_password"];
												$_SESSION["use_img"] = $row["use_img"];

												// Redirecionando...
												echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=panel.php'>";

											} else {
												echo "<div class=\"alert alert-danger\" role=\"alert\"><b>Oh snap!</b> Try again...</div>";
											}
										}
									?>
								</fieldset>
							</form>
						</div>
	                </div>
				</div>
			</div>
		</div>

		<!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>