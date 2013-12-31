<section class="box" shadow>
	<h3>Welcome to Basic uSystem (PDO)</h3>
	
	<table>
		<thead>
			<tr>
				<th scope="col"> </th>
				<th scope="col">Username</th>
				<th scope="col">Rank</th>
				<th scope="col">Joined</th>
			</tr>
		</thead>
		<tbody>
	<?php
	$registered = $s->displayMembers();
	
	foreach ($registered as $member) {
		echo"
			<tr>
				<td class=\"centerTD\"> #{$member['id']} </td>

				<td class=\"centerTD\"> <a href=\"index.php?page=profile&name={$member['username']}\"> {$member['username']} </a> </td>

				<td class=\"centerTD\"> {$s->rank($member['username'])} </td>
				
				<td class=\"centerTD\"> <span data-livestamp=\"{$member['joindate']}\"></span> </td>
			</tr>
			";
		}
	?>
		</tbody>
	</table>
</section>