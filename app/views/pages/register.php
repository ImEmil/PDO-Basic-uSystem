<?php
	if($session->loggedOut()) {
?>
	<section class="box">
	<h3>Register</h3>

		<form action="app/controllers/register.php" method="post" class="fix">

			<input type="text" name="username" placeholder="Please type in your username" required>
			<input type="email" name="email" placeholder="Please type in your email" required>

			<input type="password" name="password" placeholder="Please type in your password" required>
			<input type="password" name="password2" placeholder="Please confirm your password" required>

			<button type="submit" name="register_c">Create account &raquo;</button>
	</form>

</section>
<?php
}
else {

	$s->refresh("index.php?error=3", 0);
	
}
?>