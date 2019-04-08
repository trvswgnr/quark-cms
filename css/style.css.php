<?php
header("Content-type: text/css; charset: UTF-8");

require '../functions.php';
require 'normalize.css';

$brand_color = '#990000';
$link_color  = '#555555';
?>
body {
	margin: 1em;
	font-family: 'Helvetica Neue', arial, sans-serif;
	line-height: 1.4;
}

ul {
	padding-left: 1.2em;
}

li {
	margin: 0.5em 0;
}

a {
	text-decoration: none;
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

.input-group {
	margin: 1em 0;
}

.tox-statusbar__branding {
	display: none;
}

.textarea-content {
	visibility: hidden;
	min-height: 200px;
}
