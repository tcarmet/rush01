<?php
	require ('app/Autoloader.class.php');
   	App\Autoloader::register();
    $config = App\Config::getInstance();

    $conn = mysqli_connect($config->get("db_host"), $config->get("db_user"), $config->get("db_pass"));
    $sql = "CREATE DATABASE IF NOT EXISTS `Rush01`";
    mysqli_query($conn, $sql);
    $bdd = App\database\Database::getInstance_bdd($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
    require ('functions/funtcions.php');
    
    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Players` (`id_player` int(11) NOT NULL AUTO_INCREMENT,`login` varchar(50) NOT NULL,`email` varchar(255) NOT NULL,`password` text NOT NULL,`nbr_points` int(11) NOT NULL DEFAULT 0,`status` enum('0', '1', '2') NOT NULL DEFAULT 2,PRIMARY KEY (`id_player`), UNIQUE (`login`), UNIQUE (`email`))"))
    	echo "Table players created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table players</span><br />";
    
    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Players_grades` (`id_grade` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(50) NOT NULL, `min_points` int(11) NOT NULL, `max_points` int(11) NOT NULL,PRIMARY KEY (`id_grade`), UNIQUE (`name`))"))
    	echo "Table players_grades created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table players_grades</span><br />";
    
    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Administrators` (`id_admin` int(11) NOT NULL AUTO_INCREMENT,`login` varchar(50) NOT NULL,`email` varchar(255) NOT NULL,`password` text NOT NULL,`id_ranks` int(11) NOT NULL DEFAULT 1,PRIMARY KEY (`id_admin`), UNIQUE (`login`), UNIQUE (`email`))"))
    	echo "Table administrators created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table administrators</span><br />";
    
    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Administrators_ranks` (`id_rank` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(50) NOT NULL,PRIMARY KEY (`id_rank`), UNIQUE (`name`))"))
    	echo "Table administrators_ranks created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table administrators_ranks</span><br />";
    
    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Factions` (`id_faction` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(50) NOT NULL,`color` varchar(6) NOT NULL,PRIMARY KEY (`id_faction`), UNIQUE (`name`))"))
    	echo "Table factions created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table factions</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Ships` (`id_ship` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(50) NOT NULL,`description` text NOT NULL,`width` int(11) NOT NULL,`length` int(11) NOT NULL,`speed` int(11) NOT NULL,`life_points` int(11) NOT NULL,`power_points` int(11) NOT NULL,`moves` int(11) NOT NULL,`protect_points` int(11) NOT NULL,`value_points` int(11) NOT NULL,`id_faction` int(11) NOT NULL,PRIMARY KEY (`id_ship`), UNIQUE (`name`))"))
    	echo "Table ships created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table ships</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Weapons` (`id_weapon` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(50) NOT NULL,`description` text NOT NULL,`loads` int(11) NOT NULL,`short_range` int(11) NOT NULL,`middle_range` int(11) NOT NULL,`long_range` int(11) NOT NULL,`effect_area` int(11) NOT NULL,PRIMARY KEY (`id_weapon`), UNIQUE (`name`))"))
    	echo "Table weapons created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table weapons</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Bonus` (`id_bonus` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(50) NOT NULL,`description` text NOT NULL,`effect` varchar(255) NOT NULL,`type_of_effect` enum('ship', 'weapon') NOT NULL,PRIMARY KEY (`id_bonus`), UNIQUE (`name`))"))
    	echo "Table bonus created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table bonus</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Games` (`id_game` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(50) NOT NULL,`creation_date` datetime NOT NULL,`id_type` int(11) NOT NULL, `state` enum('En attente de Joueurs', 'En cours', 'Finie') NOT NULL DEFAULT 'En attente de Joueurs',PRIMARY KEY (`id_game`))"))
    	echo "Table games created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table games</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Type_of_games` (`id_type_game` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(100) NOT NULL,`nbr_player` int(11) NOT NULL,`nbr_points` int(11) NOT NULL,PRIMARY KEY (`id_type_game`), UNIQUE (`name`))"))
    	echo "Table type_of_games created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table type_of_games</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Messages` (`id_message` int(11) NOT NULL AUTO_INCREMENT,`title` varchar(100) NOT NULL,`content` text NOT NULL, `date` datetime NOT NULL, `id_sender` int(11) NOT NULL,`id_ecipient` int(11) NOT NULL,`previous_message` int(11) NOT NULL,PRIMARY KEY (`id_message`))"))
    	echo "Table messages created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table messages</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Chat_messages` (`id_chat_message` int(11) NOT NULL AUTO_INCREMENT,`content` text NOT NULL,`date_hour` datetime NOT NULL,`id_sender` int(11) NOT NULL,PRIMARY KEY (`id_chat_message`))"))
    	echo "Table chat_messages created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table chat_messages</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Use` (`id_ship` int(11) NOT NULL,`id_weapon` int(11) NOT NULL,`number` int(11) NOT NULL,KEY `id_ship` (`id_ship`),KEY `id_weapon` (`id_weapon`))"))
    	echo "Table use created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table use</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Effect_on_ship` (`id_ship` int(11) NOT NULL,`id_bonus` int(11) NOT NULL,`effect_on` enum('speed', 'life_points', 'power_points', 'moves', 'protect_points') NOT NULL,KEY `id_ship` (`id_ship`),KEY `id_bonus` (`id_bonus`))"))
    	echo "Table effect_on_ship created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table effect_on_ship</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Effect_on_weapon` (`id_weapon` int(11) NOT NULL,`id_bonus` int(11) NOT NULL,`effect_on` enum('loads', 'short_range', 'middle_range', 'long_range') NOT NULL,KEY `id_weapon` (`id_weapon`),KEY `id_bonus` (`id_bonus`))"))
    	echo "Table effect_on_weapon created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table effect_on_weapon</span><br />";

    if ($bdd->query("CREATE TABLE IF NOT EXISTS `Play_in` (`id_player` int(11) NOT NULL,`id_game` int(11) NOT NULL,`points` int(11) NOT NULL,`rank` int(11) NOT NULL,KEY `id_player` (`id_player`),KEY `id_game` (`id_game`))"))
    	echo "Table play_in created successfully.<br />";
    else
    	echo "<span style=\"color: red;\">Error creating table play_in</span><br />";

    if ($bdd->query("INSERT INTO `Administrators_ranks` VALUES ('', 'Dieu'), ('', 'Prophette'), ('', 'Ange')"))
    	echo "Insert into administrators_ranks is good.<br />";
    else
    	echo "<span style=\"color: red;\">Error when insert into administrators_ranks</span><br />";

    if ($bdd->query("INSERT INTO `Players_grades` VALUES ('', 'Amiral', '4000', '2147483647'), ('', 'Capitaine', '3300', '4000'), ('', 'Commandeur', '2500', '3300'), ('', 'Lieutenant Commandeur', '1800', '2500'), ('', 'Lieutenant', '1200', '1800'), ('', 'Sous-Lieutenant', '700', '1200'), ('', 'Enseigne', '300', '700'), ('', 'Cadet', '0', '300')"))
    	echo "Insert into players_grades is good.<br />";
    else
    	echo "<span style=\"color: red;\">Error when insert into players_grades</span><br />";

    if ($bdd->query("INSERT INTO `Type_of_games` VALUES ('', 'Simple', '2', '500')"))
        echo "Insert into type_of_games is good.<br />";
    else
        echo "<span style=\"color: red;\">Error when insert into type_of_games</span><br />";

    if ($bdd->query("INSERT INTO `Administrators` VALUES ('', 'root', 'root@W42K.com', 'root', '1')"))
        echo "Insert into administrators is good.<br />";
    else
        echo "<span style=\"color: red;\">Error when insert into administrators</span><br />";

    if ($bdd->query("INSERT INTO `Players` VALUES ('', 'root', 'root@W42K.com', 'root', 0, 2), ('', 'tcarmet', 'tcarmet@W42K.com', '123456', 0, 2)"))
        echo "Insert into players is good.<br />";
    else
        echo "<span style=\"color: red;\">Error when insert into players</span><br />";

    create_user($bdd, "tcoppin", "tcoppin@student.42.fr", "qwerty");
    create_user($bdd, "tcarmet", "tcarmet@student.42.fr", "123456");
?>