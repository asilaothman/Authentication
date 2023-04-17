<?php
	$user = 'root';
	$pass = '';
	$db = 'websec';

	$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
	
?>