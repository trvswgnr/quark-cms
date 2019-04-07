<?php
/**
 * Class: Setup
 *
 * @package quark
 */

/**
 * Initialize Site
 */
class Setup {
	/**
	 * Database connection
	 *
	 * @var PDO
	 */
	private $conn;

	/**
	 * Constructor
	 */
	public function __construct() {
		try {
			$this->create_config_file();
			// Import $conn PDO variable after config variables have been set.
			require_once 'connection.php';
			$this->conn = $conn;
			$this->create_tables();
			$this->create_admin_user();
		} catch ( Exception $e ) {
			echo 'Error creating installation: ' . $e;
		}
	}

	/**
	 * Create Database Tables
	 */
	private function create_tables() {
		try {
			$conn  = $this->conn;
			$table = 'posts';
			$sql   = "CREATE TABLE IF NOT EXISTS $table(
				id bigint(20) AUTO_INCREMENT PRIMARY KEY,
				date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				modified datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				title text NOT NULL,
				content longtext NOT NULL,
				slug text NOT NULL,
				type varchar(20) NOT NULL DEFAULT 'post');";

			$conn->exec( $sql );

			$table = 'users';
			$sql   = "CREATE TABLE IF NOT EXISTS $table(
				id bigint(20) AUTO_INCREMENT PRIMARY KEY,
				created datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				user varchar(100) NOT NULL,
				email varchar(100) NOT NULL,
				password varchar(100) NOT NULL,
				role varchar(100) NOT NULL);";

			$conn->exec( $sql );

			echo 'Tables created successfully.';
		} catch ( PDOException $e ) {
			echo 'Error Creating Tables: ' . $e->getMessage();
		}
	}

	/**
	 * Create 'config.php' File
	 */
	public function create_config_file() {
		$host   = secure_input( 'host' ) ?: 'localhost';
		$user   = secure_input( 'user' ) ?: 'root';
		$pass   = filter_input( INPUT_POST, 'pass' ) ?: 'root';
		$dbname = secure_input( 'dbname' ) ?: 'quark_cms';

		$filename = 'config.php';
		$contents = "<?php\ndefine( 'DB_HOST', '$host' );\ndefine( 'DB_USER', '$user' );\ndefine( 'DB_PASSWORD', '$pass' );\ndefine( 'DB_NAME', '$dbname' );\ndefine( 'DEBUG', false );\ndefine( 'TIMEZONE', 'America/New_York' );\n";
		file_put_contents( $filename, $contents );
	}

	/**
	 * Create Initial Admin User
	 */
	public function create_admin_user() {
		$conn     = $this->conn;
		$created  = date( 'Y-m-d H:i:s' );
		$user     = secure_input( 'admin_user' );
		$email    = secure_input( 'admin_email' );
		$password = password_hash( trim( $_POST['admin_password'] ), PASSWORD_DEFAULT );
		$role     = 'admin';

		try {
			$sql  = 'INSERT INTO users (created, user, email, password, role) VALUES (?,?,?,?,?)';
			$stmt = $conn->prepare( $sql );
			$stmt->execute( [ $created, $user, $email, $password, $role ] );
			echo '<p class="text-success">User "' . $user . '" created successfully!</p>';
		} catch ( PDOException $e ) {
			echo 'Error Adding User: ' . $e->getMessage();
		}
	}
}
