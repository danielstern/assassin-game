<?php include('php/head.php') ; ?>
<div class='container'>
<h1>Managing Game</h1>
<?php
	
	require_once('databaseFunctions.php');
	$game_id = $_GET['game_id'];
	
	
	
	$gameDetails = queryToArray('SELECT * FROM  `assassin_games` WHERE `id` = "'.$game_id.'"');
	$usersInGame = queryToArray('SELECT * FROM  `assassin_game_enrolment` WHERE `game_id` = "'.$game_id.'"');
	
	?>
		<h2>Game Details</h2>
	<?php
	var_dump($gameDetails);
	?>
		<h2>User Details</h2>:
	<?php
	var_dump($usersInGame);
	manageUsers($usersInGame);
	
	function manageUsers($_users) {
	
	?> 
	
		<div class='alert'>Target assignment is enabled by default. Max targets is 1.</div>;
			
	<?php
	
		$game_id = $_GET['game_id'];
		foreach ($_users as &$user) 
		{	
		?>
			<h3>Managing User:</h3>
		<?php
			$query = "SELECT * FROM `assassin_pursuing` WHERE `pursuer_id` = ".$user['user_id']." AND `game_id` = $game_id";
			bsAlert($query);
			$pursuing = queryToArray($query);
			var_dump($user);			
			
			if (count($pursuing) == 0)
			{
				bsAlert('This user is not pursuing anyone.');
				$target = findLikelyTarget($_users, $user);
				createPursuit($game_id, $user['user_id'], $target['user_id']);
				unset($target);
				
			} 
			else
			{
				bsAlert('This user has a target.');
				var_dump($pursuing);
			}
		}
		unset($user);	
	}
	
	
	function findLikelyTarget($_allUsers, $pursuer) {
	
		bsAlert('findLikelyTarget');
		$game_id = $_GET['game_id'];
		$_users = queryToArray('SELECT * FROM  `assassin_game_enrolment` WHERE `game_id` = "'.$game_id.'"');
		$allTargets = array();
		foreach ($_users as &$user) 
		{
			$query = "SELECT * FROM `assassin_pursuing` WHERE `pursuer_id` = ".$user['user_id']." AND `game_id` = $game_id";
			$pursuing = queryToArray($query);
			foreach($pursuing as $target) 
			{
				$allTargets[] = $target;
			}
		}
		
		bsAlert('This is a totol loadout of all targets:');
		var_dump($allTargets);
		
		
		foreach ($_users as &$user) 
		{
			if (!in_array($user['user_id'], array_map('target_id',$allTargets))) {
			
				if ($user['user_id'] != $pursuer['user_id']) {
					bsAlert('This user is not pursing anyone. So now he is the target.');
					return $user;
				}
			}
		}
		
		bsAlert('Could not find a valid target for this user.');
		# to do, add another scenario that handles multiple users trailing one
	}
	
				
	function target_id($u)
	{
		return($u['target_id']);
	}


?>