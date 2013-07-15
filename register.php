<?php

	$username="daniel61_assn";
	$password="smokebomb";
	$database="daniel61_assassinReg";
	$con = mysql_connect(localhost,$username,$password);
	mysql_select_db($database) or die( "Unable to select database");
	
	echo($con)

?>