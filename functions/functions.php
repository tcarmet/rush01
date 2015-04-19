<?php
    function my_crypt($base, $key) {
		$crypt = strrev(sha1(md5(strrev($base)).$key).strrev(hash("sha512", $base.strrev($key))));
		return ($crypt);
	}

	function protect_sql($var, $method) {
		mysql_real_escape_string($var);
		if ($method === "intval")
		{
			$var = intval($var);
		}
		return ($var);
	}

	require ('players.php');
    require ('admins.php');
    require ('games.php');
    require ('composants.php');
?>
