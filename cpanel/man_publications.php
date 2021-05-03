<?php
	// Start the session
	session_start();

	if( !isset($_SESSION["use_id"]) ){
		// Redirecionando...
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
	}

	include('panel_fragments/header.php');
	$active = "publications";
	include('panel_fragments/navbar.php');

	// Dados para a conexão com banco
	include("../db_connect.php");

	// Conecta com o banco de dados
	$conn = mysqli_connect($host, $user, $pass, $db); ?>

	<div role="main" class="col-md-9 minheight">

	<?php

	if (isset($_POST["action"])) {

		if ($_POST["action"] == "new") { ?>
			<br>
			<div class="alert alert-warning" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Publications</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_publications.php" method="POST">
							<button type="submit" name="" value="" class="btn btn-warning">Show all</button>
						</form>
					</div>
				</div>
			</div><hr>

			<div align="left">
				<form data-toggle="validator" role="form-group" id="form-group" action="man_publications.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="pub_title">Title</label>
						<input type="text" class="form-control" id="pub_title" name="pub_title" placeholder="Publication title" required>
					</div>

					<div class="form-group">
						<label for="pub_authors">Authors</label>
						<textarea class="form-control" data-ls-module="charCounter" maxlength="150" id="pub_authors" name="pub_authors" rows="3" required></textarea>
					</div>

					<div class="form-group">
						<label for="pub_event">Conference/Journal/Publishing company</label>
						<input type="text" class="form-control" id="pub_event" name="pub_event" placeholder="Conference/Journal/Publishing company" required>
					</div>

					<div class="row">
						<div class="col-md-6" align="left">
							<div class="form-group" align="left">
								<label for="pub_type">Publication type</label>
								<select class="form-control" id="pub_type" name="pub_type" required>
									<option value="Conference papers">Conference papers</option>
									<option value="Journal papers">Journal papers</option>
									<option value="Book chapters">Book chapters</option>
									<option value="Books">Books</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" align="left">
								<label for="pub_year">Year</label>
								<input type="text" class="form-control" id="pub_year" name="pub_year" placeholder="Year" required>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="pub_doi">DOI (or page)</label>
						<input type="text" class="form-control" id="pub_doi" name="pub_doi" placeholder="Example: http://dx.doi.org/10.1002/cav.1423">
					</div>

					<br>
					<input type="hidden" id="action" name="action" value="insert">
					<button type="reset" class="btn btn-default">Clear all</button>							
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div> <?php

		} elseif ($_POST["action"] == "insert") {

			$pub_title = $_POST["pub_title"];
			$pub_authors = $_POST["pub_authors"];
			$pub_type = $_POST["pub_type"];
			$pub_event = $_POST["pub_event"];
			$pub_year = $_POST["pub_year"];
			$pub_doi = $_POST["pub_doi"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			$query_insert = "INSERT INTO publications
							(pub_title, pub_authors, pub_type, pub_event, pub_year, pub_doi, date_change, id_user)
						VALUES
							('$pub_title', '$pub_authors', '$pub_type', '$pub_event', '$pub_year', '$pub_doi', '$date_change', $id_user);";

			$res_insert = mysqli_query($conn, $query_insert);

			if($res_insert){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully signed up a new publication. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_publications.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_publications.php'>";
			}
			
		} elseif ($_POST["action"] == "edit") {

			$pub_id = $_POST["pub_id"];

			$query_list = "SELECT * FROM
							publications
						WHERE
							pub_id = $pub_id;";

			$res_list = mysqli_query($conn, $query_list);

			if ($res_list){

				$dados = mysqli_fetch_array($res_list);

				$pub_id = $dados["pub_id"];
				$pub_title = $dados["pub_title"];
				$pub_authors = $dados["pub_authors"];
				$pub_type = $dados["pub_type"];
				$pub_event = $dados["pub_event"];
				$pub_year = $dados["pub_year"];
				$pub_doi = $dados["pub_doi"]; ?>

				<br>
				<div class="alert alert-warning" role="alert">
					<div class="row">
						<div class="col-md-10" align="center">
							<b><span style="font-size: 25px">VHLab's Publications</span></b>
						</div>
						<div class="col-md-2" align="center">
							<form action="man_publications.php" method="POST">
								<button type="submit" name="" value="" class="btn btn-warning">Go back</button>
							</form>
						</div>
					</div>
				</div><hr>

				<div align="left">
					<form data-toggle="validator" role="form-group" id="form-group" action="man_publications.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" id="pub_id" name="pub_id" value="<?php echo $pub_id; ?>">

						<div class="form-group">
							<label for="pub_title">Title</label>
							<input type="text" class="form-control" id="pub_title" name="pub_title" value="<?php echo $pub_title; ?>" required>
						</div>

						<div class="form-group">
							<label for="pub_authors">Authors</label>
							<textarea class="form-control" data-ls-module="charCounter" maxlength="150" id="pub_authors" name="pub_authors" rows="3" required><?php echo $pub_authors; ?></textarea>
						</div>

						<div class="form-group">
							<label for="pub_event">Conference/Journal/Publishing company</label>
							<input type="text" class="form-control" id="pub_event" name="pub_event" value="<?php echo $pub_event; ?>" required>
						</div>

						<div class="row">
							<div class="col-md-6" align="left">
								<div class="form-group" align="left">
									<label for="pub_type">Publication type</label>
									<select class="form-control" id="pub_type" name="pub_type" required>
										<option value="Conference papers" <?php echo ($pub_type == "Conference papers") ? "selected": ""; ?>>Conference papers</option>
										<option value="Journal papers" <?php echo ($pub_type == "Journal papers") ? "selected": ""; ?>>Journal papers</option>
										<option value="Book chapters" <?php echo ($pub_type == "Book chapters") ? "selected": ""; ?>>Book chapters</option>
										<option value="Books" <?php echo ($pub_type == "Books") ? "selected": ""; ?>>Books</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" align="left">
									<label for="pub_year">Year</label>
									<input type="text" class="form-control" id="pub_year" name="pub_year" value="<?php echo $pub_year; ?>" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="pub_doi">DOI (or page)</label>
							<input type="text" class="form-control" id="pub_doi" name="pub_doi" value="<?php echo $pub_doi; ?>">
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
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_publications.php'>";

			}

			
		} elseif($_POST["action"] == "delete") {

			$pub_id = $_POST["pub_id"];

			$query_delete = "DELETE FROM
									publications
								WHERE
									pub_id = $pub_id;";

			$res_delete = mysqli_query($conn, $query_delete);

			if($res_delete){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully delete this publication. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_publications.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_publications.php'>";
			}

		} elseif ($_POST["action"] == "update") {
			
			$pub_id = $_POST["pub_id"];
			$pub_title = $_POST["pub_title"];
			$pub_authors = $_POST["pub_authors"];
			$pub_type = $_POST["pub_type"];
			$pub_event = $_POST["pub_event"];
			$pub_year = $_POST["pub_year"];
			$pub_doi = $_POST["pub_doi"];
			$date_change = date("Y-m-d");
			$id_user = $_SESSION["use_id"];

			$query_update = "UPDATE publications SET
							pub_title = '$pub_title',
							pub_authors = '$pub_authors',
							pub_type = '$pub_type',
							pub_event = '$pub_event',
							pub_year = '$pub_year',
							pub_doi = '$pub_doi',
							date_change = '$date_change',
							id_user = $id_user
						WHERE
							pub_id = $pub_id;";

			$res_update = mysqli_query($conn, $query_update);

			if($res_update){ ?>
				<br>
				<div class="alert alert-success" role="alert">
					<b>Well done</b>! You successfully update this publication. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_publications.php'>";

			} else { ?>
				<br>
				<div class="alert alert-danger" role="alert">
					<b>Oh snap</b>! Something went wrong. Try again. Redirecting you...
				</div>

				<?php // Redirecionando...
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=man_publications.php'>";
			}

		}

	} else {

		$query = "select
					pub_id, pub_title, pub_authors, pub_type, pub_event, pub_year, pub_doi, date_change, id_user
				from
					publications
				order by
					pub_year DESC, pub_title;";

			$res = mysqli_query($conn, $query);
			$total_publications = mysqli_num_rows($res); ?>
			<br>
			<div class="alert alert-warning" role="alert">
				<div class="row">
					<div class="col-md-10" align="center">
						<b><span style="font-size: 25px">VHLab's Publications</span></b>
					</div>
					<div class="col-md-2" align="center">
						<form action="man_publications.php" method="POST">
							<button type="submit" name="action" value="new" class="btn btn-warning">New item</button>
						</form>
					</div>
				</div>
			</div>
			<?php if ($total_publications > 0 ) { ?>
			<hr>
			<center>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Title</th>
							<th>Type</th>
							<th>Year</th>
							<th align="center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						while ($row = mysqli_fetch_array($res)){ ?>
							<tr>
								<td style="vertical-align: middle;">
									<?php echo $row["pub_title"]; ?>
								</td>
								<td style="vertical-align: middle;" width="170px">
									<?php echo $row["pub_type"]; ?>
								</td>
								<td style="vertical-align: middle;">
									<?php echo $row["pub_year"]; ?>
								</td>
								<td style="vertical-align: middle;" width="120px">
									<div class="row">
										<div class="col-md-4" align="center">
											<form action="man_publications.php" method="POST">
												<input type="hidden" id="pub_id" name="pub_id" value="<?php echo $row["pub_id"]; ?>">
												<input type="hidden" name="action" value="edit">
												<button class="btn btn-warning btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-edit"></span></button>
											</form>
										</div>
										<div class="col-md-4" align="center">
											<form action="man_publications.php" method="POST">
												<input type="hidden" id="pub_id" name="pub_id" value="<?php echo $row["pub_id"]; ?>">
												<input type="hidden" name="action" value="delete">
												<button class="btn btn-warning btn-xs" type="submit"><span style="font-size:1.5em;" class="glyphicon glyphicon-trash"></span></button>
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