<?php
session_start();

/* Fichier a include */
require ('../app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();

	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
	require ('../functions/functions.php');

?>
<html>
<head>
	<meta charset='UTF-8'>
	<title>..:: Warhammer 42K : ADM ::..</title>
	<link rel="stylesheet" type="text/css" href="../styles/general.css">
</head>
<body>
	<div id="global">
		<div id="header">
			<p class="ecrit"><!-- Contenu du Header --></p>
			<div id="membre">
				<p class="ecrit"><!-- Espace membre -->
                <?php
                    include("./inclures/login_admin.php");
                ?>
                </p>
			</div>
		</div>
		<div id="general">
			<div id="content">
				<p class="ecrit"><!-- Contenu -->
                <?php
                    if (isset($_GET['pg']) && $_GET['pg'] == "list_user")
                        include("./inclures/list_user.php");
                    else if (isset($_GET['pg'])  && $_GET['pg'] == "list_admin")
                        include("./inclures/list_admin.php");
                    else if (isset($_GET['pg'])  && $_GET['pg'] == "create_admin")
                        include("./inclures/create_admin.php");
                ?>
                </p>
			</div>
			<div id="menu">
				<p class="ecrit"><!-- Menu -->
					<?php
					include("./inclures/menu.php");
					?>
				</p>
			</div>
			<div id="pied">
				<p class="ecrit"></p>
				</p>
			</div>
		</div>
	</div>
</body>
</html>