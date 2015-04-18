<?php
	$game = select_all_games($bdd);

	echo "<table>";
	echo "<tr> <td> nom </td> <td> date de creation </td> <td> status </td> <td> id </td></tr>";
	foreach ($game as $key => $value) {
		echo "<tr>";
			echo "<td> $value[name]</td> " . " <td> $value[creation_date]</td> " . "<td> $value[state]</td>" . "<td> $value[id_game]</td>";
		echo "</tr>";
	}
	echo "</table>";
?>