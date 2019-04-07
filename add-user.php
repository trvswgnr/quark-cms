<?php
require 'header.php';

// add a user.
if ( isset( $_POST['submit'] ) ) {
	$created  = date( 'Y-m-d H:i:s' );
	$user     = secure_input( 'user' );
	$email    = secure_input( 'email' );
	$password = filter_input( INPUT_POST, 'password' );
	$role     = secure_input( 'role' );

	try {
		$sql  = 'INSERT INTO users (created, user, email, password, role) VALUES (?,?,?,?,?)';
		$stmt = $conn->prepare( $sql );
		$stmt->execute( [ $created, $user, $email, $password, $role ] );
		echo '<p class="text-success">User "' . $user . '" created successfully!</p>';
	} catch ( PDOException $e ) {
		echo 'Error Adding User: ' . $e->getMessage();
	}
}
?>
<div class="header">
	<h1>Register</h1>
</div>
<form method="post" action="">
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="user" value="">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password">
	</div>
	<div class="input-group">
		<label for="role">User Role</label>
		<select name="role" id="role">
			<option value="member">Member</option>
			<option value="admin">Admin</option>
		</select>
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="submit">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
<?php require 'footer.php'; ?>
