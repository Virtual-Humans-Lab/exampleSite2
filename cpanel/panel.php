<?php
	// Start the session
	session_start();

	if( !isset($_SESSION["use_id"]) ){
		// Redirecionando...
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
	}

	include('panel_fragments/header.php');

	$active = "panel";

	include('panel_fragments/navbar.php');

	// Dados para a conexão com banco
	include("../db_connect.php");

	// Conecta com o banco de dados
	$conn = mysqli_connect($host, $user, $pass, $db);

	/* --- --- --- --- --- --- Gallery data --- --- --- --- --- --- */
	$query_cont_gallery = "SELECT 
						COUNT(gal_id) as qtde_gallery
					FROM
						gallery;";

	$res_cont_gallery = mysqli_query($conn, $query_cont_gallery);

	if ($res_cont_gallery){
		$dados = mysqli_fetch_array($res_cont_gallery);
		$cont_gallery = $dados["qtde_gallery"];
	}

	if ($cont_gallery > 0) {

		$query_update_gallery = "SELECT 
									MAX(gallery.date_change) as date_change,
								    per_name as user
								FROM
									gallery, users, team
								WHERE
									gallery.id_user = users.use_id AND
								    users.id_person = team.per_id AND
								    gallery.date_change = (SELECT MAX(date_change) FROM gallery);";

		$res_update_gallery = mysqli_query($conn, $query_update_gallery);
		$dados_update_gallery = mysqli_fetch_array($res_update_gallery);
		$temp_data = explode("-", $dados_update_gallery["date_change"]);
		$date_gallery = $temp_data[2]."/".$temp_data[1]."/".$temp_data[0];
		$temp_user = explode(" ", $dados_update_gallery["user"]);
		$user_gallery = $temp_user[0];

	} else {
		$date_gallery = " never";
		$user_gallery = " nobody";
	}

	/* --- --- --- --- --- --- Team data --- --- --- --- --- --- */
	$query_cont_team = "SELECT 
						COUNT(per_id) as qtde_team
					FROM
						team;";

	$res_cont_team = mysqli_query($conn, $query_cont_team);

	if ($res_cont_team){
		$dados = mysqli_fetch_array($res_cont_team);
		$cont_team = $dados["qtde_team"];
	}

	if ($cont_team > 0) {

		$query_update_team = "SELECT 
								MAX(team.date_change) as date_change,
								team.id_user as user_cod,
							    (select team.per_name from team where team.per_id = user_cod) as user
							FROM
								team, users
							WHERE
								team.date_change = (SELECT MAX(team.date_change) FROM team);";

		$res_update_team = mysqli_query($conn, $query_update_team);
		$dados_update_team = mysqli_fetch_array($res_update_team);
		$temp_data = explode("-", $dados_update_team["date_change"]);
		$date_team = $temp_data[2]."/".$temp_data[1]."/".$temp_data[0];
		$temp_user = explode(" ", $dados_update_team["user"]);
		$user_team = $temp_user[0];

	} else {
		$date_team = " never";
		$user_team = " nobody";
	}

	/* --- --- --- --- --- --- Projects data --- --- --- --- --- --- */
	$query_cont_projects = "SELECT 
						COUNT(pro_id) as qtde_projects
					FROM
						projects;";

	$res_cont_projects = mysqli_query($conn, $query_cont_projects);

	if ($res_cont_projects){
		$dados = mysqli_fetch_array($res_cont_projects);
		$cont_projects = $dados["qtde_projects"];
	}

	if ($cont_projects > 0) {

		$query_update_projects = "SELECT 
									MAX(projects.date_change) as date_change,
								    per_name as user
								FROM
									projects, users, team
								WHERE
								    projects.id_user = users.use_id AND
								    users.id_person = team.per_id AND
								    projects.date_change = (SELECT MAX(date_change) FROM projects);";

		$res_update_projects = mysqli_query($conn, $query_update_projects);
		$dados_update_projects = mysqli_fetch_array($res_update_projects);
		$temp_data = explode("-", $dados_update_projects["date_change"]);
		$date_projects = $temp_data[2]."/".$temp_data[1]."/".$temp_data[0];
		$temp_user = explode(" ", $dados_update_projects["user"]);
		$user_projects = $temp_user[0];

	} else {
		$date_projects = " never";
		$user_projects = " nobody";
	}

	/* --- --- --- --- --- --- Publications data --- --- --- --- --- --- */
	$query_cont_publications = "SELECT 
						COUNT(pub_id) as qtde_publications
					FROM
						publications;";

	$res_cont_publications = mysqli_query($conn, $query_cont_publications);

	if ($res_cont_publications){
		$dados = mysqli_fetch_array($res_cont_publications);
		$cont_publications = $dados["qtde_publications"];
	}

	if ($cont_publications > 0) {

		$query_update_publications = "SELECT 
									MAX(publications.date_change) as date_change,
								    per_name as user
								FROM
									publications, users, team
								WHERE
								    publications.id_user = users.use_id AND
								    users.id_person = team.per_id AND
								    publications.date_change = (SELECT MAX(date_change) FROM publications);";

		$res_update_publications = mysqli_query($conn, $query_update_publications);
		$dados_update_publications = mysqli_fetch_array($res_update_publications);
		$temp_data = explode("-", $dados_update_publications["date_change"]);
		$date_publications = $temp_data[2]."/".$temp_data[1]."/".$temp_data[0];
		$temp_user = explode(" ", $dados_update_publications["user"]);
		$user_publications = $temp_user[0];

	} else {
		$date_publications = " never";
		$user_publications = " nobody";
	}


	/* --- --- --- --- --- --- Datasets data --- --- --- --- --- --- */
	$query_cont_datasets = "SELECT 
						COUNT(dset_id) as qtde_datasets
					FROM
						datasets;";

	$res_cont_datasets = mysqli_query($conn, $query_cont_datasets);

	if ($res_cont_datasets){
		$dados = mysqli_fetch_array($res_cont_datasets);
		$cont_datasets = $dados["qtde_datasets"];
	}

	if ($cont_datasets > 0) {

		$query_update_datasets = "SELECT 
									MAX(datasets.date_change) as date_change,
								    per_name as user
								FROM
									datasets, users, team
								WHERE
								    datasets.id_user = users.use_id AND
								    users.id_person = team.per_id AND
								    datasets.date_change = (SELECT MAX(date_change) FROM datasets);";

		$res_update_datasets = mysqli_query($conn, $query_update_datasets);
		$dados_update_datasets = mysqli_fetch_array($res_update_datasets);
		$temp_data = explode("-", $dados_update_datasets["date_change"]);
		$date_datasets = $temp_data[2]."/".$temp_data[1]."/".$temp_data[0];
		$temp_user = explode(" ", $dados_update_datasets["user"]);
		$user_datasets = $temp_user[0];

	} else {
		$date_datasets = " never";
		$user_datasets = " nobody";
	}


	/* --- --- --- --- --- --- Press Releases data --- --- --- --- --- --- */
	$query_cont_press_releases = "SELECT 
						COUNT(prel_id) as qtde_press_releases
					FROM
						press_releases;";

	$res_cont_press_releases = mysqli_query($conn, $query_cont_press_releases);

	if ($res_cont_press_releases){
		$dados = mysqli_fetch_array($res_cont_press_releases);
		$cont_press_releases = $dados["qtde_press_releases"];
	}

	if ($cont_press_releases > 0) {

		$query_update_press_releases = "SELECT 
									MAX(press_releases.date_change) as date_change,
								    per_name as user
								FROM
									press_releases, users, team
								WHERE
								    press_releases.id_user = users.use_id AND
								    users.id_person = team.per_id AND
								    press_releases.date_change = (SELECT MAX(date_change) FROM press_releases);";

		$res_update_press_releases = mysqli_query($conn, $query_update_press_releases);
		$dados_update_press_releases = mysqli_fetch_array($res_update_press_releases);
		$temp_data = explode("-", $dados_update_press_releases["date_change"]);
		$date_press_releases = $temp_data[2]."/".$temp_data[1]."/".$temp_data[0];
		$temp_user = explode(" ", $dados_update_press_releases["user"]);
		$user_press_releases = $temp_user[0];

	} else {
		$date_press_releases = " never";
		$user_press_releases = " nobody";
	}

	?>

	<div role="main" class="col-md-9 minheight">
	<br>
		<h3 class="text-center"><b>Select an option below to start managing</b></h3>
		<hr class="star-primary star-index">
		<div class="row">
			<div class="col-md-6">
				<div class="alert alert-success">
					<div class="row">
						<h4><b> Projects </b></h4><hr>
						<div role="panel-icon" class="col-md-4">
							<span style="font-size: 7em" class="glyphicon glyphicon-tasks"></span>
						</div>
						<div role="panel-content" class="col-md-8">
							<h4><p align="left" class="font-panel"> Total of itens: <b><?php echo $cont_projects; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Last update: <b><?php echo $date_projects; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Updated by: <b><?php echo $user_projects; ?></b>.</p></h4>
						</div>
					</div>
					<hr><div>
						<form action="man_projects.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-success" style="margin-right: 40px;">Show all</button>
							<button type="submit" name="action" value="new" class="btn btn-success">New project</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert alert-info">
					<div class="row">
						<h4><b> Team </b></h4><hr>
						<div role="panel-icon" class="col-md-4">
							<span style="font-size: 7em" class="glyphicon glyphicon-user"></span>
						</div>
						<div role="panel-content" class="col-md-8">
							<h4><p align="left" class="font-panel"> Total of itens: <b><?php echo $cont_team; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Last update: <b><?php echo $date_team; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Updated by: <b><?php echo $user_team; ?></b>.</p></h4>
						</div>
					</div>
					<hr><div>
						<form action="man_team.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-info" style="margin-right: 40px;">Show all</button>
							<button type="submit" name="action" value="new" class="btn btn-info">New person</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="alert alert-warning">
					<div class="row">
						<h4><b> Publications </b></h4><hr>
						<div role="panel-icon" class="col-md-4">
							<span style="font-size: 7em" class="glyphicon glyphicon-book"></span>
						</div>
						<div role="panel-content" class="col-md-8">
							<h4><p align="left" class="font-panel"> Total of itens: <b><?php echo $cont_publications; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Last update: <b><?php echo $date_publications; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Updated by: <b><?php echo $user_publications; ?></b>.</p></h4>
						</div>
					</div>
					<hr><div>
						<form action="man_publications.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-warning" style="margin-right: 40px;">Show all</button>
							<button type="submit" name="action" value="new" class="btn btn-warning">New publication</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert alert-danger">
					<div class="row">
						<h4><b> Gallery </b></h4><hr>
						<div role="panel-icon" class="col-md-4">
							<span style="font-size: 7em" class="glyphicon glyphicon-facetime-video"></span>
						</div>
						<div role="panel-content" class="col-md-8">
							<h4><p align="left" class="font-panel"> Total of itens: <b><?php echo $cont_gallery; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Last update: <b><?php echo $date_gallery; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Updated by: <b><?php echo $user_gallery; ?></b>.</p></h4>
						</div>
					</div>
					<hr><div>
						<form action="man_gallery.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-danger" style="margin-right: 40px;">Show all</button>
							<button type="submit" name="action" value="new" class="btn btn-danger">New item</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="alert alert-dataset">
					<div class="row">
						<h4><b> Datasets </b></h4><hr>
						<div role="panel-icon" class="col-md-4">
							<span style="font-size: 6.2em;" class="glyphicon glyphicon-cloud-download"></span>
						</div>
						<div role="panel-content" class="col-md-8">
							<h4><p align="left" class="font-panel"> Total of itens: <b><?php echo $cont_datasets; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Last update: <b><?php echo $date_datasets; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Updated by: <b><?php echo $user_datasets; ?></b>.</p></h4>
						</div>
					</div>
					<hr><div>
						<form action="man_datasets.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-dataset" style="margin-right: 40px;">Show all</button>
							<button type="submit" name="action" value="new" class="btn btn-dataset">New dataset</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert alert-press">
					<div class="row">
						<h4><b> Press Releases </b></h4><hr>
						<div role="panel-icon" class="col-md-4">
							<span style="font-size: 6.2em" class="glyphicon glyphicon-info-sign"></span>
						</div>
						<div role="panel-content" class="col-md-8">
							<h4><p align="left" class="font-panel"> Total of itens: <b><?php echo $cont_press_releases; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Last update: <b><?php echo $date_press_releases; ?></b>.</p></h4>
							<h4><p align="left" class="font-panel"> Updated by: <b><?php echo $user_press_releases; ?></b>.</p></h4>
						</div>
					</div>
					<hr><div>
						<form action="man_press_releases.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-press" style="margin-right: 40px;">Show all</button>
							<button type="submit" name="action" value="new" class="btn btn-press">New item</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include('panel_fragments/aside.php');
	include('panel_fragments/footer.php');
	//session_unset(); 
	//session_destroy(); 
?>