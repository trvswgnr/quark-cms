<?php
header("Content-type: text/css; charset: UTF-8");

require 'functions.php';

$bootstrap = 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css';
echo get_remote_file_contents($bootstrap);
?>

<?php
$brand_color = '#990000';
$link_color  = '#555555';
?>

h1, h2, h3, h4 {
	margin-top: 1em;
}

label {
	display: block;
	margin-top: 1em;
}