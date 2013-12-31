<?php
	if($session->loggedIn()) {

		if(isset($_GET['name']) && $my_data->rank == 2) {
			$name = clean($_GET['name']);

			if($s->doExist($name, 'users', 'username') === false) {
				header("Location: index.php?page=members");
				die();
			}

			$user_data 	= $s->userData($name);
?>

<section class="box">
	<h3>Edit user > <?php echo $name;?></h3>

	<p> Last login: <span data-livestamp="<?php echo $user_data->lastlogin; ?>"></span> </p>

	<p> Joined: <span data-livestamp="<?php echo $user_data->joindate; ?>"></span> </p>
	
	<p> Rank: <?php echo $s->rank($name); ?> </p>

	<p> Email: <?php echo $user_data->email; ?> </p>

	<p> IP Adress: <i> <?php echo $user_data->ip; ?> </i> </p>
	<hr>
	
	<form action="app/controllers/edit_user.php" method="post">
		<input type="hidden" name="user" value="<?php echo $name; ?>">

		<input type="email" name="email" placeholder="New email">

		<label for="rank"> Current rank: <?php echo $s->rank($name); ?> </label>

		<select name="rank" id="rank">
			<option>Please select an option</option>
			<option value="1">Member</option>
			<option value="2">Administrator</option>
		</select>

		<button type="submit" name="post_e" id="post_button">Update &raquo;</button>

	</form>

</section>

<?php
  }
}
else {
	echo"
	<section class=\"box\"> <h3> Please login to get access to some very cool functions! </h3> </section>
	";
}
?>