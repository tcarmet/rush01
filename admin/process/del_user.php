<?php
	session_start();
	require ('../../app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();

	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
	require ('../../functions/functions.php');

	if (delete_user($bdd, $_GET["id"])) {
		$_SESSION['alert'] = "Success";
	}
	else
	{
		$_SESSION['alert'] = "Error";
	}
	header("Location: ../index.php?pg=list_user");
	die();
?>