<?php
/**
 * Site Setup
 *
 * @package foodtaw
 */

// Import Setup class.
require 'class-setup.php';

if ( filter_input( INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS ) ) {
	$setup = new Setup( $conn );
}
?>

<form action="" method="post">
	<input type="submit" name="submit" value="Initialize Site">
</form>
