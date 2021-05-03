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

	$active = "press_releases";

	include('panel_fragments/navbar.php'); ?>

	<div role="main" class="col-md-9 minheight">

<?php

	if (isset($_POST["action"])) {

		if ($_POST["action"] == "new") { ?>
			<br>
			<div class="alert alert-press" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Press Releases</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_press_releases.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-press">Show all</button>
						</form>
					</div>
				</div>
			</div><hr>

			<div align="left">
				<form data-toggle="validator" role="form-group" id="form-group" action="man_press_releases.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="prel_title">Full title</label>
						<input type="text" class="form-control" id="prel_title" name="prel_title" placeholder="Title of the item" required>
					</div>

					<div class="form-group">
						<label for="prel_description">Description</label>
						<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="prel_description" name="prel_description" rows="5" required></textarea>
					</div>

					<div class="form-group">
						<label for="prel_link">Link</label>
						<input type="text" class="form-control" id="prel_link" name="prel_link" placeholder="Example: http://www.baguete.com.br/noticias/20/11/2013/crowdsim-leva-premio-de-inovacao" required>
					</div>

					<div class="form-group">
						<label for="prel_picture">Picture input</label>
						<input type="file" id="prel_picture" name="prel_picture">
					</div>

					<br>
					<input type="hidden" id="action" name="action" value="insert">
					<button type="reset" class="btn btn-default">Clear all</button>							
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div> <?php

		} elseif ($_POST["action"] == "insert") {

			$prel_title = $_POST["prel_title"];
			$prel_link = $_POST["prel_link"];
			$prel_description = $_POST["prel_description"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			if($_FILES["prel_picture"]["name"]!=""){

				$arquivo = $_FILES["prel_picture"];

				// Pega extensão do arquivo
				$ext = explode(".", $arquivo["name"]);

				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())).".".$ext[1];

				// Caminho de onde a imagem ficará
				$imagem_dir = "../imgs/press_releases/" . $imagem_nome;

				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

				$prel_picture = $imagem_nome;

			} else {

				$prel_picture = "press_release.jpg";

			}

			$query_insert = "INSERT INTO press_releases
							(prel_title, prel_description, prel_link, prel_picture, date_change, id_user)
						VALUES
							('$prel_title', '$prel_description', '$prel_link', '$prel_picture', '$date_change', $id_user);";

			$res_insert = mysqli_query($conn, $query_insert);

			if($res_insert){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully signed up a new item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_press_releases.php'>";

			} else { ?>
				<br>
				<div class="alert alert-press" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_press_releases.php'>";
			}
			
		} elseif ($_POST["action"] == "edit") {

			$prel_id = $_POST["prel_id"];

			$query_list = "SELECT * FROM
							press_releases
						WHERE
							prel_id = $prel_id;";

			$res_list = mysqli_query($conn, $query_list);

			if ($res_list){

				$dados = mysqli_fetch_array($res_list);

				$prel_id = $dados["prel_id"];
				$prel_title = $dados["prel_title"];
				$prel_link = $dados["prel_link"];
				$prel_description = $dados["prel_description"];
				$prel_picture = $dados["prel_picture"]; ?>

				<br>
				<div class="alert alert-press" role="alert">
					<div class="row">
						<div class="col-md-10" align="center">
							<b><span style="font-size: 25px">VHLab's Press Releases</span></b>
						</div>
						<div class="col-md-2" align="center">
							<form action="man_press_releases.php" method="POST">
								<button type="submit" name="" value="" class="btn btn-press">Go back</button>
							</form>
						</div>
					</div>
				</div><hr>

				<div align="left">
					<form data-toggle="validator" role="form-group" id="form-group" action="man_press_releases.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" id="prel_id" name="prel_id" value="<?php echo $prel_id;?>">

						<div class="form-group">
							<label for="prel_title">Full title</label>
							<input type="text" class="form-control" id="prel_title" name="prel_title" value="<?php echo $prel_title; ?>" required>
						</div>

						<div class="form-group">
							<label for="prel_description">Description</label>
							<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="prel_description" name="prel_description" rows="5" required><?php echo $prel_description; ?></textarea>
						</div>

						<div class="form-group">
							<label for="prel_link">Link</label>
							<input type="text" class="form-control" id="prel_link" name="prel_link" value="<?php echo $prel_link; ?>" required>
						</div>

						<div class="row">
							<div class="col-md-2" align="center">
								<img src="../imgs/press_releases/<?php echo $prel_picture; ?>" width="120" height="65" img-thumbnail">
							</div>
							<div class="col-md-10">
								<div class="form-group" align="left">
									<label for="prel_picture">Picture input</label>
									<input type="file" id="prel_picture" name="prel_picture">
								</div>
							</div>
						</div>

						<br>
						<input type="hidden" id="action" name="action" value="update">
						<input type="hidden" id="old_picture" name="old_picture" value="<?php echo $prel_picture; ?>">
						<button type="submit" class="btn btn-default">Update</button>
					</form>
				</div>

			<?php } else { ?>

				<br>
				<div class="alert alert-press" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_press_releases.php'>";

			}

			
		} elseif($_POST["action"] == "delete") {

			$prel_id = $_POST["prel_id"];

			$query_delete = "DELETE FROM
									press_releases
								WHERE
									prel_id = $prel_id;";

			$res_delete = mysqli_query($conn, $query_delete);

			if($res_delete){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully delete this item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_press_releases.php'>";

			} else { ?>
				<br>
				<div class="alert alert-press" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_press_releases.php'>";
			}

		} elseif ($_POST["action"] == "update") {
			
			$prel_id = $_POST["prel_id"];
			$prel_title = $_POST["prel_title"];
			$prel_link = $_POST["prel_link"];
			$prel_description = $_POST["prel_description"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			if($_FILES["prel_picture"]["name"]!=""){

				$arquivo = $_FILES["prel_picture"];

				// Pega extensão do arquivo
				$ext = explode(".", $arquivo["name"]);

				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())).".".$ext[1];

				// Caminho de onde a imagem ficará
				$imagem_dir = "../imgs/press_releases/" . $imagem_nome;

				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

				$prel_picture = $imagem_nome;

			} else {

				$prel_picture = $_POST["old_picture"];

			}

			$query_update = "UPDATE press_releases SET
							prel_title = '$prel_title',
							prel_link = '$prel_link',
							prel_description = '$prel_description',
							prel_picture = '$prel_picture',
							date_change = '$date_change',
							id_user = $id_user
						WHERE
							prel_id = $prel_id;";

			$res_update = mysqli_query($conn, $query_update);

			if($res_update){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully update this item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_press_releases.php'>";

			} else { ?>
				<br>
				<div class="alert alert-press" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_press_releases.php'>";
			}

		}

	} else {

		$query = "select
					prel_id, prel_title, prel_description, prel_link, prel_picture, date_change, id_user
				from
					press_releases
				order by
					prel_title;";

			$res = mysqli_query($conn, $query);
			$total_press_releases = mysqli_num_rows($res); ?>
			<br>
			<div class="alert alert-press" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Press Releases</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_press_releases.php" method="POST">
							<button type="submit" name="action" value="new" class="btn btn-press">New item</button>
						</form>
					</div>
				</div>
			</div>
			<?php if ($total_press_releases > 0 ) { ?>
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
										<img src="../imgs/press_releases/<?php echo $row["prel_picture"]; ?>" alt="PICTURE" class="img-thumbnail" width="230" height="100">
									</div>
								</td>
								<td style="vertical-align: middle;">
									<?php echo "<p><b>".$row["prel_title"]."</b></p>"; ?>
								</td>
								<td style="vertical-align: middle;" width="120px">
									<div class="row">
										<div class="col-md-4" align="center">
											<form action="man_press_releases.php" method="POST">
												<input type="hidden" id="prel_id" name="prel_id" value="<?php echo $row["prel_id"]; ?>">
												<input type="hidden" name="action" value="edit">
												<button class="btn btn-press btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-edit"></span></button>
											</form>
										</div>
										<div class="col-md-4" align="center">
											<form action="man_press_releases.php" method="POST">
												<input type="hidden" id="prel_id" name="prel_id" value="<?php echo $row["prel_id"]; ?>">
												<input type="hidden" name="action" value="delete">
												<button class="btn btn-press btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-trash"></span></button>
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