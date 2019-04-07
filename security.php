<?php
/**
 * Security Functions
 *
 * @package quark
 */

/**
 * Secure Input
 *
 * @param string $field The 'name' value of the form input.
 * @param string $type (Optional) The type of form method. Either 'post' or 'get'.
 */
function secure_input( $field, $type = 'post' ) {
	$type = ( 'get' === strtolower( $type ) ) ? INPUT_GET : INPUT_POST;
	return filter_input( $type, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES );
}

/**
 * Escape String / Basic Escape
 *
 * @param string $str Potentially compromised input string.
 * @return string Secure escaped string with no HTML.
 */
function esc_str( $str ) {
	return htmlspecialchars( $str, ENT_COMPAT, 'UTF-8' );
}

use function esc_str as esc;

require_once 'vendor/htmlpurifier/library/HTMLPurifier.auto.php';

function sanitize_html( $html ) {
	$purifier_config = HTMLPurifier_Config::createDefault();
	$html_purifier   = new HTMLPurifier( $purifier_config );
	$clean_html      = $html_purifier->purify( $html );
	return $clean_html;
}

var_dump( sanitize_html( '<p>gello<?php echo "boieeee"; ?></p>' ) );

function is_admin() {}
