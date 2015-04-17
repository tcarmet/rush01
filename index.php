<?php
   	require ('app/Autoloader.class.php');
   	App\Autoloader::register();
    $config = App\Config::getInstance();

    $bdd = App\database\Database::getInstance();
?>