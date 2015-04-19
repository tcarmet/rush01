<?php
	session_start();
	require ('./app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();

	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
	require ('./functions/functions.php');
	if ($data = connect_user($bdd, $_POST['login'], $_POST['password'])) {
		$_SESSION['alert'] = "OK";		
		$_SESSION['id_user'] = $data['id_player'];
		$_SESSION['log_player'] = $data['login'];
		$_SESSION['nbr_points'] = $data['nbr_points'];
		header("Location: ./index.php");
		die();
	}
	else {
		$_SESSION['alert'] = "ERROR";
		header("Location: ./index.php");
		die();
	}
?>