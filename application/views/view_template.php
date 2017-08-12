<!DOCTYPE html>
<?php
if (!isset($_SESSION))
	session_start();
 ?>
<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>
			<?php
			if (isset($title))
				echo $title;
			 ?>
		</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
	</head>
	<body>
	<nav class="navbar navbar-dark bg-dark bot-margin navbar-expand-sm">
		<a class="navbar-brand" href="/">
			Tasker
		</a>
		<button class="navbar-toggler" type="button"
			data-toggle="collapse" data-target="#navbarText"
			aria-controls="navbarText" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
		<button class="btn btn-outline-success align-center" type="submit" id="new-task">New task</button>
				</li>
				<li class="nav-item">
<?php if (isset($_SESSION['user'])) { ?>
		<button class="btn btn-outline-info align-center" type="submit" id="admin-logout">Logout</button>
<?php } else { ?>
		<button class="btn btn-outline-info align-center" type="submit" id="admin-login">Admin login</button>
<?php } ?>
				</li>
			</ul>
		</div>

	</nav>
		<?php
		include 'application/views/' . $content_view;
		?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	</body>
</html>
