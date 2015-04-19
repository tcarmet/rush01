
<form action="./process/pro_login_membre.php" method="POST">
<label for="login">Login: </label><br>
<input type="text" name="login" id="login" required>
<br><br>

<label for="Password">Mot de passe: </label><br>
<input type="password" name="password" id="Password" required>
<br><br>
<input type="submit" name="submit" value="Create">
</form>
<div style="float: right; margin-top: -160px; margin-right: 10px;">
	<ul style="list-style-type: none;">
	    <li><a href="./admin/index.php">Admin</a></li>
	    <li><a href="./chat/index.html" onclick="open('chat/index.html', 'Popup', 'scrollbars=1,resizable=1,height=850,width=850'); return false;">Chat</a></li>
	</ul>
</div>