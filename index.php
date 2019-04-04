<?php require 'header.php'; ?>
	<h1>Welcome!</h1>
	
	<?php
	function list_file_links( $ext = '*' ) {

		$files = glob( "*.$ext" );

		echo '<ul>' . implode( '', array_map( 'sprintf', array_fill( 0, count( $files ), '<li><a href="%s">%s</a></li>' ), $files, $files ) ) . '</ul>';
	}
	
	list_file_links( 'php' );
	?>
<?php require 'footer'; ?>
