<?php
/**
 * Site Setup
 *
 * @package seacms
 */

// Import Setup class.
require 'class-setup.php';

require 'header.php';

if ( filter_input( INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS ) ) {
	$setup = new Setup( $conn );
}

function create_column() {
	try {
		if ( ! $_POST['column_name'] ) {
			return false;
		}
		$table     = 'posts';
		$column    = $_POST['column_name'];
		$data_type = $_POST['data_type'];

		$sql = "ALTER TABLE $table
			ADD $column $data_type NOT NULL;";
		$conn->exec( $sql );
		echo "Added $column successfully.";
	} catch ( PDOException $e ) {
		echo "Error Creating $column: " . $e->getMessage();
	}
}

if ( $_POST['submit_table'] ) {
	create_column();
}
?>

<h1>Site Setup</h1>
<form action="" method="post">
	<input type="submit" name="submit" value="Initialize Site">
</form>

<h2>Add Column to 'posts'</h2>
<form action="" method="post">
	<label for="column_name">Column Name</label>
	<input type="text" name="column_name">

	<label for="data_type">Data Type</label>
	<input type="text" name="data_type" value="text">

	<div><input type="submit" name="submit_table" value="Add Column"></div>
</form>

<?php require 'footer.php'; ?>
