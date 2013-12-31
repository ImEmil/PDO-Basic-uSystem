<?php
	if($session->loggedIn()) {
?>
<section class="box">
	<h3><?php echo $myUsername; ?> > My Account</h3>

	<p> Last login: <span data-livestamp="<?php echo $my_data->lastlogin; ?>"></span> </p>

	<p> Joined: <span data-livestamp="<?php echo $my_data->joindate; ?>"></span> </p>
	
	<p> Rank: <?php echo $rank; ?> </p>
	
	<p> <a href="index.php?page=profile&name=<?php echo $myUsername; ?>"> Comments: <?php echo $s->rowCount($myUsername, 'comments', 'to'); ?> </a> </p>

	<hr>
	
	<form action="app/controllers/comments.php" method="post">
		<input type="hidden" name="touser" value="<?php echo $myUsername; ?>">

		<textarea name="comment" placeholder="Type in your comment" rows="5" required></textarea>

		<button type="submit" name="post_c" id="post_button">Post &raquo;</button>

	</form>

</section>


<?php
	$comments = $s->displayComments($myUsername);
	
	foreach ($comments as $comment) {
		echo "
		<article>
		<aside> <a href=\"index.php?page=profile&name={$comment['from']}\"> {$comment['from']} </a> <span data-livestamp=\"{$comment['time']}\" class=\"float-right\"></span> </aside>
		
		{$comment['comment']}

		</article> ";
	}
}
else {
	echo"
	<section class=\"box\"> <h3> Please login to get access to some very cool functions! </h3> </section>
	";
}
?>