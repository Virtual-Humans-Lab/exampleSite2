<?php

include('fragments/header.php');
$active = "press_releases";
include('fragments/navbar.php'); 

// Conecta com o banco de dados
$conn = mysqli_connect($host, $user, $pass, $db); ?>

<div role="main" class="col-md-12 minheight">
	<div class="row row-centered">
		<div class="col-md-4 col-centered" style="padding-bottom: 0px;">
			<h1 style="font-size: 40px"><b>Press Releases</b></h1>
		</div>
	</div>
	<div class="row row-centered">
		<h3>Take a look what the press has to say about our works!</h3>
		<hr class="star-primary star-press_releases">
	</div>
	<div class="row row-centered">
		<div class="col-md-11 col-centered" style="padding-bottom: 2px; margin-bottom: 2px;">
			<!-- Press releases -->
			<?php 
			$query = "select
				prel_id, prel_title, prel_description, prel_link, prel_picture, date_change, id_user
			from
				press_releases
			order by
				prel_title;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) {
				while ($row = mysqli_fetch_array($res)){ ?>
					<div class="col-md-6 col-centered">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="img-thumbnail" style="width: 100%;">
									<img src="imgs/press_releases/<?php echo $row["prel_picture"]; ?>" alt="" width="100%">
								</div>
								<h4><b><?php echo $row["prel_title"]; ?></b></h4><hr>
								<p class="press_release-text"><?php echo $row["prel_description"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["prel_link"]; ?>" role="button">Access here</a></p>
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