<?php
    function my_crypt($base, $key) {
		$crypt = strrev(sha1(md5(strrev($base)).$key).strrev(hash("sha512", $base.strrev($key))));
		return ($crypt);
	}

	function protect_sql($var, $method) {
		mysqli_real_escape_string($var);
		if ($method === "intval")
		{
			$var = intval($var);
		}
		return ($var);
	}

	require ('functions/players.php');
    require ('functions/admins.php');
    require ('functions/games.php');
?>