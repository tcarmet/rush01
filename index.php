<?php
session_start();

/* Fichier a include */
require ('app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();

	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
	require ('./functions/functions.php');

?>
<html>
<head>
	<meta charset='UTF-8'>
	<title>..:: Warhammer 42K ::..</title>
	<link rel="stylesheet" type="text/css" href="./styles/general.css">
</head>
<body>
	<div id="global">
		<div id="header">
			<p class="ecrit"><!-- Contenu du Header --></p>
			<div id="membre">
				<p class="ecrit"><!-- Espace membre --></p>
			</div>
		</div>
		<div id="general">
			<div id="content">
				<p class="ecrit"><!-- Contenu --></p>
			</div>
			<div id="menu">
				<p class="ecrit"><!-- Menu --></p>
			</div>
			<div id="pied">
				<p class="ecrit"></p>
				</p>
			</div>
		</div>
	</div>
</body>
</html>