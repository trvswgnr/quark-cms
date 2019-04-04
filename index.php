<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Food @ TravisAW.com</title>
</head>
<body>
	<h1>Welcome!</h1>
	<?php
	function list_file_links( $ext = '*' ) {

		$files = glob( "*.$ext" );

		echo '<ul>' . implode( '', array_map( 'sprintf', array_fill( 0, count( $files ), '<li><a href="%s">%s</a></li>' ), $files, $files ) ) . '</ul>';
	}
	list_file_links( 'php' );
	?>
</body>
</html>
