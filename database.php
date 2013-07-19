<?php

	require_once('databaseFunctions.php');
	
	$return = array();

	//var_dump($_GET); return;
	
	$function = $_GET['function'];
	
	
	if ($function == 'addUser') {
		if (isset($_GET['name'])) $name = $_GET['name'];
		if (isset($_GET['email'])) $email = $_GET['email'];
		if (isset($_GET['password'])) $password = $_GET['password'];
		if (isset($_GET['photoLink'])) $photoLink = $_GET['photoLink'];
		
		addUser($name, $password, $email, $photoLink);
	}
	
	if ($function == 'getAllUsers') getAllUsers();
	if ($function == 'getAllGameUsers') getAllGameUsers($_GET['game_id']);
	if ($function == 'createGame') createGame($_GET['name']);
	if ($function == 'getAllGames') getAllGames();
	if ($function == 'getGameInfo') getGameInfo($_GET['id']);
	if ($function == 'enrolUser') enrolUser($_GET['game_id'], $_GET['user_id']);
	if ($function == 'getTarget') getTarget($_GET['game_id'], $_GET['pursuer_id']);
	if ($function == 'removeUserFromGame') removeUserFromGame($_GET['game_id'], $_GET['user_id']);
	
	
	
?>