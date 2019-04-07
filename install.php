<?php
/**
 * Site Setup
 *
 * @package quark
 */

// Import page header.
require 'header.php';

// Import Setup class.
require 'class-setup.php';

if ( secure_input( 'submit' ) ) {
	$setup = new Setup();
	$redirect_url = get_site_url() . 'index.php';
	header( "Location: $redirect_url", true, 303 );
	die();
}

/**
 * Create a new column in table
 */
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

if ( isset( $_POST['submit_table'] ) ) {
	create_column();
}
?>

<h1>Site Setup</h1>
<form action="" method="post">
	<h2>Database Information:</h2>
	<label for="host">Host Name</label>
	<input type="text" name="host" value="localhost">

	<label for="dbname">Database Name</label>
	<input type="text" name="dbname">

	<label for="user">Username</label>
	<input type="text" name="user">

	<label for="pass">Password</label>
	<input type="text" name="pass">

	<div>
		<input type="submit" name="submit" value="Initialize Site">
	</div>
</form>

<!-- 
<h2>Add Column to 'posts'</h2>
<form action="" method="post">
	<label for="column_name">Column Name</label>
	<input type="text" name="column_name">

	<label for="data_type">Data Type</label>
	<input type="text" name="data_type" value="text">

	<div><input type="submit" name="submit_table" value="Add Column"></div>
</form>
-->

<?php require 'footer.php'; ?>
