<?php
/**
 * Security Functions
 *
 * @package seacms
 */

/**
 * Secure Attribute
 *
 * @param string $field The 'name' value of the form input.
 * @param string $type (Optional) The type of form method. Either 'post' or 'get'.
 */
function secure_input( $field, $type = 'post' ) {
	$type = ( 'get' === strtolower( $type ) ) ? INPUT_GET : INPUT_POST;
	return filter_input( $type, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES );
}
