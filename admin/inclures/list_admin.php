<?php
	$user = select_all_admin($bdd);

	echo "<table>";
	echo "<tr> <td> login</td> <td> email </td> <td> Rank </td> </tr>";
	foreach ($user as $key => $value) {
		echo "<tr>";
			echo "<td> $value[login]</td> " . " <td> $value[email]</td> " . "<td> $value[id_ranks]</td> ";
			if ($value['id_ranks'] != 1)
				echo "<td><a href=\"./process/del_admin.php?id=".$value['id_admin']."\">Supprimer</a>";
		echo "</tr>";
	}
	echo "</table>";
?>