<?php

function connection() {
	$host   = 'localhost';
	$user   = 'root';
	$pass   = 'root';
	$dbname = 'quark_cms';
	try {
		$conn = new PDO( "mysql:host=$host;", $user, $pass );
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$conn->exec( "CREATE DATABASE IF NOT EXISTS $dbname; USE $dbname;" );
		return $conn;
	} catch ( PDOException $e ) {
		echo 'Connection failed: ' . $e->getMessage();
	}
}

$conn = connection();
