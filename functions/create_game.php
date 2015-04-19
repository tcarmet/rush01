<?php
	/* Fichier a include */
	require ('../app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();
	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"),
		$config->get("db_pass"), $config->get("db_host"));
	require ('../functions/functions.php');

	create_game($bdd, "Test", 1, 1);

	for ($i = 0; $i < 10; $i++) {
		insert_into_map($bdd, 1, 'barrier',
			mt_rand(0, 150), mt_rand(0, 100), mt_rand(3, 15), mt_rand(3, 15), 0);
	}

	insert_into_map($bdd, 1, 'ship', 1, 1, 10, 8, 1, 1);
	insert_into_map($bdd, 1, 'ship', 141, 89, 10, 8, 2, 1);
?>