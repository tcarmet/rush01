<?php
	
	/*
	** FACTIONS
	*/
	function add_faction($bdd2, $name, $color){
		$name = protect_sql($name, "none");
		$color = protect_sql($color, "none");

		$sql = "INSERT INTO `factions` VALUES ('', '".$name."', '".$color."')";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	function select_all_factions($bdd2){
		$sql = "SELECT * FROM `factions`";
		if ($data = $bdd2->query_select($sql))
			return $data;
		else
			return 0;
	}

	function delete_faction($bdd2, $id){
		$id = protect_sql($id, "intval");

		$sql = "DELETE FROM factions WHERE id_faction = '".$id."'";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	/*
	** SHIPS
	*/
	function add_ship($bdd2, $name, $description, $width, $lenght, $speed, $life, $pp, $moves, $protect, $value, $id_faction){
		$name = protect_sql($name, "none");
		$description = protect_sql($description, "none");
		$width = protect_sql($width, "intval");
		$lenght = protect_sql($lenght, "intval");
		$speed = protect_sql($speed, "intval");
		$life = protect_sql($life, "intval");
		$pp = protect_sql($pp, "intval");
		$moves = protect_sql($moves, "intval");
		$protect = protect_sql($protect, "intval");
		$value = protect_sql($value, "intval");
		$id_faction = protect_sql($id_faction, "intval");

		$sql = "INSERT INTO `ships` VALUES ('', '".$name."', '".$description."', '".$width."', '".$lenght."', '".$speed."', '".$life."', '".$pp."', '".$moves."', '".$protect."', '".$value."', '".$id_faction."')";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	function select_all_ships($bdd2){
		$sql = "SELECT * FROM `ships`";
		if ($data = $bdd2->query_select($sql))
			return $data;
		else
			return 0;
	}

	function delete_ship($bdd2, $id){
		$id = protect_sql($id, "intval");

		$sql = "DELETE FROM ships WHERE id_ship = '".$id."'";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	/*
	** WEAPONS
	*/
	function add_weapon($bdd2, $name, $description, $loads, $short_range, $middle_range, $long_range, $effect_area){
		$name = protect_sql($name, "none");
		$description = protect_sql($description, "none");
		$loads = protect_sql($loads, "intval");
		$short_range = protect_sql($short_range, "intval");
		$middle_range = protect_sql($middle_range, "intval");
		$long_range = protect_sql($long_range, "intval");
		$effect_area = protect_sql($effect_area, "intval");

		$sql = "INSERT INTO `weapons` VALUES ('', '".$name."', '".$description."', '".$loads."', '".$short_range."', '".$middle_range."', '".$long_range."', '".$effect_area."')";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	function select_all_weapons($bdd2){
		$sql = "SELECT * FROM `weapons`";
		if ($data = $bdd2->query_select($sql))
			return $data;
		else
			return 0;
	}

	function delete_weapon($bdd2, $id){
		$id = protect_sql($id, "intval");

		$sql = "DELETE FROM weapons WHERE id_weapon = '".$id."'";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}
?>