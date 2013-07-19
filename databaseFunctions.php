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
	
		$query = "SELECT * FROM  `daniel61_assassin`.`assassin_pursuing` WHERE `game_id` = $game_id AND `pursuer_id` = $pursuer_id";	
		
		if (!$no_echo) echo queryToJSON($query);
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
			
			
		mysql_query($query);

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
	
	function getGameInfo($id) {
		
		$query = "SELECT * FROM `assassin_games` where `id` = '$id'";	
		$gameData = queryToArray($query);
		$users = getAllGameUsers($id, true);
		
		foreach ($users as &$user) 
		{
		    $user['pursuit'] = getTarget($id, $user['user_id'], true);
			
			if ($user['pursuit']) 
			{
				var_dump($user['pursuit'][0]);
			}
		}
		

		$gameData['users'] = $users;
		echo(json_encode($gameData));

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
	
	connect();

?>