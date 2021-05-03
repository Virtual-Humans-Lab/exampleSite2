<aside role="complementary" class="col-md-3">

	<center>
		<div>
			<?php $use_name = $_SESSION["use_name"];
			$use_img = $_SESSION["use_img"];
			$use_id = $_SESSION["use_id"];

			// Dados para a conexão com banco
			include("../db_connect.php");

			// Conecta com o banco de dados
			$conn = mysqli_connect($host, $user, $pass, $db);

			$query = "select
						(SELECT COUNT(pro_id) FROM projects WHERE id_user = $use_id) as qtde_projects,
					    (SELECT COUNT(per_id) FROM team WHERE id_user = $use_id) as qtde_team,
					    (SELECT COUNT(pub_id) FROM publications WHERE id_user = $use_id) as qtde_publications,
					    (SELECT COUNT(gal_id) FROM gallery WHERE id_user = $use_id) as qtde_gallery,
					    (SELECT COUNT(dset_id) FROM datasets WHERE id_user = $use_id) as qtde_datasets,
					    (SELECT COUNT(prel_id) FROM press_releases WHERE id_user = $use_id) as qtde_press_releases;";

			$res = mysqli_query($conn, $query);
			$totals = mysqli_fetch_array($res);

			$qtde_projects = $totals["qtde_projects"];
			$qtde_team = $totals["qtde_team"];
			$qtde_publications = $totals["qtde_publications"];
			$qtde_gallery = $totals["qtde_gallery"];
			$qtde_datasets = $totals["qtde_datasets"];
			$qtde_press_releases = $totals["qtde_press_releases"]; ?>

			<br><img src="../imgs/team/<?php echo $use_img; ?>" alt="user" width="200" height="200" class="img-circle img-thumbnail">
			<br><h4>Welcome back,</h4>
			<h3><b><?php echo $use_name; ?></b></h3>
			<hr class="">
			<div class="row">
				<h4>Your items</h4>
			</div>
			<div class="row">
				<div class="alert alert-success panel-aside">
					<div class="col-md-2" style="padding-top: 15px; margin-bottom: 5px;">
						<div class="alert-success img-circle" align="center" style="width: 50px; height: 50px; padding-top: 7px; border: 2px solid #3C763D;">
							<span style="font-size: 32px" class="glyphicon glyphicon-tasks"></span>
						</div>
					</div>
					<div class="col-md-10" style="padding-top: 12px; margin-bottom: 5px;">
						<p style="padding-top: -2px; margin-bottom: 6px;"><h4><b>Projects</b></h4></p>
						<p>Total of projects: <b><?php echo $qtde_projects; ?></b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="alert alert-warning panel-aside">
					<div class="col-md-2" style="padding-top: 15px; margin-bottom: 5px;">
						<div class="alert-warning img-circle" align="center" style="width: 50px; height: 50px; padding-top: 6px; border: 2px solid #8A6D3B;">
							<span style="font-size: 32px" class="glyphicon glyphicon-book"></span>
						</div>
					</div>
					<div class="col-md-10" style="padding-top: 12px; margin-bottom: 5px;">
						<p style="padding-top: -2px; margin-bottom: 6px;"><h4><b>Publications</b></h4></p>
						<p>Total of publications: <b><?php echo $qtde_publications; ?></b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="alert alert-danger panel-aside">
					<div class="col-md-3" style="padding-top: 15px; margin-bottom: 5px;">
						<div class="alert-danger img-circle" align="center" style="width: 50px; height: 50px; padding-top: 6px; border: 2px solid #A94442;">
							<span style="font-size: 32px" class="glyphicon glyphicon-facetime-video"></span>
						</div>
					</div>
					<div class="col-md-9" style="padding-top: 12px; margin-bottom: 5px;">
						<p style="padding-top: -2px; margin-bottom: 6px;"><h4><b>Gallery</b></h4></p>
						<p>Total of items: <b><?php echo $qtde_gallery; ?></b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="alert alert-info panel-aside">
					<div class="col-md-3" style="padding-top: 15px; margin-bottom: 5px;">
						<div class="alert-info img-circle" align="center" style="width: 50px; height: 50px; padding-top: 4px; border: 2px solid #31708F;">
							<span style="font-size: 32px" class="glyphicon glyphicon-user"></span>
						</div>
					</div>
					<div class="col-md-9" style="padding-top: 12px; margin-bottom: 5px;">
						<p style="padding-top: -2px; margin-bottom: 6px;"><h4><b>Team</b></h4></p>
						<p>Total of people: <b><?php echo $qtde_team; ?></b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="alert alert-dataset panel-aside">
					<div class="col-md-3" style="padding-top: 15px; margin-bottom: 5px;">
						<div class="alert-dataset img-circle" align="center" style="width: 50px; height: 50px; padding-top: 4px; border: 2px solid #993366;">
							<span style="font-size: 32px" class="glyphicon glyphicon-cloud-download"></span>
						</div>
					</div>
					<div class="col-md-9" style="padding-top: 12px; margin-bottom: 5px;">
						<p style="padding-top: -2px; margin-bottom: 6px;"><h4><b>Datasets</b></h4></p>
						<p>Total of datasets: <b><?php echo $qtde_datasets; ?></b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="alert alert-press panel-aside">
					<div class="col-md-3" style="padding-top: 15px; margin-bottom: 5px;">
						<div class="alert-press img-circle" align="center" style="width: 50px; height: 50px; padding-top: 6px; border: 2px solid #444;">
							<span style="font-size: 32px" class="glyphicon glyphicon-info-sign"></span>
						</div>
					</div>
					<div class="col-md-9" style="padding-top: 12px; margin-bottom: 5px;">
						<p style="padding-top: -2px; margin-bottom: 6px;"><h4><b>Press Releases</b></h4></p>
						<p>Total of releases: <b><?php echo $qtde_press_releases; ?></b></p>
					</div>
				</div>
			</div>
		</div>
	</center>
</aside>