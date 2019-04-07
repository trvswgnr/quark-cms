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

if ( ! is_logged_in() && ! is_current_file( 'login.php' ) && ! is_current_file( 'install.php' ) ) {
	$redirect_url = get_site_url() . 'login.php';
	header( "Location: $redirect_url", true, 303 );
	die();
}

if ( filter_get( 'installed' ) === 'true' ) {
	echo rename( ABSPATH . 'install.php', ABSPATH . 'install.bak' ) ? '' : 'error renaming';
}

quark_debug( constant( 'DEBUG' ) );

if ( ! is_current_file( 'install.php' ) ) {
	require 'connection.php';
}

date_default_timezone_set( constant( 'TIMEZONE' ) );

