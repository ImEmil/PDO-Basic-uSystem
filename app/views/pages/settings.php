<?php
	if($session->loggedIn()) {
?>
<section class="box">
	<h3><?php echo $myUsername; ?> > My Account > Settings</h3>

	<p> Your email: <?php echo $my_data->email; ?> </p>

	<form action="app/controllers/settings.php" method="post">
		<input type="email" name="email" value="<?php echo $my_data->email; ?>">

		<input type="password" name="password" placeholder="Type in your new password">

		<button type="submit" name="post_s" id="post_button">Update settings &raquo;</button>

	</form>

</section>
<?php
}
else {
	echo"
	<section class=\"box\"> <h3> Please login to get access to some very cool functions! </h3> </section>
	";
}
?>