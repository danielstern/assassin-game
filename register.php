<?php

	$username="daniel61_assn";
	$password="smokebomb";
	$database="daniel61_assassinReg";
	$con = mysql_connect(localhost,$username,$password);
	mysql_select_db($database) or die( "Unable to select database");
	
	$name = mysql_escape_string ($_GET["name"]);
	$email = mysql_escape_string ($_GET["email"]);
	
	
	$response['errorCode'] = 0;
	
	//$error = 'false';
	
	if (!$name || !$email) {
		$error = true;
		//echo('You need to include an email address and name.');
			$response['errorCode'] = 1;
			$response['errorMessage'] = 'You need to include an email address and name.';
		
		//include('')
	}
	
	//echo($con);
	
	//echo($name . "<br>");
//	echo($email . "<br>");
	
	$query = "INSERT";
	
	$sql = "INSERT INTO `assassin_registrants` (`id`, `name`, `email`) VALUES (NULL, '".$name."', '".$email."');";
	$query = mysql_query($sql);
	//echo $query;
	//echo mysql_error();
	//echo($sql);
	
	if(mysql_error()) {
	//	$echo('database error...');
		$error = true;
			$response['errorCode'] = 2;
			$response['errorMessage'] = 'Database error.';
	}
	
	if (!$error) {
		//echo ( "Thanks for registering! See you at Atomic Lollipop. ;) ." );
		$response['message'] = "Thanks for registering! See you at Atomic Lollipop. ;) .";
	} else {
	
		//echo ( "We couldn't register you at this time. Please let someone know." );	
		$response['message'] = "We couldn't register you at this time. Please let someone know.";
	}
	header('Content-Type: application/json');
	echo (json_encode($response));
	
	
	
	

?>