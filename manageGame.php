<?php
	
	require_once('databaseFunctions.php');
	$game_id = $_GET['game_id'];
	
	$gameDetails = queryToArray('SELECT * FROM  `assassin_games` WHERE `id` = "'.$game_id.'"');
	$usersInGame = queryToArray('SELECT * FROM  `assassin_game_enrolment` WHERE `game_id` = "'.$game_id.'"');

	manageUsers($usersInGame);
	
	function manageUsers($_users) {
	
		echo 'managing users';
			$game_id = $_GET['game_id'];
		foreach ($_users as &$user) 
		{
			var_dump($user);
			
			echo('$game_id?' . $game_id . '\n');
		
			$pursuing = queryToArray("SELECT * FROM `assassin_pursuing` WHERE `pursuer_id` = $user[id] AND `game_id` = $game_id");
			if (count($pursuing) == 0)
			{
				echo('not pursuing anyone.\n');
				$target = findLikelyTarget($_users, $user);
				echo('found likely target...');
				var_dump($target);	
				echo('User? Target?');
				var_dump($user);
				var_dump($target);
				createPursuit($game_id, $user['user_id'], $target['user_id']);
				unset($target);
				
			} else
			{
				echo('Is pursuing...');
				var_dump($pursuing);
			}
		}
		unset($user);	
	}
	
	$allTargets;
	
	function findLikelyTarget($_allUsers, $pursuer) {
	
			$game_id = $_GET['game_id'];
		echo('finding likely target...');
		$_users = queryToArray('SELECT * FROM  `assassin_game_enrolment` WHERE `game_id` = "'.$game_id.'"');
		$allTargets = array();
		foreach ($_users as &$user) 
		{
			$pursuing = queryToArray("SELECT * FROM `assassin_pursuing` WHERE `pursuer_id` = '".$user['user_id']."' AND `game_id` = $game_id");
			foreach($pursuing as $target) 
			{
				$allTargets[] = $target;
			}
		}
		
		echo('haystack redux');
	
		
		foreach ($_users as &$user) 
		{
			
			#echo('being pursued?' . !in_array($user['id'], array_map('target_id',$allTargets)));
			echo('needle? haystack?');
			var_dump($user);
			if (!in_array($user['user_id'], array_map('target_id',$allTargets))) {
			

				echo('good enough.');
				if ($user['user_id'] != $pursuer['user_id']) {
				return $user;
				}
			}
			
		}
		
	    echo('no taret found');


	
	}
	
				
		function target_id($u)
		{
			echo('returning id, returing' . $u['target_id']);
			return($u['target_id']);
		}
	


?>