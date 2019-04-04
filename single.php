<?php
require 'config.php';


try {
	$post_id = $_GET['id'] ?: 1;
	$sql = "SELECT * FROM posts WHERE ID=$post_id LIMIT 1";
	$post = $conn->query($sql)->fetch();
} catch ( PDOException $e ) {
	echo 'Error Getting Post: ' . $e->getMessage();
}
?>

<h1><?php echo $post['title']; ?></h1>
<div><?php echo $post['content']; ?></div>
