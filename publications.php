<?php
header('Content-Type: text/html; charset=utf-8');
include('fragments/header.php');
$active = "publications";
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
			<h1 style="font-size: 40px"><b>Publications</b></h1>
		</div>
	</div>
	<div class="row row-centered" style="padding-bottom: 0px;">
		<h3>See some of our publications, including Books, Journals and Conferences!</h3>
		<hr class="star-primary star-publications">
	</div>
	<div class="row row-centered">
		<div class="col-md-11 col-centered" style="padding-bottom: 2px; margin-bottom: 2px;">
			<!-- Projects -->
			<?php 
			$query = "select
						pub_title, pub_authors, pub_type, pub_event, pub_year, pub_doi
					from
						publications
					order by
						pub_type, pub_year desc;";

			$res = mysqli_query($conn, $query);
			$total = mysqli_num_rows($res);

			if ($total > 0) {
				$query_books = "select
						pub_title, pub_authors, pub_type, pub_event, pub_year, pub_doi
					from
						publications
					where
						pub_type = 'Journal papers'
					order by
						pub_type, pub_year desc;";

				$res_books = mysqli_query($conn, $query_books);
				$total_books = mysqli_num_rows($res_books);

				if ($total_books > 0) { ?>
					<div class="row row-centered">
						<div class="col-md-12 col-centered" style="text-align: left; padding-bottom: 2px; margin-bottom: 2px;">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3><b>Journal papers</b> <span class='label label-success'><?php echo $total_books; ?></span></h3>
								</div>
								<div class="panel-body">
									<?php while ($row_books = mysqli_fetch_array($res_books)){
										if ($row_books["pub_doi"] != ""){
											$btn_doi = "<a class=\"btn alert-success btn-xs btn-pub\" href=".$row_books["pub_doi"]." role=\"button\"><b>DOI &raquo;</b></a>";
										} else {
											$btn_doi ="";
										} ?>
										<p class="pub-item"> <?php echo $btn_doi; echo strtoupper($row_books["pub_authors"]); ?>.<b> <?php echo ucwords(strtolower(htmlentities($row_books["pub_title"]))); ?></b>. <?php echo $row_books["pub_event"]; ?>, <?php echo $row_books["pub_year"]; ?>.</p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php }

				$query_books = "select
						pub_title, pub_authors, pub_type, pub_event, pub_year, pub_doi
					from
						publications
					where
						pub_type = 'Conference papers'
					order by
						pub_type, pub_year desc;";

				$res_books = mysqli_query($conn, $query_books);
				$total_books = mysqli_num_rows($res_books);

				if ($total_books > 0) { ?>
					<div class="row row-centered">
						<div class="col-md-12 col-centered" style="text-align: left; padding-bottom: 2px; margin-bottom: 2px;">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3><b>Conference papers</b> <span class='label label-warning'><?php echo $total_books; ?></span></h3>
								</div>
								<div class="panel-body">
									<?php while ($row_books = mysqli_fetch_array($res_books)){ 
										if ($row_books["pub_doi"] != ""){
											$btn_doi = "<a class=\"btn alert-warning btn-xs btn-pub\" href=".$row_books["pub_doi"]." role=\"button\"><b>DOI &raquo;</b></a>";
										} else {
											$btn_doi ="";
										} ?>
										<p class="pub-item"><?php echo $btn_doi; echo strtoupper($row_books["pub_authors"]); ?>.<b> <?php echo ucwords(strtolower(htmlentities($row_books["pub_title"]))); ?></b>. <?php echo $row_books["pub_event"]; ?>, <?php echo $row_books["pub_year"]; ?>.</p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php }

				$query_books = "select
						pub_title, pub_authors, pub_type, pub_event, pub_year, pub_doi
					from
						publications
					where
						pub_type = 'Books'
					order by
						pub_type, pub_year desc;";

				$res_books = mysqli_query($conn, $query_books);
				$total_books = mysqli_num_rows($res_books);

				if ($total_books > 0) { ?>
					<div class="row row-centered">
						<div class="col-md-12 col-centered" style="text-align: left; padding-bottom: 2px; margin-bottom: 2px;">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3><b>Books</b> <span class='label label-danger'><?php echo $total_books; ?></span></h3>
								</div>
								<div class="panel-body">
									<?php while ($row_books = mysqli_fetch_array($res_books)){
										if ($row_books["pub_doi"] != ""){
											$btn_doi = "<a class=\"btn alert-danger btn-xs btn-pub\" href=".$row_books["pub_doi"]." role=\"button\"><b>DOI &raquo;</b></a>";
										} else {
											$btn_doi ="";
										} ?>
										<p class="pub-item"><?php echo $btn_doi; echo strtoupper($row_books["pub_authors"]); ?>.<b> <?php echo ucwords(strtolower(htmlentities($row_books["pub_title"]))); ?></b>. <?php echo $row_books["pub_event"]; ?>, <?php echo $row_books["pub_year"]; ?>.</p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php } 

				$query_chapters = "select
						pub_title, pub_authors, pub_type, pub_event, pub_year, pub_doi
					from
						publications
					where
						pub_type = 'Book chapters'
					order by
						pub_type, pub_year desc;";

				$res_chapters = mysqli_query($conn, $query_chapters);
				$total_chapters = mysqli_num_rows($res_chapters);

				if ($total_chapters > 0) { ?>
					<div class="row row-centered">
						<div class="col-md-12 col-centered" style="text-align: left; padding-bottom: 2px; margin-bottom: 2px;">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3><b>Book chapters</b> <span class='label label-info'><?php echo $total_chapters; ?></span></h3>
								</div>
								<div class="panel-body">
									<?php while ($row_chapters = mysqli_fetch_array($res_chapters)){
										if ($row_books["pub_doi"] != ""){
											$btn_doi = "<a class=\"btn alert-info btn-xs btn-pub\" href=".$row_books["pub_doi"]." role=\"button\"><b>DOI &raquo;</b></a>";
										} else {
											$btn_doi ="";
										} ?>
										<p class="pub-item"><?php echo $btn_doi; echo strtoupper($row_chapters["pub_authors"]); ?>.<b> <?php echo ucwords(strtolower(htmlentities($row_chapters["pub_title"]))); ?></b>. <?php echo $row_chapters["pub_event"]; ?>, <?php echo $row_chapters["pub_year"]; ?>.</p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>

<?php //include('fragments/aside.php');
include('fragments/footer.php'); ?>