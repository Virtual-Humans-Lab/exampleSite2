<div class="row" role="reader">

	<nav class="navbar navbar-inverse">

		<div class="container-fluid">

			<div class="navbar-header" role="brand">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navegation">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">&nbsp; VHLab &nbsp;&nbsp;&nbsp;&nbsp;</a>
			</div>

			<div id ="navegation" class="collapse navbar-collapse">

				<ul class="nav navbar-nav">

					<li <?php echo ($active == "panel") ? "class=\"active\"" : ""; ?>><a href="panel.php">&nbsp;<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> CPanel &nbsp;</a></li>

					<li <?php echo ($active == "projects") ? "class=\"active\"" : ""; ?>><a href="man_projects.php">&nbsp;<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Projects &nbsp;</a></li>

					<li <?php echo ($active == "publications") ? "class=\"active\"" : ""; ?>><a href="man_publications.php">&nbsp;<span class="glyphicon glyphicon-book" aria-hidden="true"></span> Publications &nbsp;</a></li>

					<li <?php echo ($active == "datasets") ? "class=\"active\"" : ""; ?>><a href="man_datasets.php">&nbsp;<span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Datasets &nbsp;</a></li>

					<li <?php echo ($active == "team") ? "class=\"active\"" : ""; ?>><a href="man_team.php">&nbsp;<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Team &nbsp;</a></li>

					<li <?php echo ($active == "gallery") ? "class=\"active\"" : ""; ?>><a href="man_gallery.php">&nbsp;<span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Gallery &nbsp;</a></li>

					<li <?php echo ($active == "press_releases") ? "class=\"active\"" : ""; ?>><a href="man_press_releases.php">&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Press Releases &nbsp;</a></li>

					<li <?php echo ($active == "log_off") ? "class=\"active\"" : ""; ?>><a href="log_off.php">&nbsp;<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log off &nbsp;</a></li>

				</ul>

			</div>

		</div>          

	</nav>

</div>

<div class="row" role="center">