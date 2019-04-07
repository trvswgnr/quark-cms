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

function sanitize_html( $html ) {
	$purifier_config = HTMLPurifier_Config::createDefault();
	$html_purifier = new HTMLPurifier( $purifier_config );
	$clean_html = $html_purifier->purify( $html );
	return $clean_html;
}

function is_admin () {}
