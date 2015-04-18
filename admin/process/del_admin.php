<?php
	require("../index.php");
	if (delete_admin($bdd, $_GET["id"])) {
		$_SESSION['alert'] = "Success";
	}
	else {
		$_SESSION['alert'] = "Error";
	}
	header("Location: ../index.php?pg=list_admin");
	die();
?>