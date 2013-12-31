<?php
	if($session->loggedIn()) {

		if(isset($_GET['name'])) {
			$name = clean($_GET['name']);

			if($s->doExist($name, 'users', 'username') === false) {
				header("Location: index.php?page=members");
				die();
			}

			$data 	= $s->userData($name);
			$rights = null;

			if($my_data->rank == 2) {
				$rights = "<a href='index.php?page=edit_user&name={$name}'> <button class='float-right'>Edit user</button> </a>";
			}
?>
<section class="box">
	<h3><?php echo $name . $rights; ?></h3>

	<p> Last login: <span data-livestamp="<?php echo $data->lastlogin; ?>"></span> </p>

	<p> Joined: <span data-livestamp="<?php echo $data->joindate; ?>"></span> </p>
	
	<p> Rank: <?php echo $s->rank($name); ?> </p>
	
	<p> <a href="index.php?page=profile&name=<?php echo $name; ?>"> Comments: <?php echo $s->rowCount($name, 'comments', 'to'); ?> </a> </p>

	<hr>
	
	<form action="app/controllers/comments.php" method="post">
		<input type="hidden" name="touser" value="<?php echo $name; ?>">

		<textarea name="comment" placeholder="Type in your comment" rows="5" required></textarea>

		<button type="submit" name="post_c" id="post_button">Post &raquo;</button>

	</form>

</section>


<?php
	$comments = $s->displayComments($name);

	foreach ($comments as $comment) {
		echo "
		<article>
		<aside> <a href=\"index.php?page=profile&name={$comment['from']}\"> {$comment['from']} </a> <span data-livestamp=\"{$comment['time']}\" class=\"float-right\"></span> </aside>
		
		{$comment['comment']}

		</article> ";
	}
  }
}
else {
	echo"
	<section class=\"box\"> <h3> Please login to get access to some very cool functions! </h3> </section>
	";
}
?>