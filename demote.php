<?php
	ini_set('display_errors', 'On');
        error_reporting(E_ALL);

	$db = new SQLite3('finProject.db');
	$instName = $_POST['name'];

	$result = $db->query("UPDATE Instructor SET Rating = Rating - 0.1 WHERE Name = '".$instName."'");	
?>
