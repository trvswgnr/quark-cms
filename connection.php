<?php
/**
 * Primary Database Connection
 *
 * @package quark
 */

/**
 * Establish a connection to the database.
 *
 * @return PDO $conn Connection object.
 */
function connection() {
	$host   = constant( 'DB_HOST' );
	$user   = constant( 'DB_USER' );
	$pass   = constant( 'DB_PASSWORD' );
	$dbname = constant( 'DB_NAME' );

	try {
		$conn = new PDO( "mysql:host=$host;", $user, $pass );
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$conn->exec( "CREATE DATABASE IF NOT EXISTS $dbname; USE $dbname;" );
		echo '<script>console.log("Connected Successfully!");</script>';
		return $conn;
	} catch ( PDOException $e ) {
		echo 'Connection failed: ' . $e->getMessage();
	}
}

$conn = connection();
