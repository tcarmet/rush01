<?php
	require("../index.php");

	if ($data = connect_admin($bdd, $_POST['login'], $_POST['password'])) {
		$_SESSION['alert'] = "OK";		
		$_SESSION['id_admin'] = $data['id_admin'];
		$_SESSION['log_admin'] = $data['login'];
		$_SESSION['rank'] = $data['id_ranks'];
		header("Location: ../index.php");
		die();
	}
	else {
		$_SESSION['alert'] = "ERROR";
		header("Location: ../index.php");
		die();
	}
?>