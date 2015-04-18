<?php
	function create_game($bdd2, $name, $id_type, $creator){
		$name = protect_sql($name, "none");
		$id_type = protect_sql($id_type, "intval");
		$creator = protect_sql($creator, "intval");

		$sql = "INSERT INTO `games` VALUES ('', '".$name."', NOW(), '".$password."', 0)";
        if ($bdd2->query($sql))
    		return 1;
    	else
    		return 0;
	}
?>