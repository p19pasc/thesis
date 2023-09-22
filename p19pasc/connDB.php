<?php 
	$servername = 'localhost';
	$username = 'root';
	$password = '0000';
	$dbname = 'epigrafes';
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: ".$conn->connect_error);
	} else {
		mysqli_set_charset($conn, 'utf8');	
	}
	
?>