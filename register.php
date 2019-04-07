<?php
require 'quark-head.php';

// add a user.
if ( isset( $_POST['submit'] ) ) {
	$created  = date( 'Y-m-d H:i:s' );
	$user     = secure_input( 'user' );
	$email    = secure_input( 'email' );
	$password = password_hash( trim( $_POST['password'] ), PASSWORD_DEFAULT );
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
