<?php 

	require("/home/alekmina/config.php");
	
	// see fail peab olema siis seotud kõigiga kus
	// tahame sessiooni kasutada
	// saab kasutada nüüd $_SESSION muutujat
	session_start();
	
	$database = "if16_alekmina_4";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	// functions.php
	
	require("class/User.class.php");
	$User = new User($mysqli);
	
	require("class/Event.class.php");
	$Event = new Event($mysqli);
	
	require("class/Interest.class.php");
	$Interest = new Interest($mysqli);
	
	require("class/Helper.class.php");
	$Helper = new Helper($mysqli);
	

?>