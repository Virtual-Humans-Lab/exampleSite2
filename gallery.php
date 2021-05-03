<?php include('fragments/header.php');

$active = "gallery";

include('fragments/navbar.php'); 

// Conecta com o banco de dados
$conn = mysqli_connect($host, $user, $pass, $db);

$query = "select
				gal_id, gal_title, gal_authors, gal_description, gal_video, gal_doi
			from
				gallery
			order by
				gal_title;";

$res = mysqli_query($conn, $query);	?>

<div role="main" class="col-md-12 minheight">
	<div class="row row-centered">
		<div class="col-md-4 col-centered" style="padding-bottom: 0px;">
			<h1 style="font-size: 40px"><b>Gallery</b></h1>
		</div>
	</div>
	<div class="row row-centered">
		<h3>Take a look at some results from our recently researches!</h3>
		<hr class="star-primary star-gallery">
	</div>
	<br>
	<?php

	$position = 1;

	while ($row = mysqli_fetch_array($res)){
		if($position == 1) { $position = 0; ?>
			<div class="row row-centered">
				<div class="col-md-11 col-centered">
					<div class="row row-centered">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-md-6 col-centered">
									<div class="img-thumbnail" style="width: 100%;">
										<div class="embed-responsive embed-responsive-4by3">
											<iframe class="embed-responsive-item" src="<?php echo $row["gal_video"]; ?>"></iframe>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-centered gallery-item">
									<h4><b><?php echo $row["gal_title"]; ?></b></h4><hr>
									<p class=""><b><?php echo $row["gal_authors"]; ?></b></p>
									<p class="gallery-text"><?php echo $row["gal_description"]; ?></p>
									<br>
									<p><a class="btn btn-default" href="<?php echo $row["gal_doi"]; ?>" role="button">Access channel &raquo;</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } else { $position = 1; ?>
			<div class="row row-centered">
				<div class="col-md-11 col-centered">
					<div class="row row-centered">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-md-6 col-centered gallery-item">
									<h4><b><?php echo $row["gal_title"]; ?></b></h4><hr>
									<p class=""><b><?php echo $row["gal_authors"]; ?></b></p>
									<p class="gallery-text"><?php echo $row["gal_description"]; ?></p>
									<br>
									<p><a class="btn btn-default" href="<?php echo $row["gal_doi"]; ?>" role="button">Access paper &raquo;</a></p>
								</div>
								<div class="col-md-6 col-centered">
									<div class="img-thumbnail" style="width: 100%;">
										<div class="embed-responsive embed-responsive-4by3">
											<iframe class="embed-responsive-item" src="<?php echo $row["gal_video"]; ?>"></iframe>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php }
	} ?>
</div>
<?php //include('fragments/aside.php');
include('fragments/footer.php'); ?>