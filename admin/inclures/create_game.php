<form action="./process/pro_create_game.php" method="POST">
<label for="input_name">Nom de la partie : </label><br>
<input type="text" name="name" id="input_name" autofocus required>
<br><br>

<label for="Player1">Player 1 :</label><br>
<?php
	$pl = select_all_user($bdd);
		echo "<select name=\"player1\" id=\"Player1\" required>";
	if (!empty($pl))
	{
		foreach ($pl as $k => $v) {
			if (!check_game($bdd, $pl[$k]['id_player']))
				echo "<option value=\"".$pl[$k]['id_player']."\">".$pl[$k]['login']."</option>";
		}
	}
	echo "</select>";
	echo "<br /><br /><label for=\"Player2\">Player 2 : </label><br>";
	echo "<select name=\"player2\" id=\"Player2\" required>";
	if (!empty($pl))
	{
		foreach ($pl as $x => $y) {
			if (!check_game($bdd, $pl[$x]['id_player']))
				echo "<option value=\"".$pl[$x]['id_player']."\">".$pl[$x]['login']."</option>";
		}
	}
	echo "</select>";
?>
<br><br>

<input type="submit" name="submit" value="Create">
</form>
