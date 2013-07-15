<?php

	//echo('dataBAAASE');
	//$return
	
	$return = array();
	error_reporting(0);
	
	$function = $_GET['function'];
			connect();
	
	if ($function == 'addUser') {
		if (isset($_GET['name'])) $name = $_GET['name'];
		if (isset($_GET['email'])) $email = $_GET['email'];
		if (isset($_GET['password'])) $password = $_GET['password'];
		if (isset($_GET['photoLink'])) $photoLink = $_GET['photoLink'];
	
		addUser($name, $password, $email, $photoLink);
	
	}
	
	if ($function == 'getAllUsers') getAllUsers();
	
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
	
	function connect() {
	
		$username="daniel61_assn";
		$password="smokebomb";
		$database="daniel61_assassin";
		$con = mysql_connect(localhost,$username,$password);
		mysql_select_db($database) or die( "Unable to select database");
	
	
	}
	
?>