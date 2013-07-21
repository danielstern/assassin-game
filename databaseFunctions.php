<?php

	function addUser($name, $password, $email, $photoLink) {
	
		$query = "INSERT INTO `daniel61_assassin`.`assassin_users` (
			`id`, 
			`name`, 
			`email`, 
			`picture`, 
			`password`, 
			`date`
		) 
		VALUES (
			NULL, 
			'".$name."', 
			'".$email."', 
			'".$photoLink."', 
			'".$password."', 
			CURRENT_TIMESTAMP
		);";

		mysql_query($query);
	}
	
	function getAllUsers() { 
	
		$query = "SELECT * FROM  `daniel61_assassin`.`assassin_users` ";

		$json = queryToJSON($query);	
		echo $json;
	}
	
	function getAllGameUsers($game_id, $no_echo = false) { 
		
		$query = "SELECT * FROM  `daniel61_assassin`.`game_view` WHERE `game_id` = '$game_id'";
		$json = queryToJSON($query);
		
		if (!$no_echo) echo $json;
		return queryToArray($query);
	
	
	}
	
	function getAllGames() { 
	
		$query = "SELECT * FROM  `daniel61_assassin`.`assassin_games` ";	
		echo queryToJSON($query);
	
	}
	
		
	function getTarget($game_id, $pursuer_id, $no_echo = false) { 
	
	
		$query = "SELECT * FROM  `daniel61_assassin`.`assassin_pursuing` WHERE `game_id` = $game_id AND `pursuer_id` = $pursuer_id AND `complete` = 0";	
		
		if (!$no_echo) echo queryToJSON($query);
		return(queryToArray($query));

	}
	
	function getUserInfoById($user_id) {
	
		$query = "SELECT * FROM `daniel61_assassin`.`assassin_users` WHERE `id` = $user_id";
		return(queryToArray($query));
	}
	

	
	function createGame($name) { 
	
	   $query = "INSERT INTO  `daniel61_assassin`.`assassin_games` (
			`name`
			)
			VALUES (
			'".$name."'
			);";
			
			
		mysql_query($query);
		echo(mysql_insert_id());

	}
	
	function enrolUser($game_id, $user_id) {
	
		$query = "INSERT INTO  `daniel61_assassin`.`assassin_game_enrolment` (
			`game_id` ,
			`user_id` 
			)
			VALUES (
			'$game_id',  
			'$user_id'
			);";
			
		mysql_query($query);
		
	}
	
		
	function removeUserFromGame($game_id, $user_id) {
	
		$query = "DELETE FROM `daniel61_assassin`.`assassin_game_enrolment` WHERE `assassin_game_enrolment`.`user_id` = $user_id AND `game_id` = $game_id;";
			
		mysql_query($query);
		
	}
	
		
	function createPursuit($game_id, $pursuer_id, $target_id) { 
	
	   $query = "INSERT INTO  `daniel61_assassin`.`assassin_pursuing` (
			`game_id`,
			`pursuer_id`,
			`target_id`
			)
			VALUES (
			'".$game_id."',
			'".$pursuer_id."',
			'".$target_id."'
			);";
			
			
		mysql_query($query);	
	}
	
	function incrementUserScore($game_id, $user_id) { 
		
	error_reporting(1);
	   $query = "SELECT * from `daniel61_assassin`.`assassin_game_scores` where `game_id` = $game_id AND `user_id` = $user_id";
	   $score = queryToArray($query);
	   echo($query);
	   $id;
	   $newScore;
	   var_dump($score);
		
		if (count($score) == 0) {
		
			echo('creating score...');
			
			$query = "INSERT INTO  `daniel61_assassin`.`assassin_game_scores` (
			`game_id`,
			`user_id`
			)
			VALUES (
			'".$game_id."',
			'".$user_id."'
			);";
			
			
			mysql_query($query);
			$id = mysql_insert_id();
			 		
			unset($query);	
			$newScore = 1;
			
		
		}
		
		if (!$newScore) $newScore = intval($score[0]['kills']) + 1;
		if (!$id) $id = $score[0]['id'];
		
		$query = "UPDATE  `daniel61_assassin`.`assassin_game_scores` SET  `kills` =  $newScore WHERE  `assassin_game_scores`.`id` = $id";

		echo($query);				
			
		mysql_query($query);	
	}
	
	   function incrementUserDeaths($game_id, $user_id) { 
		
		error_reporting(1);
	   $query = "SELECT * from `daniel61_assassin`.`assassin_game_scores` where `game_id` = $game_id AND `user_id` = $user_id";
	   $score = queryToArray($query);
	   $id;
	   $newScore;
		
		if (count($score) == 0) {
			/* to do, put in own function */
		
			echo('creating score...');
			
			$query = "INSERT INTO  `daniel61_assassin`.`assassin_game_scores` (
			`game_id`,
			`user_id`
			)
			VALUES (
			'".$game_id."',
			'".$user_id."'
			);";
			
			
			mysql_query($query);
			$id = mysql_insert_id();
			 		
			unset($query);	
			$newScore = 1;
			/**/
			
		
		}
		
		if (!$newScore) $newScore = intval($score[0]['deaths']) + 1;
		if (!$id) $id = $score[0]['id'];
		
		$query = "UPDATE  `daniel61_assassin`.`assassin_game_scores` SET  `deaths` =  $newScore WHERE  `assassin_game_scores`.`id` = $id";
		mysql_query($query);	
	} 
	
	function completePursuit($id, $game_id, $user_id) { 
	
	   $query = "UPDATE  `daniel61_assassin`.`assassin_pursuing` SET  `complete` =  '1' WHERE  `assassin_pursuing`.`id` = $id";			
	   mysql_query($query);	
	   flush();
		incrementUserScore($game_id, $user_id);
		
		$pursuit =  queryToArray("SELECT * FROM  `daniel61_assassin`.`assassin_pursuing` WHERE  `assassin_pursuing`.`id` = $id");	
		$target_id = $pursuit[0]['target_id'];
		incrementUserDeaths($game_id, $target_id);
	}
	
	
	function getGameInfo($id) {
	
		$query = "SELECT * FROM `assassin_games` where `id` = '$id'";	
		$gameData = queryToArray($query);
		$users = getAllGameUsers($id, true);
		
		foreach ($users as &$user) 
		{
		    $user['pursuit'] = getTarget($id, $user['user_id'], true);
			
			if ($user['pursuit']) 
			{
				$target = &$user['pursuit'][0];
				$target['details'] = getUserInfoByID($target['target_id']);
			}
			else {
				$user['pursuit'] = 0;
			}
			
			$user['score'] = getScore($id, $user['user_id']);
		}
		

		$gameData['users'] = $users;
		echo(json_encode($gameData));
	
	}
	
	function getScore($game_id, $user_id) {
	
		$query = "SELECT * FROM `daniel61_assassin`.`assassin_game_scores` WHERE `game_id` = $game_id AND `user_id` = $user_id";
		error_reporting(0);
		$score = queryToArray($query);
	//	echo($query);
		return $score;
		//return 1;
	}

	
	function queryToArray($query) {
		$resource = mysql_query($query);
		$rows = array();
		while($r = mysql_fetch_assoc($resource)) {
			$rows[] = $r;
			
		}

		return $rows;
	}
	
	function queryToJSON($query) {
		$resource = mysql_query($query);
		$rows = array();
		while($r = mysql_fetch_assoc($resource)) {
			$rows[] = $r;	
		}
		return json_encode($rows);
	}
	
	function manageGame($id) {
				
		$gameDetails = queryToArray('SELECT * FROM  `assassin_games` WHERE `id` = "'.$id.'"');
		$usersInGame = queryToArray('SELECT * FROM  `assassin_game_enrolment` WHERE `game_id` = "'.$id.'"');
		
		?>
			<h2>Game Details</h2>
		<?php
		var_dump($gameDetails);
		?>
			<h2>User Details</h2>:
		<?php
		manageUsers($usersInGame,$id);
		
	}
	
	
	function connect() {
	
		$username="daniel61_assn";
		$password="smokebomb";
		$database="daniel61_assassin";
		$con = mysql_connect('localhost',$username,$password);
		mysql_select_db($database) or die( "Unable to select database");
	
	}
	
	function bsAlert($text) {
	?>
		<div class='alert'><?php echo($text)?></div>
	<?php
	}
	
	
	function manageUsers($_users, $id) {
	
	?> 
	
		<div class='alert'>Target assignment is enabled by default. Max targets is 1.</div>;
			
	<?php
	
		$game_id = $id;
		foreach ($_users as &$user) 
		{	
		?>
			<h3>Managing User:</h3>
		<?php
			$pursuing = getTarget($game_id, $user['user_id']);
			var_dump($user);			
			
			if (count($pursuing) == 0)
			{
				bsAlert('This user is not pursuing anyone.');
				$target = findLikelyTarget($_users, $user, $game_id);
				if ($target) createPursuit($game_id, $user['user_id'], $target['user_id']);
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
	
	
	function findLikelyTarget($_allUsers, $pursuer, $game_id) {
	
		bsAlert('findLikelyTarget');
		$_users = queryToArray('SELECT * FROM  `assassin_game_enrolment` WHERE `game_id` = "'.$game_id.'"');
		shuffle($_users);
		$allTargets = array();
		foreach ($_users as &$user) 
		{
			$pursuing = getTarget($game_id, $user['user_id']);
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
			
				$goodTarget = true;
			
				if ($user['user_id'] != $pursuer['user_id']) {
					bsAlert('This user is not pursing anyone.');;
				} else {
				   $goodTarget = false;
				}
				
				$pursuing = getTarget($game_id, $user['user_id']);
				echo('This is the pursuers target.');
				var_dump($pursuing);
				if($pursuing[0]){
					if ($pursuing[0]['target_id'] == $pursuer['user_id'])
					{
						echo('this potential target is already pursuing user.');
						$goodTarget = false;
					}
				}
				
				echo('So now he is the target.');
				if ($goodTarget) return $user;
			}
		}
		
		bsAlert('Could not find a valid target for this user.');
		# to do, add another scenario that handles multiple users trailing one
	}
	
				
	function target_id($u)
	{
		return($u['target_id']);
	}

	
	connect();

?>