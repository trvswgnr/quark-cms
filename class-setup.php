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
		$this->create_credentials_file();
		// import $conn variable.
		require_once 'connection.php';
		$this->conn = $conn;
		$this->connection( $conn );
		$this->create_tables();
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
				date_created datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				username varchar(100) NOT NULL,
				email varchar(100) NOT NULL,
				user_type varchar(100) NOT NULL,
				password varchar(100) NOT NULL);";

			$conn->exec( $sql );

			echo 'Tables created successfully.';
		} catch ( PDOException $e ) {
			echo 'Error Creating Tables: ' . $e->getMessage();
		}
	}

	/**
	 * Create 'credentials.php' File
	 */
	public function create_credentials_file() {
		$host   = secure_input( 'host' ) ?: 'localhost';
		$user   = secure_input( 'user' ) ?: 'root';
		$pass   = $_POST['pass'] ?: 'root';
		$dbname = secure_input( 'dbname' ) ?: 'quark_cms';

		$filename = 'credentials.php';
		$content  = "<?php\n\$host   = '$host';\n\$user   = '$user';\n\$pass   = '$pass';\n\$dbname = '$dbname';\n";
		file_put_contents( $filename, $content);
	}
}
