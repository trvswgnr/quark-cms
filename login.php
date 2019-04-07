<?php require 'header.php'; ?>

<?php
if ( filter_get( 'installed' ) === 'true' ) {
	echo 'Installation completed successfully.';
}

if ( filter_get( 'logout' ) === 'true' ) {
	$_SESSION['ADMIN_LOGGED_IN'] = false;
	setcookie( 'ADMIN_LOGGED_IN', false );
	echo 'Logged out.';
	// Unset all of the session variables.
	$_SESSION = array();
	// Destroy the session.
	session_destroy();
}

if ( isset( $_POST['submit'] ) ) {
	try {
		$input_user      = secure_input( 'user' );
		$input_password  = $_POST['password'];
		$sql             = "SELECT * FROM users WHERE user='$input_user' LIMIT 1";
		$user            = $conn->query( $sql )->fetch();
		$hashed_password = $user['password'];

		if ( password_verify( $input_password, $hashed_password ) ) {
			$_SESSION['ADMIN_LOGGED_IN'] = true;
			setcookie( 'ADMIN_LOGGED_IN', true, time() + 3600 );
		}
		$redirect_url = get_site_url() . '?logged-in=true';
		header( "Location: $redirect_url", true, 303 );
		die();
	} catch ( PDOException $e ) {
		echo 'Error Logging In: ' . $e->getMessage();
	}
}
?>
<h1>Login</h1>
<form action="login.php" method="post">
	<div class="input-group">
		<label for="user">Username</label>
		<input type="text" name="user">
	</div>
	<div class="input-group">
		<label for="password">Password</label>
		<input type="password" name="password">
	</div>
	<div class="input-group">
		<input type="submit" name="submit" value="Log In">
	</div>
</form>

<?php require 'footer.php'; ?>
