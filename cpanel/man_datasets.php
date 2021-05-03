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

	$active = "datasets";

	include('panel_fragments/navbar.php'); ?>

	<div role="main" class="col-md-9 minheight">

<?php

	if (isset($_POST["action"])) {

		if ($_POST["action"] == "new") { ?>
			<br>
			<div class="alert alert-dataset" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Datasets</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_datasets.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-dataset">Show all</button>
						</form>
					</div>
				</div>
			</div><hr>

			<div align="left">
				<form data-toggle="validator" role="form-group" id="form-group" action="man_datasets.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="dset_title">Full title</label>
						<input type="text" class="form-control" id="dset_title" name="dset_title" placeholder="Title of the item" required>
					</div>

					<div class="form-group">
						<label for="dset_description">Description</label>
						<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="dset_description" name="dset_description" rows="5" required></textarea>
					</div>

					<div class="form-group">
						<label for="dset_link">Link</label>
						<input type="text" class="form-control" id="dset_link" name="dset_link" placeholder="Example: http://www.baguete.com.br/noticias/20/11/2013/crowdsim-leva-premio-de-inovacao" required>
					</div>

					<div class="form-group">
						<label for="dset_picture">Picture input</label>
						<input type="file" id="dset_picture" name="dset_picture">
					</div>

					<div class="form-group">
						<label for="dset_note">Footnote</label>
						<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="dset_note" name="dset_note" rows="5"></textarea>
					</div>

					<br>
					<input type="hidden" id="action" name="action" value="insert">
					<button type="reset" class="btn btn-default">Clear all</button>							
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div> <?php

		} elseif ($_POST["action"] == "insert") {

			$dset_title = $_POST["dset_title"];
			$dset_note = $_POST["dset_note"];
			$dset_link = $_POST["dset_link"];
			$dset_description = $_POST["dset_description"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			if($_FILES["dset_picture"]["name"]!=""){

				$arquivo = $_FILES["dset_picture"];

				// Pega extensão do arquivo
				$ext = explode(".", $arquivo["name"]);

				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())).".".$ext[1];

				// Caminho de onde a imagem ficará
				$imagem_dir = "../imgs/datasets/" . $imagem_nome;

				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

				$dset_picture = $imagem_nome;

			} else {

				$dset_picture = "dataset.jpg";

			}

			$query_insert = "INSERT INTO datasets
							(dset_title, dset_note, dset_description, dset_link, dset_picture, date_change, id_user)
						VALUES
							('$dset_title', '$dset_note', '$dset_description', '$dset_link', '$dset_picture', '$date_change', $id_user);";

			$res_insert = mysqli_query($conn, $query_insert);

			if($res_insert){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully signed up a new item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_datasets.php'>";

			} else { ?>
				<br>
				<div class="alert alert-dataset" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_datasets.php'>";
			}
			
		} elseif ($_POST["action"] == "edit") {

			$dset_id = $_POST["dset_id"];

			$query_list = "SELECT * FROM
							datasets
						WHERE
							dset_id = $dset_id;";

			$res_list = mysqli_query($conn, $query_list);

			if ($res_list){

				$dados = mysqli_fetch_array($res_list);

				$dset_id = $dados["dset_id"];
				$dset_title = $dados["dset_title"];
				$dset_note = $dados["dset_note"];
				$dset_link = $dados["dset_link"];
				$dset_description = $dados["dset_description"];
				$dset_picture = $dados["dset_picture"]; ?>

				<br>
				<div class="alert alert-dataset" role="alert">
					<div class="row">
						<div class="col-md-10" align="center">
							<b><span style="font-size: 25px">VHLab's Datasets</span></b>
						</div>
						<div class="col-md-2" align="center">
							<form action="man_datasets.php" method="POST">
								<button type="submit" name="" value="" class="btn btn-dataset">Go back</button>
							</form>
						</div>
					</div>
				</div><hr>

				<div align="left">
					<form data-toggle="validator" role="form-group" id="form-group" action="man_datasets.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" id="dset_id" name="dset_id" value="<?php echo $dset_id;?>">

						<div class="form-group">
							<label for="dset_title">Full title</label>
							<input type="text" class="form-control" id="dset_title" name="dset_title" value="<?php echo $dset_title; ?>" required>
						</div>

						<div class="form-group">
							<label for="dset_description">Description</label>
							<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="dset_description" name="dset_description" rows="5" required><?php echo $dset_description; ?></textarea>
						</div>

						<div class="form-group">
							<label for="dset_link">Link</label>
							<input type="text" class="form-control" id="dset_link" name="dset_link" value="<?php echo $dset_link; ?>" required>
						</div>

						<div class="row">
							<div class="col-md-2" align="center">
								<img src="../imgs/datasets/<?php echo $dset_picture; ?>" width="120" height="65" img-thumbnail">
							</div>
							<div class="col-md-10">
								<div class="form-group" align="left">
									<label for="dset_picture">Picture input</label>
									<input type="file" id="dset_picture" name="dset_picture">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="dset_note">Footnote</label>
							<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="dset_note" name="dset_note" rows="5"><?php echo $dset_note; ?></textarea>
						</div>
						<br>
						<input type="hidden" id="action" name="action" value="update">
						<input type="hidden" id="old_picture" name="old_picture" value="<?php echo $dset_picture; ?>">
						<button type="submit" class="btn btn-default">Update</button>
					</form>
				</div>

			<?php } else { ?>

				<br>
				<div class="alert alert-dataset" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_datasets.php'>";

			}

			
		} elseif($_POST["action"] == "delete") {

			$dset_id = $_POST["dset_id"];

			$query_delete = "DELETE FROM
									datasets
								WHERE
									dset_id = $dset_id;";

			$res_delete = mysqli_query($conn, $query_delete);

			if($res_delete){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully delete this item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_datasets.php'>";

			} else { ?>
				<br>
				<div class="alert alert-dataset" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_datasets.php'>";
			}

		} elseif ($_POST["action"] == "update") {
			
			$dset_id = $_POST["dset_id"];
			$dset_title = $_POST["dset_title"];
			$dset_note = $_POST["dset_note"];
			$dset_link = $_POST["dset_link"];
			$dset_description = $_POST["dset_description"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			if($_FILES["dset_picture"]["name"]!=""){

				$arquivo = $_FILES["dset_picture"];

				// Pega extensão do arquivo
				$ext = explode(".", $arquivo["name"]);

				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())).".".$ext[1];

				// Caminho de onde a imagem ficará
				$imagem_dir = "../imgs/datasets/" . $imagem_nome;

				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

				$dset_picture = $imagem_nome;

			} else {

				$dset_picture = $_POST["old_picture"];

			}

			$query_update = "UPDATE datasets SET
							dset_title = '$dset_title',
							dset_note = '$dset_note',
							dset_link = '$dset_link',
							dset_description = '$dset_description',
							dset_picture = '$dset_picture',
							date_change = '$date_change',
							id_user = $id_user
						WHERE
							dset_id = $dset_id;";

			$res_update = mysqli_query($conn, $query_update);

			if($res_update){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully update this item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_datasets.php'>";

			} else { ?>
				<br>
				<div class="alert alert-dataset" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_datasets.php'>";
			}

		}

	} else {

		$query = "select
					dset_id, dset_title, dset_description, dset_link, dset_picture, dset_note, date_change, id_user
				from
					datasets
				order by
					dset_title;";

			$res = mysqli_query($conn, $query);
			$total_datasets = mysqli_num_rows($res); ?>
			<br>
			<div class="alert alert-dataset" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Datasets</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_datasets.php" method="POST">
							<button type="submit" name="action" value="new" class="btn btn-dataset">New item</button>
						</form>
					</div>
				</div>
			</div>
			<?php if ($total_datasets > 0 ) { ?>
			<hr>
			<center>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Picture</th>
							<th>Title</th>
							<th align="center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php while ($row = mysqli_fetch_array($res)){ ?>
							<tr>
								<td style="vertical-align: middle;" width="250px">
									<div class="">
										<img src="../imgs/datasets/<?php echo $row["dset_picture"]; ?>" alt="PICTURE" class="img-thumbnail" width="230" height="100">
									</div>
								</td>
								<td style="vertical-align: middle;">
									<?php echo "<p><b>".$row["dset_title"]."</b></p>"; ?>
								</td>
								<td style="vertical-align: middle;" width="120px">
									<div class="row">
										<div class="col-md-4" align="center">
											<form action="man_datasets.php" method="POST">
												<input type="hidden" id="dset_id" name="dset_id" value="<?php echo $row["dset_id"]; ?>">
												<input type="hidden" name="action" value="edit">
												<button class="btn btn-dataset btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-edit"></span></button>
											</form>
										</div>
										<div class="col-md-4" align="center">
											<form action="man_datasets.php" method="POST">
												<input type="hidden" id="dset_id" name="dset_id" value="<?php echo $row["dset_id"]; ?>">
												<input type="hidden" name="action" value="delete">
												<button class="btn btn-dataset btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-trash"></span></button>
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