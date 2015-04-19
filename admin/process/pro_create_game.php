<?php
	session_start();
	require ('../../app/Autoloader.class.php');
	App\Autoloader::register();
	$config = App\Config::getInstance();

	$bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
	require ('../../functions/functions.php');

	if (isset($_POST['name']) && isset($_POST['player1']) && isset($_POST['player2']) && $_POST['player1'] !== $_POST['player2'])
	{
		if ($id_game = create_game($bdd, $_POST['name'], '1', $_POST['player1'])) {
			if (add_player_in_game($bdd, $id_game, $_POST['player2'])) {
				for ($i = 0; $i < 10; $i++) {
						insert_into_map($bdd, $id_game, 'barrier', mt_rand(0, 150), mt_rand(0, 100), mt_rand(3, 15), mt_rand(3, 15), 0);
				}
				insert_into_map($bdd, $id_game, 'ship', 1, 1, 10, 8, $_POST['player1'], 1);
				insert_into_map($bdd, $id_game, 'ship', 141, 89, 10, 8, $_POST['player2'], 1);
				$_SESSION['alert'] = "Success";
				header("Location: ../index.php");
				die();
			} else {
				$_SESSION['alert'] = "Error";
				header("Location: ../index.php?pg=create_game");
				die();
			}
		}
		else {
			$_SESSION['alert'] = "Error";
			header("Location: ../index.php?pg=create_game");
			die();
		}
	}
	else {
		$_SESSION['alert'] = "Error";
		header("Location: ../index.php?pg=create_game");
		die();
	}
?>