<?php
/**
 * Site Setup
 *
 * @package quark
 */

require 'functions.php';
quark_debug( true );

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Setup Quark CMS</title>
	<link rel='stylesheet' type='text/css' href='<?php site_url(); ?>css/style.css.php' />
</head>
<body>
<div class="container">
<?php
// Import Setup class.
require 'class-setup.php';

if ( secure_input( 'submit' ) ) {
	$setup = new Setup();
	$setup->create_connection_file();
	require 'connection.php';
	$setup->connection( $conn );
	$redirect_url = get_site_url() . 'index.php';
	header( "Location: $redirect_url", true, 303 );
	die();
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

// if ( $_POST['submit_table'] ) {
// create_column();
// }
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
	<input type="text" name="password">

	<div>
		<input type="submit" name="submit" value="Initialize Site">
	</div>
</form>

<h2>Administrator</h2>
<form method="post">
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
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
