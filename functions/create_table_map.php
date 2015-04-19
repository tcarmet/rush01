<?php
// create_game($bdd, "Test", 1, 1);
// GENERATE BARRIER
// for ($i = 0; $i < 10; $i++) {
// 	insert_into_map($bdd, 1, 'barrier',
// 		mt_rand(0, 150), mt_rand(0, 100), mt_rand(3, 15), mt_rand(3, 15), 0);
// }
// insert_into_map($bdd, 1, 'ship', 1, 1, 10, 8, 1);
// insert_into_map($bdd, 1, 'ship', 50, 50, 7, 2, 2);


//	/!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\
//			POUR THOMAS :
//	FAIRE EN SORTE QUE LES id_user SOIENT STOCKÉS DANS LA SESSION !!!!

// $_SESSION['id_user'] = 1;
// $_SESSION['id_user'] = 2;

//	/!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\



if (!isset($bdd))
{
	session_start();

	/* Fichier a include */
	require ('../app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();
	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"),
		$config->get("db_pass"), $config->get("db_host"));
	require ('../functions/functions.php');
	require ('../app/trait/Doc.trait.php');
	require ('../app/Map.class.php');
	require ('../app/IShip.class.php');
	require ('../app/Ship.class.php');
	require ('../app/HonorableDuty.class.php');
	require ('../app/SwordOfAbsolution.class.php');
}

$data = select_all_into_map($bdd, 1);
$map = New Map($data);
for ($i = 0; isset($data[$i]); $i++) {
	if ($data[$i]['type_object'] == 'ship')
		$ships[] = new HonorableDuty(array('x' => $data[$i]['position_x'], 'y' => $data[$i]['position_y'],
			'id' => $data[$i]['id_object'], 'sY' => $data[$i]['lenght'], 'sX' => $data[$i]['width'], 'idusr' => $data[$i]['id_owner']));
}

if (array_key_exists('pos', $_GET))
{
	$tb = explode('_', $_GET['pos']);
	foreach ($ships as $ship)
	{
		if ($ship->getuID() == $_SESSION['id_user'])
		{
			$ship->setPosXY($tb[1], $tb[0]);
			update_map($bdd, 1, $ship->getID(), $ship->getPosX(), $ship->getPosY(), $ship->getSizeX(), $ship->getSizeY());
			$up = 1;
		}
	}
}

function find_orig($x, $y, $map) {
	while ($y > 0)
	{
		if ($map->getMapXY($x, $y - 1) == 0)
			break ;
		$y--;
	}
	while ($x > 0)
	{
		if ($map->getMapXY($x - 1, $y) == 0)
			break ;
		$x--;
	}
	return (array('x' => $x, 'y' => $y));
}

if (array_key_exists('action', $_GET))
{
	if ($_GET['action'] == 'rot')
	{
		foreach ($ships as $ship)
		{
			if ($ship->getuID() == $_SESSION['id_user'])
			{
				$ship->rotate();
				update_map($bdd, 1, $ship->getID(), $ship->getPosX(), $ship->getPosY(), $ship->getSizeX(), $ship->getSizeY());
				$up = 1;
			}
		}
	}
	if ($_GET['action'] == 'shoot')
	{
		foreach ($ships as $ship)
		{
			if ($ship->getuID() == $_SESSION['id_user'])
			{
				$tab2 = $ship->shoot($map);
				$del = array();
				foreach ($tab2 as $tab) {
					$del[] = find_orig($tab['x'], $tab['y'], $map);
				}
				foreach ($del as $tab) {
					foreach ($data as $d)
					{
						if ($d['position_x'] == $tab['x'] && $d['position_y'] == $tab['y'])
							delete_into_map($bdd, 1, $d['id_object']);
					}
				}
				$up = 1;
			}
		}
	}
}

if (isset($up))
{
	$data = select_all_into_map($bdd, 1);
	$map = New Map($data);
	for ($i = 0; isset($data[$i]); $i++) {
		if ($data[$i]['type_object'] == 'ship')
			$ships[] = new HonorableDuty(array('x' => $data[$i]['position_x'], 'y' => $data[$i]['position_y'],
				'id' => $data[$i]['id_object'], 'sY' => $data[$i]['lenght'], 'sX' => $data[$i]['width'], 'idusr' => $data[$i]['id_owner']));
	}
}
// echo "::".$ships[0]->getSizeX()." :: ".$ships[0]->getSizeY()."::";
// insert_into_map($bdd, 1, 'ship', $ships[0]->getPosX(), $ships[0]->getPosY(), $ships[0]->getSizeX(), $ships[0]->getSizeY(), 1);


function is_available($tb, $y, $x)
{
	foreach ($tb as $elem)
	{
		if ($elem['x'] == $x && $elem['y'] == $y)
			return (TRUE);
	}
	return (FALSE);
}


foreach ($ships as $ship)
{
	if ($ship->getuID() == $_SESSION['id_user'])
	{
		$tb = $ship->find_movement_range($map);
		$tb2 = $ship->shoot($map);
	}
}

echo "<table id='mapclick'>";
for ($i = 0; $i < Map::HEIGHT; $i++) {
	echo "<tr>";
	for ($j = 0; $j < Map::WIDTH ; $j++) {
		if (is_available($tb2, $i, $j))
			echo "<td style='background-color: yellow' id='" . $i . "_" . $j . "'";
		else if ($map->getMapXY($j, $i) == 1)
			echo "<td style='background-color: green' id='" . $i . "_" . $j . "'";
		else if ($map->getMapXY($j, $i) == 2)
			echo "<td style='background-color: red' id='" . $i . "_" . $j . "'";
		else if ($map->getMapXY($j, $i) == 3)
			echo "<td style='background-color: black' id='" . $i . "_" . $j . "'";
		else if (is_available($tb, $i, $j))
			echo "<td style='background-color: pink' id='" . $i . "_" . $j . "'";
		else
			echo "<td id='" . $i . "_" . $j . "'";
		echo "</td>";
	}
	echo "</tr>";
}
echo "</table>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
