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
	function add_ship($bdd2, $name, $description, $width, $lenght, $speed, $life, $pp, $moves, $protect, $value, $id_faction, $weapons){
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
		{
			$last_id = $bdd2->last_id();
			foreach ($weapons as $key => $value)
			{
				$value = protect_sql($value, "intval");
				$sql2 = "SELECT * FROM `weapons` WHERE id_weapon = '".$value."'";
				if ($bdd2->query_select($sql2))
				{
					$sql3 = "INSERT INTO `use` VALUES ('".$last_id."', '".$value."', 1)";
					$bdd2->query($sql3);
				}
			}
			return 1;
		}
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

	/*
	** TYPES OF GAMES
	*/
	function add_type($bdd2, $name, $nbr_player, $nbr_points){
		$name = protect_sql($name, "none");
		$nbr_player = protect_sql($nbr_player, "intval");
		$nbr_points = protect_sql($nbr_points, "intval");

		$sql = "INSERT INTO `type_of_games` VALUES ('', '".$name."', '".$nbr_player."', '".$nbr_points."')";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	function select_all_type($bdd2){
		$sql = "SELECT * FROM `type_of_games`";
		if ($data = $bdd2->query_select($sql))
			return $data;
		else
			return 0;
	}

	function delete_type($bdd2, $id){
		$id = protect_sql($id, "intval");

		$sql = "DELETE FROM type_of_games WHERE id_type_game = '".$id."'";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}
?>