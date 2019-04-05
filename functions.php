<?php
function get_site_directory() {
	$string               = ltrim( $_SERVER['REQUEST_URI'], '/' );
	$host                 = $_SERVER['HTTP_HOST'];
	$protocol             = ( ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) || $_SERVER['SERVER_PORT'] == 443 ) ? 'https://' : 'http://';
	list( $before_slash ) = explode( '/', $string );
	return rtrim( $protocol . $host . '/' . $before_slash, '/' );
}

function site_directory() {
	echo get_site_directory();
}

function title_to_slug( $string ) {
	$string = strtolower( $string );
	$slug = preg_replace( '/[^A-Za-z0-9-]+/', '-', $string );
	return $slug;
}

function get_remote_file_contents( $url ) {
	$ch      = curl_init();
	$timeout = 5;
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
	$data = curl_exec( $ch );
	curl_close( $ch );
	return $data;
}

function remote_file_contents( $url ) {
	echo get_remote_file_contents( $url );
}
