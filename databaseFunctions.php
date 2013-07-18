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

		echo (mysql_query($query));
		echo $query;
	}
	
	function getAllUsers() { 
	
		$query = "SELECT * FROM  `daniel61_assassin`.`assassin_users` ";
		$resource = mysql_query($query);
		
		$rows = array();
		while($r = mysql_fetch_assoc($resource)) {
			$rows[] = $r;
		}

		$json = json_encode($rows);
		//$return['users'] = $json;
		//echo($return);
		
		echo $json;
	
	
	}
	
	function getAllGameUsers($game_id, $no_echo = false) { 
	
		//echo($game_id);
	
		$query = "SELECT * FROM  `daniel61_assassin`.`game_view` WHERE `game_id` = '$game_id'";
		//echo($query);
		$resource = mysql_query($query);
		
		$rows = array();
		while($r = mysql_fetch_assoc($resource)) {
			$rows[] = $r;
		}

		$json = json_encode($rows);
		//$return['users'] = $json;
		//echo($return);
		
		if (!$no_echo) echo $json;
		return $rows;
	
	
	}
	
	function getAllGames() { 
	
		$query = "SELECT * FROM  `daniel61_assassin`.`assassin_games` ";	
		$resource = mysql_query($query);
		
		echo sqltoJSON($resource);
	
	
	}
	
		
	function getTarget($game_id, $pursuer_id, $no_echo = false) { 
	
		$query = "SELECT * FROM  `daniel61_assassin`.`assassin_pursuing` WHERE `game_id` = $game_id AND `pursuer_id` = $pursuer_id";	
		$resource = mysql_query($query);
		
		if (!$no_echo) echo sqltoJSON($resource);
		return(queryToArray($query));

	}
	
	function getUserNameById($user_id) {
	
		$query = "SELECT `name` FROM `daniel61_assassin`.`assassin_users` WHERE `id` = $user_id";
		return(queryToArray($query));
	
	
	}
	

	
	function createGame($name) { 
	
	   $query = "INSERT INTO  `daniel61_assassin`.`assassin_games` (
			`name`
			)
			VALUES (
			'".$name."'
			);";
			
			
		echo (mysql_query($query));
	
		
	
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
		
		echo($query);
		echo(mysql_error());

	
	}
	
		
	function createPursuit($game_id, $pursuer_id, $target_id) { 
	
		echo('create pursuit ' . $game_id . ' : ' . $pursuer_id . ' : ' . $target_id);
	
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
			
			
		echo (mysql_query($query));	
	}
	
	function getGameInfo($id) {
		
		$return = array();
		$query = "SELECT * FROM `assassin_games` where `id` = '$id'";
		$resource = mysql_query($query);
		
		
		$gameData = sqltoJSON($resource);
		$return['name'] = $gameData['name'];
	
		$gameDataObj = json_decode($gameData);
		$usersObj = getAllGameUsers($id, true);
		
		foreach ($usersObj as &$user) 
		{
		    $user['pursuit'] = getTarget($id, $user['user_id'], true);
			$pursuit = $user['pursuit'];
			//$user['target_id'] = $pursuit[0]['target_id'];
			//$user['target_name'] = getUserNameByID($pursuit[0]['target_id']);
			//$user['pursuit']
			
			if ($user['pursuit']) 
			{
				var_dump($user['pursuit'][0]);
			}
		}
		
	//	var_dump($usersObj);
		
		$gameDataObj['users'] = $usersObj;
		//var_dump($gameDataObj);
		
		echo(json_encode($gameDataObj));

	}
	
	function sqltoJSON($resource) {

	
		$rows = array();
		while($r = mysql_fetch_assoc($resource)) {
			$rows[] = $r;
			
		}

		$json = json_encode($rows);
	//	echo($json);
		
		return $json;
	
	}
	
	function queryToArray($query) {

		$resource = mysql_query($query);
		$rows = array();
		while($r = mysql_fetch_assoc($resource)) {
			$rows[] = $r;
			
		}

		return $rows;
	
	}
	
	
	function connect() {
	
		$username="daniel61_assn";
		$password="smokebomb";
		$database="daniel61_assassin";
		$con = mysql_connect('localhost',$username,$password);
		mysql_select_db($database) or die( "Unable to select database");
	
	
	}
	
	connect();
	//error_reporting(0);

?>