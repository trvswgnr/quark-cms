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
		$conn = new PDO( "mysql:host=$host; dbname=$dbname", $user, $pass );
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		// $conn->exec( "CREATE DATABASE IF NOT EXISTS $dbname; USE $dbname;" );
		echo '<script>console.log("Connected Successfully!");</script>';
		return $conn;
	} catch ( PDOException $e ) {
		$error = $e->getMessage();
		echo "Connection failed: $error<br>";
		setcookie( 'ADMIN_LOGGED_IN', false );
		echo 'Logged out.';
		// Unset all of the session variables.
		$_SESSION = array();
		// Destroy the session.
		session_destroy();
	}
}

$conn = connection();
