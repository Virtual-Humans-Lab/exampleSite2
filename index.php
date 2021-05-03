<?php
header('Content-Type: text/html; charset=utf-8');
include('fragments/header.php');

$active = "home";

include('fragments/navbar.php'); ?>

<div role="main" class="col-md-12 minheight">
	<br><br>
	<div class="row row-centered">
		<div class="col-md-10 col-centered">
			<center><img class="img-responsive" src="imgs/profile.png" width="300" height="300"></center>
			<h1 style="font-size: 60px"><b>Welcome to VHLab</b></h1>
			<hr class="star-primary star-index">
			<p style="font-size: 20px">Created in 2007, VHLab develops research on Computer Graphics, Crowd Simulation, Computer Vision, Facial Animation, Virtual Human Simulation, among others.</p>
			<!--<p><a class="btn btn-default" href="contact.php" role="button">Contact us</a></p>-->
		</div>
	</div>
	<!--<br><hr><br>--><br><hr><br><br>
	<div class="row row-centered">
		<div class="col-md-3 col-centered" align="center">
			<center>
				<div class="alert-success img-circle" align="center" style="width: 120px; height: 120px; padding-top: 20px; border: 3px solid #3C763D;">
					<span style="font-size: 5em" class="glyphicon glyphicon-tasks"></span>
				</div>
				<h4><b>Projects</b></h4><hr>
		        <p>Discover more about the research currently being done at VHLab.</p>
		        <p><a class="btn btn-default" href="projects.php" role="button">View details</a></p>
		    </center>
		</div>
		<div class="col-md-3 col-centered" align="center">
			<center>
				<div class="alert-warning img-circle" align="center" style="width: 120px; height: 120px; padding-top: 18px; border: 3px solid #8A6D3B;">
					<span style="font-size: 5em" class="glyphicon glyphicon-book"></span>
				</div>
				<h4><b>Publications</b></h4><hr>
		        <p>See some of our publications, including Books, Journals and Conferences.</p>
		        <p><a class="btn btn-default" href="publications.php" role="button">View details</a></p>
		    </center>
		</div>
	</div>
	<div class="row row-centered">
		<div class="col-md-3 col-centered" align="center">
			<center>
				<div class="alert-info img-circle" align="center" style="width: 120px; height: 120px; padding-top: 12px; border: 3px solid #31708F;">
					<span style="font-size: 5em" class="glyphicon glyphicon-user"></span>
				</div>
				<h4><b>Team</b></h4><hr>
		        <p>Meet the VHLab's team, the folks who make the science happen.</p>
		        <p><a class="btn btn-default" href="team.php" role="button">View details</a></p>
		    </center>
		</div>
		<div class="col-md-3 col-centered" align="center">
			<center>
				<div class="alert-danger img-circle" align="center" style="width: 120px; height: 120px; padding-top: 18px; border: 3px solid #A94442;">
					<span style="font-size: 5em" class="glyphicon glyphicon-facetime-video"></span>
				</div>
				<h4><b>Gallery</b></h4><hr>
		        <p>Take a look at some results from our recently researches.</p>
		        <p><a class="btn btn-default" href="gallery.php" role="button">View details</a></p>
		    </center>
		</div>
		<div class="col-md-3 col-centered" align="center">
			<center>
				<div class="alert-default img-circle" align="center" style="width: 120px; height: 120px; padding-top: 18px; border: 3px solid #333333; background-color: #E6E6E6;">
					<span style="font-size: 5em" class="glyphicon glyphicon-envelope"></span>
				</div>
				<h4><b>Contact</b></h4><hr>
		        <p>If you are interested to join us at VHLab, please contact us.</p>
		        <p><a class="btn btn-default" href="contact.php" role="button">View details</a></p>
		    </center>
		</div>
	</div>
	<br><br>
</div>

<?php //include('fragments/aside.php');

include('fragments/footer.php'); ?>