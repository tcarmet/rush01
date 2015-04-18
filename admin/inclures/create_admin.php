
<form action="./process/pro_create_admin.php" method="POST">
<label for="login">Login: </label><br>
<input type="text" name="login" id="login" autofocus required>
<br><br>

<label for="email">Email: </label><br>
<input type="text" name="email" id="Email" required>
<br><br>

<label for="Password">Mot de passe: </label><br>
<input type="password" name="password" id="Password" required>
<br><br>


<label for="Rank">Rank: </label><br>
<select name="rank" id="Rank" required>
<?php
	$ranks = select_all_ranks($bdd);
	sort($ranks);
	foreach ($ranks as $key => $value) {
		echo "<option value=\"".$ranks[$key]['id_rank']."\">".$ranks[$key]['name']."</option>"; 
	}
?>
</select>
<br><br>
<input type="submit" name="submit" value="Create">
</form>
