<?php

create_game($bdd2, "Test", 1, 1);


// GENERATE BARRIER
for ($i = 0; $i < 10; $i++) {
	insert_into_map($bdd, 1, 'barrier',
		mt_rand(0, 150), mt_rand(0, 100), mt_rand(3, 15), mt_rand(3, 15), 0);
}

insert_into_map($bdd, 1, 'ship', 1, 1, 10, 8, 1);
insert_into_map($bdd, 1, 'ship', 100, 10, 10, 8, 1);


$data = select_all_into_map($bdd, 1);
$map = New Map($data, $bdd, 1);
// for ($i = 0; isset($data[$i]); $i++) {
	// $ship[] = new Ship();
// }

echo "<table>";
for ($i = 0; $i < Map::HEIGHT; $i++) {
	echo "<tr/>";
	for ($j = 0; $j < Map::WIDTH ; $j++) {
		if ($map->getMapXY($j, $i) == 1)
			echo "<td style='background-color: green;' id='" . $i . "_" . $j . "'";
		else if ($map->getMapXY($j, $i) == 2)
			echo "<td style='background-color: red;' id='" . $i . "_" . $j . "'";
		else
			echo "<td id='" . $i . "_" . $j . "'";
		echo "</td>";
	}
	echo "</tr>";
}
echo "</table>";
?>
