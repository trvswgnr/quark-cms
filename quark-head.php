<?php
/**
 * Quark Head
 *
 * @package quark
 */

// import global constants.
require 'config.php';

// import global functions.
require 'functions.php';

// import security functions.
require 'security.php';

quark_debug( constant( 'DEBUG' ) );

if ( ! is_current_file( 'install.php' ) ) {
	require 'connection.php';
}

date_default_timezone_set( constant( 'TIMEZONE' ) );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
