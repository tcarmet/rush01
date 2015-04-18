<?php
	
	$user = select_all_user($bdd);
	echo "<table>";
	echo "<tr> <td> login</td> <td> email </td> <td> points </td> <td> grade </td> </tr>";
	foreach ($user as $key => $value) {
		echo "<tr>";
			echo "<td> $value[login]</td> " . " <td> $value[email]</td> " . "<td> $value[nbr_points]</td> " . " <td> $value[grade]</td>" . "<td><a href=\"./process/del_user.php?id=".$value['id_player']."\">Supprimer</a>";
		echo "</tr>";
	}
	echo "</table>";
?>