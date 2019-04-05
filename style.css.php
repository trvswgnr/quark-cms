<?php
header("Content-type: text/css; charset: UTF-8");

require 'functions.php';

$normalize = 'https://necolas.github.io/normalize.css/8.0.1/normalize.css';
echo remote_file_contents( $normalize );
?>

<?php
$brand_color = '#990000';
$link_color  = '#555555';
?>
body {
	margin: 1em;
	font-family: 'Helvetica Neue', arial, sans-serif;
}

.container {
	max-width: 768px;
	margin: 0 auto;
}

h1, h2, h3, h4 {
	margin-top: 1em;
}

label {
	display: block;
	margin-top: 1em;
}