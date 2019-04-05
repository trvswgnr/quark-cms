<?php
/**
 * Class: Setup
 *
 * @package foodtaw
 */

// Import database connection object $conn.
require 'connection.php';

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
	 *
	 * @param PDO $conn Database connection object.
	 */
	public function __construct( PDO $conn ) {
		$this->conn = $conn;
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
}
