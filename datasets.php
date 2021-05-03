<?php

include('fragments/header.php');
$active = "datasets";
include('fragments/navbar.php');

// Conecta com o banco de dados
$conn = mysqli_connect($host, $user, $pass, $db);

// If you happen to use the dataset, please refer to the following paper:

?>

<div role="main" class="col-md-12 minheight">
	<div class="row row-centered">
		<div class="col-md-4 col-centered" style="padding-bottom: 0px;">
			<h1 style="font-size: 40px"><b>Datasets</b></h1>
		</div>
	</div>
	<div class="row row-centered" style="padding-bottom: 0px;">
		<h3>Take a look at the datasets and tools developed in our researches!</h3>
		<hr class="star-primary star-datasets">
	</div>
	<div class="row row-centered">
		<div class="col-md-11 col-centered" style="padding-bottom: 2px; margin-bottom: 2px;">
			<!-- Datasets -->
			<?php $query = "select
					dset_id, dset_title, dset_description, dset_link, dset_picture, dset_note, date_change, id_user
				from
					datasets
				order by
					dset_title;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) {
				while ($row = mysqli_fetch_array($res)){ 
					if ($row["dset_note"] != ""){
						$span = "<small><span class='label label-info'>*</span></small>";
						$footnote = "<div class='row row-centered'>
									<small><span class='label label-info'>*</span> ".$row["dset_note"]."</small>
								</div>";
					} else{
						$span = "";
						$footnote = "";
					} ?>

					<div class="row row-centered">
						<div class="col-md-11 col-centered">
							<div class="row row-centered">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="col-md-5 col-centered div-middle">
											<div class="img-thumbnail" style="width: 100%;">
												<img src="imgs/datasets/<?php echo $row["dset_picture"]; ?>" alt="" width="100%">
											</div>
										</div>
										<div class="col-md-7 col-centered gallery-item">
											<h4><b><?php echo $row["dset_title"]; ?></b> <?php echo " ".$span; ?></h4><hr>
											<p class="gallery-text"><?php echo $row["dset_description"]; ?></p>
											<br>
											<p><a class="btn btn-default" href="<?php echo $row["dset_link"]; ?>" role="button">Access here &raquo;</a></p>
										</div>
										<?php echo $footnote; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php }
			} ?>			
		</div>
	</div>
</div>

<?php //include('fragments/aside.php');
include('fragments/footer.php'); ?>