<?php
	require("../index.php");

	if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rank']))
	{
		if (create_admin($bdd, $_POST['login'], $_POST['email'], $_POST['password'], $_POST['rank'])) {
			$_SESSION['alert'] = "Success";
			header("Location: ../index.php");
			die();
		}
		else {
			$_SESSION['alert'] = "Error";
			header("Location: ../index.php?pg=create_admin");
			die();
		}
	}
	else {
		$_SESSION['alert'] = "Error";
		header("Location: ../index.php?pg=create_admin");
		die();
	}
?>