<?php
    function create_admin($bdd2, $login, $email, $password, $rank){
        $login = protect_sql($login, "none");
        $email = protect_sql($email, "none");
        $password = protect_sql($password, "none");
        $rank = protect_sql($rank, "intval");

        $password = my_crypt($password, $login);
        $sql = "INSERT INTO `administrators` VALUES ('', '".$login."', '".$email."', '".$password."', '".$rank."')";
        if ($bdd2->query($sql))
            return 1;
        else
            return 0;
    }

    function delete_admin($bdd2, $id){
        $id = protect_sql($id, "intval");

        $sql = "DELETE FROM `administrators` WHERE id_admin = ".$id." AND id_ranks != 1";
        if ($bdd2->query($sql))
            return 1;
        else
            return 0;
    }

    function connect_admin($bdd2, $login, $password){
        $login = protect_sql($login, "none");
        $password = protect_sql($password, "none");

        $password = my_crypt($password, $login);
        $sql = "SELECT * FROM `administrators` WHERE login = '".$login."'";
        if ($data = $bdd2->query_select($sql))
        {
            if ($data[0]['password'] == $password)
            {
                $sql_2 = "SELECT * FROM `administrators_ranks` WHERE id_rank = ".$data[0]['id_ranks']."";
                if ($data_2 = $bdd2->query_select($sql_2))
                {
                    $data[0]['rank'] = $data_2[0]['name'];
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

    function select_all_admin($bdd2){
        $sql = "SELECT id_admin, login, email, id_ranks FROM `administrators`";
        if ($data = $bdd2->query_select($sql))
        {
            foreach ($data as $key => $value)
            {
                $sql_2 = "SELECT * FROM `administrators_ranks` WHERE id_rank = ".$data[$key]['id_ranks']."";
                if ($data_2 = $bdd2->query_select($sql_2))
                    $data[$key]['rank'] = $data_2[0]['name'];
            }
            return $data;
        }
        else
            return 0;
    }

    function select_info_admin($bdd2, $id){
        $id = protect_sql($id, "intval");

        $finish = array();
        $sql = "SELECT id_admin, login, email, id_ranks FROM `administrators` WHERE id_admin = ".$id."";
        if ($data = $bdd2->query_select($sql))
        {
            $sql_2 = "SELECT * FROM `administrators_ranks` WHERE id_rank = ".$data[0]['id_ranks']."";
            if ($data_2 = $bdd2->query_select($sql_2))
            {
                $data[0]['rank'] = $data_2[0]['name'];
                return $data[0];
            }
            return  0;
        }
        else
            return 0;
    }

    function select_all_ranks($bdd2){
        $sql = "SELECT * FROM `administrators_ranks`";
        if ($data = $bdd2->query_select($sql))
        {
            return $data;
        }
        else
            return 0;
    }
?>