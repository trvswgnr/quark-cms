<?php
require 'credentials.php';

try {
	$conn = new PDO( "mysql:host=$host;", $user, $pass );
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$conn->exec( "CREATE DATABASE IF NOT EXISTS $dbname; USE $dbname;" );
	echo '<script>console.log("Connected Successfully!");</script>';
} catch ( PDOException $e ) {
	echo 'Connection failed: ' . $e->getMessage();
}
