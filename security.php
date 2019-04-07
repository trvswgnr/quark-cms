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

/**
 * @see esc_str
 */
function esc( $str ) {
	return esc_str( $str );
}

/**
 * Deep Replace
 *
 * @param string $search Haystack.
 * @param string $subject Needle.
 */
function _deep_replace( $search, $subject ) {
	$subject = (string) $subject;

	$count = 1;
	while ( $count ) {
		$subject = str_replace( $search, '', $subject, $count );
	}

	return $subject;
}

/**
 * Escape URL
 *
 * @param string $url Dirty, unsafe URL.
 * @return string $url Cleaned, secure URL.
 */
function esc_url( $url ) {
	$original_url = $url;

	if ( '' == $url ) {
		return $url;
	}

	$url = str_replace( ' ', '%20', $url );
	$url = preg_replace( '|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\[\]\\x80-\\xff]|i', '', $url );

	if ( '' === $url ) {
		return $url;
	}

	if ( 0 !== stripos( $url, 'mailto:' ) ) {
		$strip = array( '%0d', '%0a', '%0D', '%0A' );
		$url   = _deep_replace( $strip, $url );
	}

	$url = str_replace( ';//', '://', $url );

	/*
	 * If the URL doesn't appear to contain a scheme, we
	 * presume it needs http:// prepended (unless a relative
	 * link starting with /, # or ? or a php file).
	 */
	if ( strpos( $url, ':' ) === false && ! in_array( $url[0], array( '/', '#', '?' ) ) &&
		! preg_match( '/^[a-z0-9-]+?\.php/i', $url ) ) {
		$url = 'http://' . $url;
	}

	// Replace ampersands and single quotes.
	$url = esc_str( $url );
	$url = str_replace( '&amp;', '&#038;', $url );
	$url = str_replace( "'", '&#039;', $url );

	return $url;
}

require_once 'vendor/htmlpurifier/library/HTMLPurifier.auto.php';

/**
 * Sanitize / Purify HTML. Removes <script> and escapes other untrustworthy tags (like PHP).
 *
 * @param string $html Dirty, untrustworthy HTML.
 * @return string $clean_html Clean, secure HTML.
 */
function sanitize_html( $html ) {
	$purifier_config = HTMLPurifier_Config::createDefault();
	$html_purifier   = new HTMLPurifier( $purifier_config );
	$clean_html      = $html_purifier->purify( $html );
	return $clean_html;
}

/**
 * @see sanitize_html
 */
function kses( $html ) {
	return sanitize_html( $html );
}

function is_admin() {}
