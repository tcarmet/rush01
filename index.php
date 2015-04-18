<?php
    
    require ('app/Autoloader.class.php');
   	App\Autoloader::register();
    $config = App\Config::getInstance();

    $bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
	require ('functions.php');

    if (delete_user($bdd, 2))
    	echo "ok";
    else
    	echo "nope";
?>