<?php include('php/head.php') ; ?>
<div class='container'>
<h1>Managing Game</h1>
<?php
	
	require_once('databaseFunctions.php');
	
	$game_id = $_GET['game_id'];
	manageGame($game_id);
	
	
?>