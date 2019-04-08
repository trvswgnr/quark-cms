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
	$host   = DB_HOST;
	$user   = DB_USER;
	$pass   = DB_PASSWORD;
	$dbname = DB_NAME;

	try {
		$conn = new PDO( "mysql:host=$host; dbname=$dbname", $user, $pass );
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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
