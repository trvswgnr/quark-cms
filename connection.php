<?php
$host   = 'localhost';
$user   = 'root';
$pass   = 'root';
$dbname = 'food_taw';

$conn = new PDO( "mysql:host=$host;dbname=$dbname", $user, $pass );
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );