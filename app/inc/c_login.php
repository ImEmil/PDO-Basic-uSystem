<?php
if($session->loggedOut()) {
?>
<section class="box fix">
	<h3>Login</h3>

		<form action="app/controllers/login.php" method="post" class="fix">

			<input type="text" name="username" placeholder="Please type in your username" required>
			
			<input type="password" name="password" placeholder="Please type in your password" required>

			<button type="submit" name="login_c">Login &raquo;</button>

		</form>

</section>
<?php
}
else {
	
	echo"
	<section class=\"box fix\">
	<h3>Hi {$myUsername} <span class=\"rank float-right\">{$rank}</span></h3>
	<aside class=\"fix\">
		<ul>
			<li><a href=\"logout.php\">Logout</a></li>
			<li><a href=\"index.php?page=settings\">Settings</a></li>
			<li><a href=\"index.php?page=members\">Members</a></li>
		</ul>
	</aside>

	<p> Email: {$my_data->email} </p>
	<p> Last login: <span data-livestamp=\"{$my_data->lastlogin}\"></span> </p>
	<p> IP: {$my_data->ip} </p>

	</section>
	";
}
?>