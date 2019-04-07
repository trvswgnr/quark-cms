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
	}

	/**
	 * Connection
	 *
	 * @param PDO $conn
\	 */
	public function connection( PDO $conn ) {
		$this->conn = $conn;
	}

	/**
	 * Create Database Tables
	 */
	private function create_tables() {
		try {
			$conn  = $this->conn;
			$table = 'posts';
			$sql   = "CREATE TABLE IF NOT EXISTS $table(
				ID bigint(20) AUTO_INCREMENT PRIMARY KEY,
				date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				modified datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				title text NOT NULL,
				content longtext NOT NULL,
				slug text NOT NULL,
				type varchar(20) NOT NULL DEFAULT 'post');";

			$conn->exec( $sql );
			echo "Table '$table' exists or created successfully.";
		} catch ( PDOException $e ) {
			echo "Error Creating Table '$table': " . $e->getMessage();
		}
	}

	public function create_connection_file() {
		$host   = secure_input( 'host' ) ?: 'localhost';
		$user   = secure_input( 'user' ) ?: 'root';
		$pass   = $_POST['pass'] ?: 'root';
		$dbname = secure_input( 'dbname' ) ?: 'quark_cms';

		$filename = 'credentials.php';
		$content  = "<?php\n\$host   = '$host';\n\$user   = '$user';\n\$pass   = '$pass';\n\$dbname = '$dbname';\n";
		file_put_contents( $filename, $content);
	}
}
