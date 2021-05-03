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

	$active = "team";

	include('panel_fragments/navbar.php'); ?>

	<div role="main" class="col-md-9 minheight">

	<?php

		# print_r($_POST);
		# print_r($_FILES);

		if (isset($_POST["action"])) {

			if ($_POST["action"] == "new") { ?>
				<br>
				<div class="alert alert-info" role="alert">
					<div class="row">
						<div class="col-md-10" align="center">
							<b><span style="font-size: 25px">VHLab's Team</span></b>
						</div>
						<div class="col-md-2" align="center">
							<form action="man_team.php" method="POST">
								<button type="submit" name="" value="" class="btn btn-info">Show all</button>
							</form>
						</div>
					</div>
				</div><hr>

				<div align="left">
					<form data-toggle="validator" role="form-group" id="form-group" action="man_team.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="per_name">Full name</label>
							<input type="text" class="form-control" id="per_name" name="per_name" placeholder="Full Name" required>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group" align="left">
									<label for="cat_id">Select the category</label>
									<select class="form-control" id="cat_id" name="cat_id" required>
										<option value="3">D.Sc. Students</option>
										<option value="1">Lab Founder and Director</option>
										<option value="2">Postdoc Researchers</option>
										<option value="4">M.Sc. Students</option>
										<option value="5">Undergraduate Students</option>
										<option value="6">Past Students</option>
										<option value="7">Collaborators</option>
										<option value="8">High School Students</option>
										<option value="9">Former Students</option>
									</select>
								</div>
							</div>
							<div class="col-md-6" align="left">
								<div class="form-group" align="left">
									<label for="deg_id">Select the degree</label>
									<select class="form-control" id="deg_id" name="deg_id" required>
										<option value="1">D.Sc. - Doctor of Science</option>
										<option value="2">M.Sc. - Master of Science</option>
										<option value="3">B.Sc. - Bachelor of Science</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="per_topics">Topics of interest</label>
							<textarea class="form-control" id="per_topics" name="per_topics" rows="3" required></textarea>
						</div>

						<div class="form-group">
							<label for="per_lattes">Curriculum lattes</label>
							<input type="text" class="form-control" id="per_lattes" name="per_lattes" placeholder="Example: http://lattes.cnpq.br/0433008527802538">
						</div>

						<div class="form-group">
							<label for="per_page">Personal Page</label>
							<input type="text" class="form-control" id="per_page" name="per_page" placeholder="Example: http://personalpage.com">
						</div>

						<div class="form-group">
							<label for="per_picture">Picture input</label>
							<input type="file" id="per_picture" name="per_picture">
						</div>
						<br>
						<input type="hidden" id="action" name="action" value="insert">
						<button type="reset" class="btn btn-default">Clear all</button>							
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div> <?php

			} elseif ($_POST["action"] == "insert") {

				$per_name = $_POST["per_name"];
				$per_topics = $_POST["per_topics"];
				$per_page = $_POST["per_page"];
				$per_lattes = $_POST["per_lattes"];
				$cat_id = $_POST["cat_id"];
				$deg_id = $_POST["deg_id"];
				$date_change = date("Y-m-d");
				$id_user = $_SESSION["use_id"];

				if($_FILES["per_picture"]["name"]!=""){

					$arquivo = $_FILES["per_picture"];

					// Pega extensão do arquivo
					$ext = explode(".", $arquivo["name"]);

					// Gera um nome único para a imagem
					$imagem_nome = md5(uniqid(time())).".".$ext[1];

					// Caminho de onde a imagem ficará
					$imagem_dir = "../imgs/team/" . $imagem_nome;

					// Faz o upload da imagem
					move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

					$per_picture = $imagem_nome;

				} else {

					$per_picture = "user.png";

				}

				$query_insert = "INSERT INTO team
								(per_name, per_topics, per_page, per_lattes, per_picture, cat_id, deg_id, date_change, id_user)
							VALUES
								('$per_name', '$per_topics', '$per_page', '$per_lattes', '$per_picture', $cat_id, $deg_id, '$date_change', $id_user);";

				$res_insert = mysqli_query($conn, $query_insert);

				if($res_insert){ ?>
					<br>
					<div class="alert alert-success" role="alert">
						<b>Well done</b>! You successfully signed up a new member. Redirecting you...
					</div>

					<?php // Redirecionando...
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_team.php'>";

				} else { ?>
					<br>
					<div class="alert alert-danger" role="alert">
						<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
					</div>

					<?php // Redirecionando...
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_team.php'>";
				}
				
			} elseif ($_POST["action"] == "edit") {

				$per_id = $_POST["per_id"];

				$query_list = "SELECT * FROM
								team
							WHERE
								per_id = $per_id;";

				$res_list = mysqli_query($conn, $query_list);

				if ($res_list){

					$dados = mysqli_fetch_array($res_list);

					$per_id = $dados["per_id"];
					$per_name = $dados["per_name"];
					$per_topics = $dados["per_topics"];
					$per_page = $dados["per_page"];
					$per_lattes = $dados["per_lattes"];
					$per_picture = $dados["per_picture"];
					$cat_id = $dados["cat_id"];
					$deg_id = $dados["deg_id"]; ?>

					<br>
					<div class="alert alert-info" role="alert">
						<div class="row">
							<div class="col-md-10" align="center">
								<b><span style="font-size: 25px">VHLab's Team</span></b>
							</div>
							<div class="col-md-2" align="center">
								<form action="man_team.php" method="POST">
									<button type="submit" name="" value="" class="btn btn-info">Go back</button>
								</form>
							</div>
						</div>
					</div><hr>

					<div align="left">
						<form data-toggle="validator" role="form-group" id="form-group" action="man_team.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" id="per_id" name="per_id" value="<?php echo $per_id;?>">

							<div class="form-group">
								<label for="per_name">Full name</label>
								<input type="text" class="form-control" id="per_name" name="per_name" value="<?php echo $per_name;?>" required>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group" align="left">
										<label for="cat_id">Select the category</label>
										<select class="form-control" id="cat_id" name="cat_id" required>
											<option value="3" <?php echo ($cat_id == 3) ? "selected": ""; ?>>D.Sc. Students</option>
											<option value="1" <?php echo ($cat_id == 1) ? "selected": ""; ?>>Lab Founder and Director</option>
											<option value="2" <?php echo ($cat_id == 2) ? "selected": ""; ?>>Postdoc Researchers</option>
											<option value="4" <?php echo ($cat_id == 4) ? "selected": ""; ?>>M.Sc. Students</option>
											<option value="5" <?php echo ($cat_id == 5) ? "selected": ""; ?>>Undergraduate Students</option>
											<option value="6" <?php echo ($cat_id == 6) ? "selected": ""; ?>>Past Students</option>
											<option value="7" <?php echo ($cat_id == 7) ? "selected": ""; ?>>Collaborators</option>
											<option value="8" <?php echo ($cat_id == 8) ? "selected": ""; ?>>High School Students</option>
											<option value="9" <?php echo ($cat_id == 9) ? "selected": ""; ?>>Former Students</option>
										</select>
									</div>
								</div>
								<div class="col-md-6" align="left">
									<div class="form-group" align="left">
										<label for="deg_id">Select the degree</label>
										<select class="form-control" id="deg_id" name="deg_id" required>
											<option value="1" <?php echo ($deg_id == 1) ? "selected": ""; ?>>D.Sc. - Doctor of Science</option>
											<option value="2" <?php echo ($deg_id == 2) ? "selected": ""; ?>>M.Sc. - Master of Science</option>
											<option value="3" <?php echo ($deg_id == 3) ? "selected": ""; ?>>B.Sc. - Bachelor of Science</option>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="per_topics">Topics of interest</label>
								<textarea class="form-control" id="per_topics" name="per_topics" rows="3" required><?php echo $per_topics; ?></textarea>
							</div>

							<div class="form-group">
								<label for="per_lattes">Curriculum lattes</label>
								<input type="text" class="form-control" id="per_lattes" name="per_lattes" value="<?php echo $per_lattes; ?>">
							</div>

							<div class="form-group">
								<label for="per_page">Personal Page</label>
								<input type="text" class="form-control" id="per_page" name="per_page" value="<?php echo $per_page; ?>">
							</div>

							<div class="row">
								<div class="col-md-2" align="center">
									<img src="../imgs/team/<?php echo $per_picture; ?>" width="60" height="60" class="img-circle img-thumbnail">
								</div>
								<div class="col-md-10">
									<div class="form-group" align="left">
										<label for="per_picture">Picture input</label>
										<input type="file" id="per_picture" name="per_picture">
									</div>
								</div>
							</div>
							<br>
							<input type="hidden" id="action" name="action" value="update">
							<input type="hidden" id="old_picture" name="old_picture" value="<?php echo $per_picture; ?>">
							<button type="submit" class="btn btn-default">Update</button>
						</form>
					</div>

				<?php } else { ?>

					<br>
					<div class="alert alert-danger" role="alert">
						<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
					</div>

					<?php // Redirecionando...
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_team.php'>";

				}

				
			} elseif($_POST["action"] == "delete") {

				$per_id = $_POST["per_id"];

				$query_delete = "DELETE FROM
										team
									WHERE
										per_id = $per_id;";

				$res_delete = mysqli_query($conn, $query_delete);

				if($res_delete){ ?>
					<br>
					<div class="alert alert-success" role="alert">
						<b>Well done</b>! You successfully delete this member. Redirecting you...
					</div>

					<?php // Redirecionando...
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_team.php'>";

				} else { ?>
					<br>
					<div class="alert alert-danger" role="alert">
						<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
					</div>

					<?php // Redirecionando...
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_team.php'>";
				}

			} elseif ($_POST["action"] == "update") {
				
				$per_id = $_POST["per_id"];
				$per_name = $_POST["per_name"];
				$per_topics = $_POST["per_topics"];
				$per_page = $_POST["per_page"];
				$per_lattes = $_POST["per_lattes"];
				$cat_id = $_POST["cat_id"];
				$deg_id = $_POST["deg_id"];
				$date_change = date("Y-m-d");
				$id_user = $_SESSION["use_id"];

				if($_FILES["per_picture"]["name"]!=""){

					$arquivo = $_FILES["per_picture"];

					// Pega extensão do arquivo
					$ext = explode(".", $arquivo["name"]);

					// Gera um nome único para a imagem
					$imagem_nome = md5(uniqid(time())).".".$ext[1];

					// Caminho de onde a imagem ficará
					$imagem_dir = "../imgs/team/" . $imagem_nome;

					// Faz o upload da imagem
					move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

					$per_picture = $imagem_nome;

				} else {

					$per_picture = $_POST["old_picture"];

				}

				$query_update = "UPDATE team SET
								per_name = '$per_name',
								per_topics = '$per_topics',
								per_page = '$per_page',
								per_lattes = '$per_lattes',
								per_picture = '$per_picture',
								cat_id = $cat_id,
								deg_id = $deg_id,
								date_change = '$date_change',
								id_user = $id_user
							WHERE
								per_id = $per_id;";

				$res_update = mysqli_query($conn, $query_update);

				if($res_update){ ?>
					<br>
					<div class="alert alert-success" role="alert">
						<b>Well done</b>! You successfully update this member. Redirecting you...
					</div>

					<?php // Redirecionando...
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_team.php'>";

				} else { ?>
					<br>
					<div class="alert alert-danger" role="alert">
						<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
					</div>

					<?php // Redirecionando...
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_team.php'>";
				}

			}

		} else {

			$query = "select
						per_id, deg_abreviation, per_name, cat_description, per_picture, date_change, id_user
					from
						team t, degrees d, team_category c
					where
						t.deg_id = d.deg_id AND
						t.cat_id = c.cat_id
					order by
						per_name;";

				$res = mysqli_query($conn, $query);
				$total_team = mysqli_num_rows($res); ?>
				<br>
				<div class="alert alert-info" role="alert">
					<div class="row">
						<div class="col-md-10" align="center">
							<b><span style="font-size: 25px">VHLab's Team</span></b>
						</div>
						<div class="col-md-2" align="center">
							<form action="man_team.php" method="POST">
								<button type="submit" name="action" value="new" class="btn btn-info">New person</button>
							</form>
						</div>
					</div>
				</div>
				<?php if ($total_team > 0 ) { ?>
				<hr>
				<center>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Picture</th>
								<th>Degree</th>
								<th>Name</th>
								<th>Category</th>
								<th align="center">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php while ($row = mysqli_fetch_array($res)){ ?>
								<tr>
									<td style="vertical-align: middle;"><img src="../imgs/team/<?php echo $row["per_picture"]; ?>" width="55" height="55" class="img-circle img-thumbnail"></td>
									<td style="vertical-align: middle;"><?php echo $row["deg_abreviation"]; ?></td>
									<td style="vertical-align: middle;"><?php echo $row["per_name"]; ?></td>
									<td style="vertical-align: middle;"><?php echo $row["cat_description"]; ?></td>
									<td style="vertical-align: middle;" width="120px">
										<div class="row">
											<div class="col-md-4" align="center">
												<form action="man_team.php" method="POST">
													<input type="hidden" id="per_id" name="per_id" value="<?php echo $row["per_id"]; ?>">
													<input type="hidden" name="action" value="edit">
													<button class="btn btn-info btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-edit"></span></button>
												</form>
											</div>
											<div class="col-md-4" align="center">
												<form action="man_team.php" method="POST">
													<input type="hidden" id="per_id" name="per_id" value="<?php echo $row["per_id"]; ?>">
													<input type="hidden" name="action" value="delete">
													<button class="btn btn-info btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-trash"></span></button>
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
?>
