<?php

include('fragments/header.php');
$active = "projects";
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
			<h1 style="font-size: 40px"><b>Projects</b></h1>
		</div>
	</div>
	<div class="row row-centered" style="padding-bottom: 0px;">
		<h3>Discover more about the research currently being done at VHLab!</h3>
		<hr class="star-primary star-projects">
	</div>
	<div class="row row-centered">
		<div class="col-md-11 col-centered" style="padding-bottom: 2px; margin-bottom: 2px;">
			<!-- Projects -->
			<?php 
			$query = "select
						pro_name, pro_members, pro_description, pro_ini_year, pro_fin_year
					from
						projects
					order by
						pro_ini_year desc;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) {
				while ($row = mysqli_fetch_array($res)){ 
					if (($row["pro_fin_year"] != "") AND ($row["pro_fin_year"] != "0000") ) {
						$year = $row["pro_ini_year"]." - ".$row["pro_fin_year"];
						$status = "<span class='label label-success'>Complete</span>";
					} else {
						$year = $row["pro_ini_year"]." - Current";
						$status = "<span class='label label-warning'>In progress</span>";
					} ?>
					<div class="row row-centered">
						<div class="col-md-12 col-centered" style="text-align: left; padding-bottom: 2px; margin-bottom: 2px;">
							<div class="panel panel-default">
								<div class="panel-body">
									<p><h4><b><?php echo $row["pro_name"]." (".$year.")"; ?>  <?php echo $status; ?></b></h4></p>
									<hr>
									<p><b><?php echo $row["pro_members"]; ?></b></p>
									<p style="text-align: justify; font-size: 15px;"><?php echo $row["pro_description"]; ?></p>
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