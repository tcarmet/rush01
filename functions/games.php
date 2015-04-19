<?php

	function select_tog($bdd2, $id){
		$sql = "SELECT * FROM `type_of_games` WHERE id_type_game = ".$id."";
		if ($data = $bdd2->query_select($sql))
        	return $data;
        else
        	return 0;
	}

	function select_all_tog($bdd2){
		$sql = "SELECT * FROM `type_of_games`";
		if ($data = $bdd2->query_select($sql))
        	return $data;
        else
        	return 0;
	}

	function select_game($bdd2, $id){
		$id = protect_sql($id, "intval");

		$sql = "SELECT * FROM games WHERE id_game = ".$id."";
		if ($data = $bdd2->query_select($sql))
		{
			if ($type = select_tog($bdd2, $data[0]['id_type']))
	    		return $type[0];
			else
				return 0;
		}
		else
			return 0;
	}

	function create_map($bdd2, $id_game){
		$id = protect_sql($id, "intval");

		$name = $id_game."_map_game";
		$sql = "CREATE TABLE IF NOT EXISTS `".$name."` (`id_object` int(11) NOT NULL AUTO_INCREMENT, `type_object` enum('ship', 'barrier') NOT NULL, `position_x` int(11) NOT NULL, `position_y` int(11) NOT NULL, `width` int(11) NOT NULL, `lenght` int(11) NOT NULL, `id_owner` int(11) NOT NULL, id_ship int(11) NOT NULL, PRIMARY KEY (`id_object`))";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	function create_event_table($bdd2, $id_game){
		$id = protect_sql($id, "intval");

		$name = $id_game."_event_game";
		$sql = "CREATE TABLE IF NOT EXISTS `".$name."` (`id_event` int(11) NOT NULL AUTO_INCREMENT, `message` text NOT NULL, `date_hour` datetime NOT NULL, `id_player` int(11) NOT NULL, PRIMARY KEY (`id_event`))";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	function create_event($bdd2, $id_game, $content, $id_player){
		$id = protect_sql($id, "intval");

		$name = $id_game."_event_game";
		$sql = "INSERT INTO `".$name."` VALUES ('', '".$content."', NOW(), '".$id_player."')";
		if ($data = $bdd2->query($sql))
			return $data;
		else
			return 0;
	}

	function select_event($bdd2, $id_game, $timestamp){
		$id = protect_sql($id, "intval");

		$name = $id_game."_event_game";
		$sql = "SELECT * FROM `".$name."` WHERE ".$timestamp." < date_hour";
		if ($data = $bdd2->query_select($sql))
			return $data;
		else
			return 0;
	}

	function create_game($bdd2, $name, $id_type, $id_creator){
		$name = protect_sql($name, "none");
		$id_type = protect_sql($id_type, "intval");
		$id_creator = protect_sql($id_creator, "intval");

		$sql = "INSERT INTO `games` VALUES ('', '".$name."', NOW(), ".$id_type.", 'En attente de Joueurs')";
        if ($bdd2->query($sql))
        {
    		$last_id = $bdd2->last_id();
    		if ($type = select_tog($bdd2, $id_type)){
	    		$sql2 = "INSERT INTO `play_in` VALUES ('".$id_creator."', '".$last_id."', '".$type[0]['nbr_points']."', '1')";
	    		if ($bdd2->query($sql2))
	        	{
	        		if (create_map($bdd2, $last_id))
	        		{
	        			if (create_event_table($bdd2, $last_id))
	    					return $last_id;
	    				else
	    				{
	    					delete_map($bdd2, $last_id);
	    					return 0;
	    				}
	    			}
	    			else
	    				return 0;
	    		}
	    		else
	    			return 0;
	    	}
	    	else
	    		return 0;
        }
    	else
    		return 0;
	}

	function add_player_in_game($bdd2, $id_game, $id_player){
		$id_game = protect_sql($id_game, "intval");
		$id_player = protect_sql($id_player, "intval");

		if ($type = select_game($bdd2, $id_game))
		{
			$sql = "SELECT COUNT(*) AS `nbr` FROM `play_in` WHERE id_game = '".$id_game."'";
			if ($data = $bdd2->query_select($sql))
			{
				if ($data[0]['nbr'] < $type['nbr_player'])
				{
					$data[0]['nbr']++;
					$sql2 = "INSERT INTO `play_in` VALUES ('".$id_player."', '".$id_game."', '".$type['nbr_points']."', '".$data[0]['nbr']."')";
					if ($bdd2->query($sql2))
						return 1;
					else
						return 0;
				}
			}
			else
				return 0;
		}
		else
			return 0;
	}

	function delete_map($bdd2, $id_game){
		$id_game = protect_sql($id_game, "intval");

		$name = $id_game."_map_game";
		$sql = "DROP TABLE `".$name."`";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	function delete_event($bdd2, $id_game){
		$id_game = protect_sql($id_game, "intval");

		$name = $id_game."_event_game";
		$sql = "DROP TABLE `".$name."`";
		if ($bdd2->query($sql))
			return 1;
		else
			return 0;
	}

	/*
	** MOVE ON MAP
	*/
	function insert_into_map($bdd2, $id_game, $type, $position_x, $position_y, $width, $lenght, $id_owner, $id_ship){
		$type = protect_sql($type, "none");
		$position_x = protect_sql($position_x, "intval");
		$position_y = protect_sql($position_y, "intval");
		$width = protect_sql($width, "intval");
		$lenght = protect_sql($lenght, "intval");
		$id_owner = protect_sql($id_owner, "intval");
		$id_ship = protect_sql($id_ship, "intval");

		$name = $id_game."_map_game";
		$sql = "INSERT INTO `".$name."` VALUES ('', '".$type."', '".$position_x."', '".$position_y."', '".$width."', '".$lenght."', '".$id_owner."', '".$id_ship."')";
		if ($bdd2->query($sql))
	        return $bdd2->last_id();
        else
        	return 0;
	}

	function update_map($bdd2, $id_game, $id_object, $position_x, $position_y, $width, $lenght){
		$id_game = protect_sql($id_game, "intval");
		$id_object = protect_sql($id_object, "intval");
		$position_x = protect_sql($position_x, "intval");
		$position_y = protect_sql($position_y, "intval");

		$name = $id_game."_map_game";
		$sql = "UPDATE `".$name."` SET position_x = ".$position_x.", position_y = ".$position_y. ", width = " . $width .
		 ", lenght = " . $lenght . " WHERE id_object = ".$id_object."";
		if ($bdd2->query($sql))
	        return 1;
        else
        	return 0;
	}

	function delete_into_map($bdd2, $id_game, $id_object){
		$id_game = protect_sql($id_game, "intval");
		$id_object = protect_sql($id_object, "intval");

		$name = $id_game."_map_game";
		$sql = "DELETE FROM `".$name."` WHERE id_object='".$id_object."'";
		if ($bdd2->query($sql))
	        return 1;
        else
        	return 0;
	}

	function select_all_into_map($bdd2, $id_game){
		$id_game = protect_sql($id_game, "intval");

		$name = $id_game."_map_game";
		$sql = "SELECT * FROM `".$name."`";
		if ($data = $bdd2->query_select($sql))
	        return $data;
        else
        	return 0;
	}

	function select_into_map($bdd2, $id_game, $id_object){
		$id_game = protect_sql($id_game, "intval");
		$id_object = protect_sql($id_object, "intval");

		$name = $id_game."_map_game";
		$sql = "SELECT * FROM `".$name."` WHERE id_object ='".$id_object."'";
		if ($data = $bdd2->query_select($sql))
	        return $data[0];
        else
        	return 0;
	}

	function select_all_games($bdd2){
		$sql = "SELECT * FROM `games`";
		if ($data = $bdd2->query_select($sql))
			return $data;
		else
			return 0;
	}

	function check_game($bdd2, $id){
		$id = protect_sql($id, "intval");

		$sql = "SELECT id_game FROM `play_in` WHERE id_player = '".$id."'";
		if ($data = $bdd2->query_select($sql))
		{
			foreach ($data as $key => $value)
			{
				$sql2 = "SELECT state FROM `games` WHERE id_game = '".$data[0]['id_game']."'";
				if ($data2 = $bdd2->query_select($sql2))
				{
					if ($data2[0]['state'] != "Finie")
						return 1;
				}
			}
			return 0;
		}
		else
			return 0;
	}
?>
