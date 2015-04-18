<?php
	session_start();
	require ('../../app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();

	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
	require ('../../functions/functions.php');
	if ($data = connect_admin($bdd, $_POST['login'], $_POST['password'])) {
		$_SESSION['alert'] = "OK";		
		$_SESSION['id_admin'] = $data['id_admin'];
		$_SESSION['log_admin'] = $data['login'];
		$_SESSION['rank'] = $data['id_ranks'];
		header("Location: ../index.php");
		die();
	}
	else {
		$_SESSION['alert'] = "ERROR";
		header("Location: ../index.php");
		die();
	}
?>