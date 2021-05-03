<?php include('fragments/header.php');

$active = "team";

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

<!-- Team's page -->
<div role="main" class="col-md-12 minheight">
	<div class="row row-centered">
		<div class="col-md-4 col-centered" style="padding-bottom: 0px;">
			<h1 style="font-size: 40px"><b>Team</b></h1>
		</div>
	</div>
	<div class="row row-centered" style="padding-bottom: 0px;">
		<h3>Meet the VHLab's team, the folks who make the science happen!</h3>
		<hr class="star-primary star-team">
	</div>
	<div class="row row-centered">
		<div class="col-md-10 col-centered" style="padding-bottom: 2px; margin-bottom: 2px;">
			<!-- Lab Founder and Director -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 1
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">Lab Founder and Director</h4><hr>
				<?php while ($row = mysqli_fetch_array($res)){ ?>
					<div class="row row-centered">
						<div class="col-md-12 col-centered">
							<div class="col-md-3 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="170" height="170" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-7 col-centered" role="team-about">
								<h4 class="lab-founder"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 15px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="18px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="18px"> <b>Lattes</b></a></p>
							</div>
						</div>
					</div>
				<?php }
			} ?>

			<!-- Collaborators -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 7
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">Collaborators</h4><hr>
				<div class="row row-centered">
					<div class="col-md-12 col-centered">
						<?php while ($row = mysqli_fetch_array($res)){ ?>
							<div class="col-md-2 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="140" height="140" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-4 col-centered team-people" role="team-about">
								<h4 class="team-people"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 12px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="15px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="15px"> <b>Lattes</b></a></p>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<!-- Postdoctoral Researchers -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 2
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">Postdoctoral Researchers</h4><hr>
				<div class="row row-centered">
					<div class="col-md-12 col-centered">
						<?php while ($row = mysqli_fetch_array($res)){ ?>
							<div class="col-md-2 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="140" height="140" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-4 col-centered team-people" role="team-about">
								<h4 class="team-people"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 12px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="15px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="15px"> <b>Lattes</b></a></p>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<!-- Doctoral Students -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 3
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">Doctoral Students</h4><hr>
				<div class="row row-centered">
					<div class="col-md-12 col-centered">
						<?php while ($row = mysqli_fetch_array($res)){ ?>
							<div class="col-md-2 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="140" height="140" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-4 col-centered team-people" role="team-about">
								<h4 class="team-people"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 12px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="15px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="15px"> <b>Lattes</b></a></p>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<!-- Master Students -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 4
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">Master Students</h4><hr>
				<div class="row row-centered">
					<div class="col-md-12 col-centered">
						<?php while ($row = mysqli_fetch_array($res)){ ?>
							<div class="col-md-2 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="140" height="140" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-4 col-centered team-people" role="team-about">
								<h4 class="team-people"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 12px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="15px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="15px"> <b>Lattes</b></a></p>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<!-- Undergraduate Students -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 5
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">Undergraduate Students</h4><hr>
				<div class="row row-centered">
					<div class="col-md-12 col-centered">
						<?php while ($row = mysqli_fetch_array($res)){ ?>
							<div class="col-md-2 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="140" height="140" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-4 col-centered team-people" role="team-about">
								<h4 class="team-people"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 12px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="15px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="15px"> <b>Lattes</b></a></p>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<!-- Former Students -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 9
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">Former Students</h4><hr>
				<div class="row row-centered">
					<div class="col-md-12 col-centered">
						<?php while ($row = mysqli_fetch_array($res)){ ?>
							<div class="col-md-2 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="140" height="140" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-4 col-centered team-people" role="team-about">
								<h4 class="team-people"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 12px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="15px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="15px"> <b>Lattes</b></a></p>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<!-- High School Students -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 8
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">High School Students</h4><hr>
				<div class="row row-centered">
					<div class="col-md-12 col-centered">
						<?php while ($row = mysqli_fetch_array($res)){ ?>
							<div class="col-md-2 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="140" height="140" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-4 col-centered team-people" role="team-about">
								<h4 class="team-people"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 12px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="15px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="15px"> <b>Lattes</b></a></p>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<!-- Past Students -->
			<?php 
			$query = "select
						deg_abreviation, per_name, per_topics, per_page, per_lattes, per_picture
					from
						team, degrees
					where
						team.deg_id = degrees.deg_id AND
					    team.cat_id = 6
					order by
						per_name;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) { ?>
				<h4 class="text-left">Past Students</h4><hr>
				<div class="row row-centered">
					<div class="col-md-12 col-centered">
						<?php while ($row = mysqli_fetch_array($res)){ ?>
							<div class="col-md-2 col-centered" role="team-pic">
								<img src="imgs/team/<?php echo $row["per_picture"]; ?>" alt="<?php echo $row["per_name"]; ?>" width="140" height="140" class="img-circle img-thumbnail">
							</div>
							<div class="col-md-4 col-centered team-people" role="team-about">
								<h4 class="team-people"><b><?php echo $row["deg_abreviation"]." ".$row["per_name"]; ?></b></h4>
								<p style="font-size: 12px;"><b>Main topic of interest</b>: <?php echo $row["per_topics"]; ?></p>
								<p><a class="btn btn-default" href="<?php echo $row["per_page"]; ?>" role="button"><img src="imgs/ico-p_page.png" width="15px"> <b>Page</b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="<?php echo $row["per_lattes"]; ?>" role="button"><img src="imgs/ico-lattes.png" width="15px"> <b>Lattes</b></a></p>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<div class="row row-centered">
				<div class="col-md-11 col-centered">
					<div class="row row-centered">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-md-4 col-centered div-middle">
									<div class="img-thumbnail" style="width: 100%;">
										<img src="imgs/team/formed.jpg" alt="" width="100%">
									</div>
								</div>
								<div class="col-md-7 col-centered gallery-item">
									<h4><b>Formed Students</b></h4><hr>
									<p class="gallery-text">See all the students (undergraduate, master, PhD and Posdoc) formed at VHLab.</p>
									<br>
									<p><a class="btn btn-default" href="files/Former_students.pdf" role="button">Access here &raquo;</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php //include('fragments/aside.php');

include('fragments/footer.php'); ?>