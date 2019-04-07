<?php
/**
 * Quark Head
 *
 * @package quark
 */

session_start();

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

// import global constants.
require 'config.php';

// import security functions.
require 'security.php';

// import global functions.
require 'functions.php';

quark_debug( constant( 'DEBUG' ) );

if ( ! is_current_file( 'install.php' ) ) {
	require 'connection.php';
	try {
		$users_table_exists = $conn->query( 'select 1 from `users` LIMIT 1' );
	} catch ( PDOException $e ) {
		redirect( 'install.php' );
	}
}

if ( ! is_logged_in() && ! is_current_file( 'login.php' ) && ! is_current_file( 'install.php' ) ) {
	redirect( 'login.php' );
}

if ( filter_get( 'installed' ) === 'true' ) {
	echo rename( ABSPATH . 'install.php', ABSPATH . 'install.bak' ) ? '' : 'error renaming';
}

date_default_timezone_set( constant( 'TIMEZONE' ) );
