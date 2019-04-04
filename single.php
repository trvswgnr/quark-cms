<?php
require 'header.php';

try {
	$post_id = $_GET['id'] ?: 1;
	$sql = "SELECT * FROM posts WHERE ID=$post_id LIMIT 1";
	$post = $conn->query($sql)->fetch();
} catch ( PDOException $e ) {
	echo 'Error Getting Post: ' . $e->getMessage();
}
?>

<h1><?php echo $post['title']; ?></h1>
<p><small>Published: <?php echo $post['date']; ?></small></p>
<p><small>Modified: <?php echo $post['modified']; ?></small></p>
<div><?php echo $post['content']; ?></div>
<a href="<?php echo site_directory() . '/edit-post.php?id=' . $post['ID']; ?>">Edit</a>

<?php require 'footer.php'; ?>
