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

	$active = "gallery";

	include('panel_fragments/navbar.php'); ?>

	<div role="main" class="col-md-9 minheight">

<?php

	if (isset($_POST["action"])) {

		if ($_POST["action"] == "new") { ?>
			<br>
			<div class="alert alert-danger" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Gallery</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_gallery.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-danger">Show all</button>
						</form>
					</div>
				</div>
			</div><hr>

			<div align="left">
				<form data-toggle="validator" role="form-group" id="form-group" action="man_gallery.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="gal_title">Full title</label>
						<input type="text" class="form-control" id="gal_title" name="gal_title" placeholder="Title of the item" required>
					</div>

					<div class="form-group">
						<label for="gal_authors">Authors</label>
						<input type="text" class="form-control" id="gal_authors" name="gal_authors" placeholder="All the names" required>
					</div>

					<div class="form-group">
						<label for="gal_video">Video (Embedded link)</label>
						<input type="text" class="form-control" id="gal_video" name="gal_video" placeholder="Example: https://www.youtube.com/embed/IwOTjS_CQuY" required>
					</div>

					<div class="form-group">
						<label for="gal_description">Description</label>
						<textarea class="form-control" data-ls-module="charCounter" maxlength="500" id="gal_description" name="gal_description" rows="5" required></textarea>
					</div>

					<div class="form-group">
						<label for="gal_doi">DOI (Or paper's page)</label>
						<input type="text" class="form-control" id="gal_doi" name="gal_doi" placeholder="Example: http://dx.doi.org/10.1002/cav.1423">
					</div>

					<br>
					<input type="hidden" id="action" name="action" value="insert">
					<button type="reset" class="btn btn-default">Clear all</button>							
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div> <?php

		} elseif ($_POST["action"] == "insert") {

			$gal_title = $_POST["gal_title"];
			$gal_authors = $_POST["gal_authors"];
			$gal_video = $_POST["gal_video"];
			$gal_description = $_POST["gal_description"];
			$gal_doi = $_POST["gal_doi"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			$query_insert = "INSERT INTO gallery
							(gal_title, gal_authors, gal_description, gal_video, gal_doi, date_change, id_user)
						VALUES
							('$gal_title', '$gal_authors', '$gal_description', '$gal_video', '$gal_doi', '$date_change', $id_user);";

			$res_insert = mysqli_query($conn, $query_insert);

			if($res_insert){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully signed up a new item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_gallery.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_gallery.php'>";
			}
			
		} elseif ($_POST["action"] == "edit") {

			$gal_id = $_POST["gal_id"];

			$query_list = "SELECT * FROM
							gallery
						WHERE
							gal_id = $gal_id;";

			$res_list = mysqli_query($conn, $query_list);

			if ($res_list){

				$dados = mysqli_fetch_array($res_list);

				$gal_id = $dados["gal_id"];
				$gal_title = $dados["gal_title"];
				$gal_authors = $dados["gal_authors"];
				$gal_video = $dados["gal_video"];
				$gal_description = $dados["gal_description"];
				$gal_doi = $dados["gal_doi"]; ?>

				<br>
				<div class="alert alert-danger" role="alert">
					<div class="row">
						<div class="col-md-10" align="center">
							<b><span style="font-size: 25px">VHLab's Gallery</span></b>
						</div>
						<div class="col-md-2" align="center">
							<form action="man_gallery.php" method="POST">
								<button type="submit" name="" value="" class="btn btn-danger">Go back</button>
							</form>
						</div>
					</div>
				</div><hr>

				<div align="left">
					<form data-toggle="validator" role="form-group" id="form-group" action="man_gallery.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" id="gal_id" name="gal_id" value="<?php echo $gal_id;?>">

						<div class="form-group">
							<label for="gal_title">Full title</label>
							<input type="text" class="form-control" id="gal_title" name="gal_title" value="<?php echo $gal_title; ?>" required>
						</div>

						<div class="form-group">
							<label for="gal_authors">Authors</label>
							<input type="text" class="form-control" id="gal_authors" name="gal_authors" value="<?php echo $gal_authors; ?>" required>
						</div>

						<div class="form-group">
							<label for="gal_video">Video (Embedded link)</label>
							<input type="text" class="form-control" id="gal_video" name="gal_video" value="<?php echo $gal_video; ?>" required>
						</div>

						<div class="form-group">
							<label for="gal_description">Description</label>
							<textarea class="form-control" data-ls-module="charCounter" maxlength="500"  id="gal_description" name="gal_description" rows="5" required><?php echo $gal_description; ?></textarea>
						</div>

						<div class="form-group">
							<label for="gal_doi">DOI (Optional)</label>
							<input type="text" class="form-control" id="gal_doi" name="gal_doi" value="<?php echo $gal_doi; ?>">
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
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_gallery.php'>";

			}

			
		} elseif($_POST["action"] == "delete") {

			$gal_id = $_POST["gal_id"];

			$query_delete = "DELETE FROM
									gallery
								WHERE
									gal_id = $gal_id;";

			$res_delete = mysqli_query($conn, $query_delete);

			if($res_delete){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully delete this item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_gallery.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_gallery.php'>";
			}

		} elseif ($_POST["action"] == "update") {
			
			$gal_id = $_POST["gal_id"];
			$gal_title = $_POST["gal_title"];
			$gal_authors = $_POST["gal_authors"];
			$gal_video = $_POST["gal_video"];
			$gal_description = $_POST["gal_description"];
			$gal_doi = $_POST["gal_doi"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			$query_update = "UPDATE gallery SET
							gal_title = '$gal_title',
							gal_authors = '$gal_authors',
							gal_video = '$gal_video',
							gal_description = '$gal_description',
							gal_doi = '$gal_doi',
							date_change = '$date_change',
							id_user = $id_user
						WHERE
							gal_id = $gal_id;";

			$res_update = mysqli_query($conn, $query_update);

			if($res_update){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully update this item. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_gallery.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_gallery.php'>";
			}

		}

	} else {

		$query = "select
					gal_id, gal_title, gal_authors, gal_description, gal_video, gal_doi, date_change, id_user
				from
					gallery
				order by
					gal_title;";

			$res = mysqli_query($conn, $query);
			$total_gallery = mysqli_num_rows($res); ?>
			<br>
			<div class="alert alert-danger" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Gallery</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_gallery.php" method="POST">
							<button type="submit" name="action" value="new" class="btn btn-danger">New item</button>
						</form>
					</div>
				</div>
			</div>
			<?php if ($total_gallery > 0 ) { ?>
			<hr>
			<center>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Thumbnail</th>
							<th>Title</th>
							<th align="center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php while ($row = mysqli_fetch_array($res)){ ?>
							<tr>
								<td style="vertical-align: middle;">
									<div class="embed-responsive embed-responsive-4by3">
										<iframe class="embed-responsive-item" src="<?php echo $row["gal_video"]; ?>"></iframe>
									</div>
								</td>
								<td style="vertical-align: middle;">
									<?php echo "<p><b>".$row["gal_title"]."</b></p>"; ?>
								</td>
								<td style="vertical-align: middle;" width="120px">
									<div class="row">
										<div class="col-md-4" align="center">
											<form action="man_gallery.php" method="POST">
												<input type="hidden" id="gal_id" name="gal_id" value="<?php echo $row["gal_id"]; ?>">
												<input type="hidden" name="action" value="edit">
												<button class="btn btn-danger btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-edit"></span></button>
											</form>
										</div>
										<div class="col-md-4" align="center">
											<form action="man_gallery.php" method="POST">
												<input type="hidden" id="gal_id" name="gal_id" value="<?php echo $row["gal_id"]; ?>">
												<input type="hidden" name="action" value="delete">
												<button class="btn btn-danger btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-trash"></span></button>
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