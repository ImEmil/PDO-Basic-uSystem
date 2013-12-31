<?php
  require("app/engine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <title>PDO userSystem (basic)</title>
  <link rel="stylesheet" type="text/css" href="app/views/public/css/style.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="app/views/public/js/functions.js"></script>
  <script src="app/views/public/js/livestamp.js" type="text/javascript"></script>
  <script src="app/views/public/js/moment.js" type="text/javascript"></script>

</head>
<body>
<!-- header & logo -->
	<header class="full-row">
		<hgroup class="shadow">
			<h1>Basic UserSystem</h1>
			<h2>Php data objects (oo)</h2>
		</hgroup>
	</header>

<!-- navigations & links -->
	<nav class="full-row shadow fix">
		<?php
			include("app/inc/nav.php");
		?>
	</nav>

<!-- the main content [login form] - [stats] etc -->
	<main class="full-row shadow fix">
		<?php echo $s->error() ?>
		<section id="left">
			<?php
				$var = "page";
				$directory = "app/views/pages";
				if((isset($_GET[$var]) && file_exists("{$directory}/$_GET[$var].php")) ? include("{$directory}/$_GET[$var].php") : include("{$directory}/default.php"));
			?>
		</section>

		<section id="right">
			<?php
				include("app/inc/c_login.php");
			?>
		</section>

	</main>

<!-- footer & credits -->
	<footer class="full-row"> Basic UserSystem (PDO OOP) By <a href="https://github.com/ImEmil/" target="_blank">ImEmil</a> </footer>

</body>
</html>