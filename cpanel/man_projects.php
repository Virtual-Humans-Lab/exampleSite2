<?php
	// Start the session
	session_start();

	if( !isset($_SESSION["use_id"]) ){
		// Redirecionando...
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
	}

	// Dados para a conexão com banco
	include("../db_connect.php");

	// Conecta com o banco de dados
	$conn = mysqli_connect($host, $user, $pass, $db);

	include('panel_fragments/header.php');

	$active = "projects";

	include('panel_fragments/navbar.php'); ?>

	<div role="main" class="col-md-9 minheight">

<?php

	if (isset($_POST["action"])) {

		if ($_POST["action"] == "new") { ?>
			<br>
			<div class="alert alert-success" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Projects</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_projects.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-success">Show all</button>
						</form>
					</div>
				</div>
			</div><hr>

			<div align="left">
				<form data-toggle="validator" role="form-group" id="form-group" action="man_projects.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="pro_name">Project name</label>
						<input type="text" class="form-control" id="pro_name" name="pro_name" placeholder="Project name" required>
					</div>

					<div class="form-group">
						<label for="pro_description">Description</label>
						<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="pro_description" name="pro_description" rows="5" required></textarea>
					</div>

					<div class="form-group">
						<label for="pro_members">Members</label>
						<textarea class="form-control" data-ls-module="charCounter" maxlength="200" id="pro_members" name="pro_members" rows="5" required></textarea>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group" align="left">
								<label for="pro_ini_year">Initial year</label>
								<input type="text" class="form-control" id="pro_ini_year" name="pro_ini_year" placeholder="Year" required>
							</div>
						</div>

						<div class="col-md-6" align="left">
							<div class="form-group" align="left">
								<label for="pro_fin_year">Final year</label>
								<input type="text" class="form-control" id="pro_fin_year" name="pro_fin_year" placeholder="Year">
							</div>
						</div>
					</div>

					<br>
					<input type="hidden" id="action" name="action" value="insert">
					<button type="reset" class="btn btn-default">Clear all</button>							
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div> <?php

		} elseif ($_POST["action"] == "insert") {

			$pro_name = $_POST["pro_name"];
			$pro_description = $_POST["pro_description"];
			$pro_members = $_POST["pro_members"];
			$pro_ini_year = $_POST["pro_ini_year"];
			$pro_fin_year = $_POST["pro_fin_year"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			$query_insert = "INSERT INTO projects
							(pro_name, pro_description, pro_members, pro_ini_year, pro_fin_year, date_change, id_user)
						VALUES
							('$pro_name', '$pro_description', '$pro_members', '$pro_ini_year', '$pro_fin_year', '$date_change', $id_user);";

			$res_insert = mysqli_query($conn, $query_insert);

			if($res_insert){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully signed up a new project. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_projects.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_projects.php'>";
			}
			
		} elseif ($_POST["action"] == "edit") {

			$pro_id = $_POST["pro_id"];

			$query_list = "SELECT * FROM
							projects
						WHERE
							pro_id = $pro_id;";

			$res_list = mysqli_query($conn, $query_list);

			if ($res_list){

				$dados = mysqli_fetch_array($res_list);

				$pro_id = $dados["pro_id"];
				$pro_name = $dados["pro_name"];
				$pro_description = $dados["pro_description"];
				$pro_members = $dados["pro_members"];
				$pro_ini_year = $dados["pro_ini_year"];
				$pro_fin_year = $dados["pro_fin_year"]; ?>

				<br>
				<div class="alert alert-success" role="alert">
					<div class="row">
						<div class="col-md-10" align="center">
							<b><span style="font-size: 25px">VHLab's Projects</span></b>
						</div>
						<div class="col-md-2" align="center">
							<form action="man_projects.php" method="POST">
								<button type="submit" name="" value="" class="btn btn-success">Go back</button>
							</form>
						</div>
					</div>
				</div><hr>

				<div align="left">
					<form data-toggle="validator" role="form-group" id="form-group" action="man_projects.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" id="pro_id" name="pro_id" value="<?php echo $pro_id;?>">

						<div class="form-group">
							<label for="pro_name">Project name</label>
							<input type="text" class="form-control" id="pro_name" name="pro_name" value="<?php echo $pro_name;?>" required>
						</div>

						<div class="form-group">
							<label for="pro_description">Description</label>
							<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="pro_description" name="pro_description" rows="5" required><?php echo $pro_description; ?></textarea>
						</div>

						<div class="form-group">
							<label for="pro_members">Members</label>
							<textarea class="form-control" data-ls-module="charCounter" maxlength="200" id="pro_members" name="pro_members" rows="5" required><?php echo $pro_members; ?></textarea>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group" align="left">
									<label for="pro_ini_year">Initial year</label>
									<input type="text" class="form-control" id="pro_ini_year" name="pro_ini_year" value="<?php echo $pro_ini_year;?>" required>
								</div>
							</div>

							<div class="col-md-6" align="left">
								<div class="form-group" align="left">
									<label for="pro_fin_year">Final year</label>
									<input type="text" class="form-control" id="pro_fin_year" name="pro_fin_year" value="<?php echo $pro_fin_year;?>">
								</div>
							</div>
						</div>
						<br>
						<input type="hidden" id="action" name="action" value="update">
						<button type="submit" class="btn btn-default">Update</button>
					</form>
				</div>

			<?php } else { ?>

				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_projects.php'>";

			}

			
		} elseif($_POST["action"] == "delete") {

			$pro_id = $_POST["pro_id"];

			$query_delete = "DELETE FROM
									projects
								WHERE
									pro_id = $pro_id;";

			$res_delete = mysqli_query($conn, $query_delete);

			if($res_delete){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully delete this project. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_projects.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_projects.php'>";
			}

		} elseif ($_POST["action"] == "update") {
			
			$pro_id = $_POST["pro_id"];
			$pro_name = $_POST["pro_name"];
			$pro_description = $_POST["pro_description"];
			$pro_members = $_POST["pro_members"];
			$pro_ini_year = $_POST["pro_ini_year"];
			$pro_fin_year = $_POST["pro_fin_year"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			$query_update = "UPDATE projects SET
							pro_name = '$pro_name',
							pro_description = '$pro_description',
							pro_members = '$pro_members',
							pro_ini_year = '$pro_ini_year',
							pro_fin_year = '$pro_fin_year',
							date_change = '$date_change',
							id_user = $id_user
						WHERE
							pro_id = $pro_id;";

			$res_update = mysqli_query($conn, $query_update);

			if($res_update){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully update this project. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_projects.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_projects.php'>";
			}

		}

	} else {

		$query = "select
					pro_id, pro_name, pro_description, pro_members, pro_ini_year, pro_fin_year, date_change, id_user
				from
					projects
				order by
					pro_id DESC;";

			$res = mysqli_query($conn, $query);
			$total_projects = mysqli_num_rows($res); ?>
			<br>
			<div class="alert alert-success" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Projects</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_projects.php" method="POST">
							<button type="submit" name="action" value="new" class="btn btn-success">New item</button>
						</form>
					</div>
				</div>
			</div>
			<?php if ($total_projects > 0 ) { ?>
			<hr>
			<center>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Project name</th>
							<th>Period</th>
							<th align="center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						while ($row = mysqli_fetch_array($res)){
							if ($row["pro_fin_year"] != "") {
								$pro_period = $row["pro_ini_year"]." - ".$row["pro_fin_year"];
							} else {
								$pro_period = $row["pro_ini_year"]." - Current";
							} ?>
							<tr>
								<td style="vertical-align: middle;">
									<?php echo $row["pro_name"]; ?>
								</td>
								<td style="vertical-align: middle;" width="150px">
									<?php echo $pro_period; ?>
								</td>
								<td style="vertical-align: middle;" width="120px">
									<div class="row">
										<div class="col-md-4" align="center">
											<form action="man_projects.php" method="POST">
												<input type="hidden" id="pro_id" name="pro_id" value="<?php echo $row["pro_id"]; ?>">
												<input type="hidden" name="action" value="edit">
												<button class="btn btn-success btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-edit"></span></button>
											</form>
										</div>
										<div class="col-md-4" align="center">
											<form action="man_projects.php" method="POST">
												<input type="hidden" id="pro_id" name="pro_id" value="<?php echo $row["pro_id"]; ?>">
												<input type="hidden" name="action" value="delete">
												<button class="btn btn-success btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-trash"></span></button>
											</form>
										</div>
									</div>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</center>
		<?php } } ?>

	</div>

	<?php
	include('panel_fragments/aside.php');
	include('panel_fragments/footer.php');
	//session_unset(); 
	//session_destroy(); 
?>