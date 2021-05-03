<div class="row">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header" role="brand">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navegation">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">&nbsp; VHLab &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
			</div>
			<div id ="navegation" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li <?php echo ($active == "home") ? "class=\"active\"" : ""; ?>><a href="index.php">&nbsp;<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home &nbsp;</a></li>
					<li <?php echo ($active == "projects") ? "class=\"active\"" : ""; ?>><a href="projects.php">&nbsp;<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Projects &nbsp;</a></li>
					<li <?php echo ($active == "publications") ? "class=\"active\"" : ""; ?>><a href="publications.php">&nbsp;<span class="glyphicon glyphicon-book" aria-hidden="true"></span> Publications &nbsp;</a></li>
					<li <?php echo ($active == "datasets") ? "class=\"active\"" : ""; ?>><a href="datasets.php">&nbsp;<span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Datasets &nbsp;</a></li>
					<li <?php echo ($active == "team") ? "class=\"active\"" : ""; ?>><a href="team.php">&nbsp;<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Team &nbsp;</a></li>
					<li <?php echo ($active == "gallery") ? "class=\"active\"" : ""; ?>><a href="gallery.php">&nbsp;<span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Gallery &nbsp;</a></li>
					<li <?php echo ($active == "press_releases") ? "class=\"active\"" : ""; ?>><a href="press_releases.php">&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Press Releases &nbsp;</a></li>
					<li <?php echo ($active == "contact") ? "class=\"active\"" : ""; ?>><a href="contact.php">&nbsp;<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
</div>
<div class="row" role="center">