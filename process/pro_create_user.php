<?php
	session_start();
	require ('../app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();

	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("d\
	b_pass"), $config->get("db_host"));
	require ('../functions/functions.php');

	if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password1']) 
		&& isset($_POST['password2']) && ($_POST['password1'] == $_POST['password2']))
	{
		if (create_user($bdd, $_POST['login'], $_POST['email'], $_POST['password1']))
		{
			$_SESSION['alert'] = "Success";
			header("Location: ../index.php");
			die();
		}
		else 
		{
			$_SESSION['alert'] = "ERROR";
			header("Location: ../index.php");
			die();
		}
	}
	else {
		$_SESSION['alert'] = "ERROR";
		header("Location: ../index.php");
   		die();
	}
?>