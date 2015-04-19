<?php
session_start();

/* Fichier a include */

$id = 1;
require ('app/Autoloader.class.php');
App\Autoloader::register();
$config = App\Config::getInstance();
$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"),
	$config->get("db_pass"), $config->get("db_host"));
require ('./functions/functions.php');
require ('app/trait/Doc.trait.php');
require ('app/Map.class.php');
require ('app/IShip.class.php');
require ('app/Ship.class.php');
require ('app/HonorableDuty.class.php');
require ('app/SwordOfAbsolution.class.php');
?>

<html>
<head>
	<meta charset='UTF-8'>
	<title>..:: Warhammer 42K ::..</title>
	<link rel="stylesheet" type="text/css" href="./styles/general.css">
	<link rel="stylesheet" type="text/css" href="./styles/map.css">
</head>
<body>
	<div id="global">
		<div id="header">
			<p class="ecrit"><!-- Contenu du Header --></p>
			<div id="membre">
				<p class="ecrit">
				<!-- Espace membre -->
				<?php
				if(!isset($_SESSION['id_user']))
					include("includes/login_membre.php");
				else
                {
                	?>
                	<form method="POST" action="./process/deco_user.php">
					<input type="submit" name="deco" value="Déconnecter"> 
					</form>
					<div style="float: right; margin-top: -160px; margin-right: 10px;">
	                	<ul style="list-style-type: none;">
	                		<li><a href="./admin/index.php">Admin</a></li>
	                		<li><a href="./chat/index.html" onclick="open('chat/index.html', 'Popup', 'scrollbars=1,resizable=1,height=850,width=850'); return false;">Chat</a></li>
	                	</ul>
	                </div>
				<?php
                }
                ?>
				</p>
			</div>
		</div>
		<div id="general">
			<div id="content">
				<?php 
				if (isset($_SESSION['id_user']))
					{
						require ("functions/create_table_map.php");
						echo "<img id=\"rot\" src=\"./img/rotate.png\">";
						echo "<img id=\"shoot\" src=\"./img/shoot.gif\">";
					}
					else if (!isset($_SESSION['id_user']))
						require ("includes/create_user.php");
					?>
			<script type="text/javascript" src="js/img.js"></script>
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
