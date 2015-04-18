<?php
    function create_user($bdd2, $login, $email, $password){
		$login = protect_sql($login, "none");
		$email = protect_sql($email, "none");
		$password = protect_sql($password, "none");

    	$password = my_crypt($password, $login);
    	$sql = "INSERT INTO `players` VALUES ('', '".$login."', '".$email."', '".$password."', 0, 0)";
        if ($bdd2->query($sql))
    		return 1;
    	else
    		return 0;
    }

    function delete_user($bdd2, $id){
        $id = protect_sql($id, "intval");

        $sql = "DELETE FROM `players` WHERE id_player = ".$id."";
        if ($bdd2->query($sql))
            return 1;
        else
            return 0;
    }

    function connect_user($bdd2, $login, $password){
    	$login = protect_sql($login, "none");
		$password = protect_sql($password, "none");

    	$password = my_crypt($password, $login);
    	$sql = "SELECT id_player, login, email, nbr_points FROM `players` WHERE login = '".$login."'";
    	if ($data = $bdd2->query_select($sql))
    	{
            if (strcmp($data[0]['password'], $password))
            {
    			$sql_2 = "SELECT * FROM `players_grades` WHERE ".$data[0]['nbr_points']." BETWEEN min_points AND max_points";
                if ($data_2 = $bdd2->query_select($sql_2))
                {
                    $data[0]['grade'] = $data_2[0]['name'];
                    return $data[0];
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

    function update_points_user($bdd2, $id, $point_sup){
    	$id = protect_sql($id, "intval");
		$point_sup = protect_sql($point_sup, "intval");

		$sql = "UPDATE `players` SET nbr_points = nbr_points + ".$point_sup." WHERE id_player = '".$id."'";
        if ($bdd2->query($sql))
    		return 1;
    	else
    		return 0;
    }

    function select_all_user($bdd2){
    	$sql = "SELECT id_player, login, email, nbr_points FROM `players`";
		if ($data = $bdd2->query_select($sql))
		{
            foreach ($data as $key => $value)
            {
                $sql_2 = "SELECT * FROM `players_grades` WHERE ".$value['nbr_points']." BETWEEN min_points AND max_points";
                if ($data_2 = $bdd2->query_select($sql_2))
                    $data[$key]['grade'] = $data_2[0]['name'];
            }
        	return $data;
    	}
    	else
    		return 0;
    }

    function select_info_user($bdd2, $id){
    	$id = protect_sql($id, "intval");

    	$finish = array();
		$sql = "SELECT id_player, login, email, nbr_points FROM `players` WHERE id_player = ".$id."";
		if ($data = $bdd2->query_select($sql))
    	{
            $sql_2 = "SELECT * FROM `players_grades` WHERE ".$data[0]['nbr_points']." BETWEEN min_points AND max_points";
            if ($data_2 = $bdd2->query_select($sql_2))
    		{
                $data[0]['grade'] = $data_2[0]['name'];
    			return $data[0];
    		}
    		return  0;
       	}
    	else
    		return 0;
    }

    function select_all_grades($bdd2){
        $sql = "SELECT * FROM `players_grades`";
        if ($data = $bdd2->query_select($sql))
        {
            return $data;
        }
        else
            return 0;
    }
?>